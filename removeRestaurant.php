<?php
require_once __DIR__ . "/classes/DB.php";
require_once __DIR__ . "/classes/RestaurantRepository.php";
require_once __DIR__ . "/functions/functions.php";

AuthOnly();


use Classes\DB;
use Classes\RestaurantRepository;
try{
$db = DB::connect();

$query = $db->prepare('SELECT `name` FROM restaurant WHERE id = :id');
$query->bindParam(':id', $_GET['id']);
$query->execute();

$name = $query->fetchAll(PDO::FETCH_ASSOC);

$restaurant = new RestaurantRepository($db);
$restaurant->delete($_GET['id'], $_SESSION["user"]["id"]);
}catch (PDOException $e) {
    file_put_contents("./../errors.txt", $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location:500.php");
    die();
}
//delete restaurant code
$deleteOldCode = __DIR__ . DIRECTORY_SEPARATOR . "QRCodes" . DIRECTORY_SEPARATOR . $_GET['img'];

if (file_exists($deleteOldCode)) {
    unlink($deleteOldCode);
}

// delete restaurant folder
$folderToDelete = __DIR__ . DIRECTORY_SEPARATOR . "restaurants" . DIRECTORY_SEPARATOR . $name[0]['name'];
deleteFolder($folderToDelete);

header("Location:dashboard.php");
die();
