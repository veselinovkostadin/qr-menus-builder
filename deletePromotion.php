<?php

require_once __DIR__ . "/classes/DB.php";
require_once __DIR__ . "/classes/PromotionRepository.php";
require_once __DIR__ . "/functions/functions.php";

AuthOnly();


use Classes\DB;
use Classes\PromotionRepository;

try {
    $db = DB::connect();

    $promotion = new PromotionRepository($db);
    $promotion->delete($_GET['id'], $_SESSION['user']['id']);
} catch (PDOException $e) {
    file_put_contents("./../errors.txt", $e->getMessage(), FILE_APPEND);
    header("Location:" . APP_URL . "/pages/500.php");
    die();
}
header("Location:" . $_SERVER['HTTP_REFERER']);
die();
