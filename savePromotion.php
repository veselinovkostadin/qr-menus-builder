<?php
require_once __DIR__ . "/classes/DB.php";
require_once __DIR__ . "/classes/Promotion.php";
require_once __DIR__ . "/classes/PromotionRepository.php";
require_once __DIR__ . "/functions/functions.php";
AuthOnly();

use Classes\DB;
use Classes\Promotion;
use Classes\PromotionRepository;
try{
$db = DB::connect();
$promotion = new Promotion($_POST['name'], $_POST['discount'], $_POST['start_date'], $_POST['end_date'], $_GET['id']);
$promotionRepo = new PromotionRepository;
$promotionRepo->save($promotion);
}
catch (PDOException $e) {
    file_put_contents("./../errors.txt", $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location:500.php");
    die();
}
header("Location:" . APP_URL . "/pages/promotions.php?id={$_GET['id']}");
die();
