<?php
require_once __DIR__  . "/classes/DB.php";
require_once __DIR__ . "/classes/ProductRepository.php";
require_once __DIR__ . "/functions/functions.php";
require_once __DIR__ . "/consts.php";
AuthOnly();

use Classes\DB;
use Classes\ProductRepository;

try {
    $db = DB::connect();
    $product = new ProductRepository($db);
    $product->removePromotion($_GET['id'], $_SESSION['user']['id']);
} catch (PDOException $e) {
    file_put_contents("errors.txt", $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location:" . APP_URL . "/pages/500.php");
    die();
}
header("Location:" . $_SERVER["HTTP_REFERER"]);
die();
