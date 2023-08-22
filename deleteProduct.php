<?php
require_once __DIR__ . "/classes/DB.php";
require_once __DIR__ . "/classes/ProductRepository.php";
require_once __DIR__ . "/functions/functions.php";

AuthOnly();


use Classes\DB;
use Classes\ProductRepository;
try{
$db = DB::connect();

$query = $db->prepare("SELECT picture FROM products WHERE id = :id");
$query->bindParam(":id", $_GET['id']);
$query->execute();

$picturePath = $query->fetchAll(PDO::FETCH_ASSOC);
$picturePath = $picturePath[0]['picture'];

$picturePath = str_replace("/", "\\", $picturePath);
$product = new ProductRepository($db);
$product->delete($_GET['id']);}
catch (PDOException $e) {
    file_put_contents("./../errors.txt", $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location:500.php");
    die();
}
$filePath = __DIR__ . DIRECTORY_SEPARATOR . "restaurants" . DIRECTORY_SEPARATOR . $picturePath;

if (file_exists($filePath)) {
    unlink($filePath);
}


header("Location: pages/products.php?id=" . $_GET['categoryid']);
die();
