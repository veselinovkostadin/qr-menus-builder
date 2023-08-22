<?php

require_once __DIR__ . '/classes/PromotionRepository.php';
require_once __DIR__ . '/classes/Promotion.php';
require_once __DIR__ . '/classes/DB.php';
require_once __DIR__ . "/functions/functions.php";

use Classes\DB;
use Classes\PromotionRepository;
use Classes\Promotion;

AuthOnly();
$id = $_GET['id'];
$userId = $_SESSION["user"]['id'];
$name = $_POST['name'];
$discount = $_POST['discount'];
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];

try {
    $db = DB::connect();

    $promotionRepo = new PromotionRepository($db);

    $promotionRepo->update($id, $userId, $name, $discount, $startDate, $endDate);
} catch (PDOException $e) {
    file_put_contents("errors.txt", $e->getMessage(), FILE_APPEND);
    header("Location:" . APP_URL . "/pages/500.php");
    die();
}
header("Location:" . $_SERVER['HTTP_REFERER']);
die();
