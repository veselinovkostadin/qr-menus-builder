<?php
require_once __DIR__ . "/classes/DB.php";
require_once __DIR__ . '/classes/ProductRepository.php';
require_once __DIR__ . "/functions/functions.php";

use Classes\DB;
use Classes\ProductRepository;

AuthOnly();
try {
    $db = DB::connect();

    $productRepo = new ProductRepository($db);

    $productRepo->addToPromotion($_GET['id'], $_POST['promotion'], $_SESSION['user']['id']);
} catch (PDOException $e) {
    file_put_contents("errors.txt", $e->getMessage(), FILE_APPEND);
    header("Location:" . APP_URL . "/pages/500.php");
    die();
}
header("Location:" . $_SERVER['HTTP_REFERER']);
die();
