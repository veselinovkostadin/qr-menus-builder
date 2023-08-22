<?php

require_once __DIR__ . '/classes/DB.php';
require_once __DIR__ . "/functions/functions.php";
require_once __DIR__ . '/vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;

use Classes\DB;

AuthOnly();

$db = DB::connect();
// get old restaurant name (for folder renaming)
$query = $db->prepare('SELECT `name`,UUID FROM restaurant WHERE id = :id');
$query->bindParam(':id', $_GET['id']);
$query->execute();

$restaurant = $query->fetchAll(PDO::FETCH_ASSOC);
$oldName = $restaurant[0]['name'];
$oldName = str_replace(" ", "_", $oldName);
$uuid = $restaurant[0]['UUID'];

$path = NGROK . NGROK_REST . "/frontend/homePage.php?UUID={$uuid}";

$result = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data($path)
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
    ->size(300)
    ->margin(10)
    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->labelText($_POST['rest_name'])
    ->labelFont(new NotoSans(14))
    ->labelAlignment(new LabelAlignmentCenter())
    ->validateResult(false)
    ->build();


// da ne go zacuvuva so prazni mesta
$res_name_for_path = $_POST['rest_name'];
$res_name_for_path = str_replace(" ", "_", $res_name_for_path);
$uniq = rand(0, 9999);
$path = __DIR__ . DIRECTORY_SEPARATOR . 'restaurants' . DIRECTORY_SEPARATOR . $oldName . DIRECTORY_SEPARATOR . $res_name_for_path . $uniq . '.png';



$pathDB = "restaurants/{$res_name_for_path}/{$res_name_for_path}{$uniq}.png";

$result->saveToFile($path);

$rest_name = $res_name_for_path;
$phone = $_POST['phone'];
$address = $_POST['address'];
$wifi_password = $_POST['wifi_password'];
$menu_language = $_POST['menu_language'];
$categories = $_POST['categories'];
$food = 0;
$drink = 0;

if ($categories == 3) {
    $food = 1;
    $drink = 1;
} else if ($categories == 2) {
    $food = 1;
} else if ($categories == 1) {
    $drink = 1;
}
try {
    $query = "UPDATE restaurant SET name = :name, phone = :phone, wifi_password = :wifi_password, address = :address, menu_language = :menu_language, qr_code = :qr_code, food = :food, drink = :drink, UUID = :uuid WHERE id = {$_GET['id']}";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':name' => $rest_name,
        ':phone' => $phone,
        ':wifi_password' => $wifi_password,
        ':address' => $address,
        ':menu_language' => $menu_language,
        ':qr_code' => $pathDB,
        ':food' => $food,
        ':drink' => $drink,
        ':uuid' => $uuid
    ]);
} catch (PDOException $e) {
    file_put_contents("./../errors.txt", $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location:500.php");
    die();
}
// delete the old image

$deleteOldCode = __DIR__ . DIRECTORY_SEPARATOR . "restaurants" . DIRECTORY_SEPARATOR . $oldName . DIRECTORY_SEPARATOR . $_GET['img'];
if (file_exists($deleteOldCode)) {

    unlink($deleteOldCode);
}

//rename folder 

$oldFolderName = __DIR__ . DIRECTORY_SEPARATOR . "restaurants" . DIRECTORY_SEPARATOR . $oldName;
$newFolderName = __DIR__ . DIRECTORY_SEPARATOR . "restaurants" . DIRECTORY_SEPARATOR . $res_name_for_path;


if (file_exists($oldFolderName)) {
    rename($oldFolderName, $newFolderName);
}

header("Location: dashboard.php");
die();
