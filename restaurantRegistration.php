<?php

require_once __DIR__ . '/classes/Restaurant.php';
require_once __DIR__ . '/classes/DB.php';
require_once __DIR__ . '/classes/RestaurantRepository.php';
require_once __DIR__ . "/consts.php";
require_once __DIR__ . "/vendor/autoload.php";


use Ramsey\Uuid\Uuid;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;

use Classes\Restaurant;
use Classes\DB;
use Classes\RestaurantRepository;

// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//     header("Location:dashobard.php");
//     die();
// }
$uuid = Uuid::uuid4();

if (empty(NGROK)) {
    define("NGROK", "http://127.0.0.1");
}

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

$path = __DIR__ . DIRECTORY_SEPARATOR . 'restaurants' . DIRECTORY_SEPARATOR . $res_name_for_path . DIRECTORY_SEPARATOR . $res_name_for_path . $uniq . '.png';


$pathDB = "restaurants/{$res_name_for_path}/{$res_name_for_path}{$uniq}.png";


$rest_name = $_POST['rest_name'];
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

// write to db
try {
    $db = DB::connect();
    $restaurantRepo = new RestaurantRepository($db);

    $restaurant = new Restaurant($rest_name, $phone, $address, $wifi_password, $menu_language, $pathDB, $food, $drink, $uuid);

    $restaurant->setUserId($_SESSION['user']['id']);


    $restaurantRepo->save($restaurant);
} catch (PDOException $e) {
    file_put_contents("./../errors.txt", $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location:dashboard.php");
    die();
}
// make folder for the new restaurant
$folderPath = __DIR__ . DIRECTORY_SEPARATOR . "restaurants" . DIRECTORY_SEPARATOR . $res_name_for_path;


if (!file_exists($folderPath)) {
    if (mkdir($folderPath, 0777, true)) {
        $foodFolder = __DIR__ . DIRECTORY_SEPARATOR . "restaurants" . DIRECTORY_SEPARATOR . $res_name_for_path . DIRECTORY_SEPARATOR . "Food";
        $drinkFolder = __DIR__ . DIRECTORY_SEPARATOR . "restaurants" . DIRECTORY_SEPARATOR . $res_name_for_path . DIRECTORY_SEPARATOR . "Drink";
        if ($food == 1 && $drink == 1) {
            mkdir($foodFolder, 0777, true);
            mkdir($drinkFolder, 0777, true);
        } else if ($food == 1) {
            mkdir($foodFolder, 0777, true);
        } else {
            mkdir($drinkFolder, 0777, true);
        }
    }
}

// zacuvuvanje na QR codot na nova lokacija
$result->saveToFile($path);
header("Location: dashboard.php");
die();
