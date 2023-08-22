<?php

require_once __DIR__ . "/classes/DB.php";
require_once __DIR__ . "/classes/CategoryRepository.php";
require_once __DIR__ . "/functions/functions.php";

AuthOnly();


use Classes\DB;
use Classes\CategoryRepository;

// print_r($_SESSION);
// die();
try{
$db = DB::connect();

// $query = $db->prepare('SELECT `name` FROM categories JOIN restaurant ON categories.menu_id = restaurant.id
//  WHERE categoriesid = :id and ');
// $query->bindParam(':id', $_GET['id']);
// $query->execute();

// $name = $query->fetchAll(PDO::FETCH_ASSOC);

$category = new CategoryRepository($db);
$category->delete($_GET['id'], $_SESSION["user"]["id"]);}
catch (PDOException $e) {
    file_put_contents("./../errors.txt", $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location:500.php");
    die();
}
header("Location:" . $_SERVER['HTTP_REFERER']);
die();
