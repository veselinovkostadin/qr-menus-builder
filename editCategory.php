<?php

require_once __DIR__ . '/classes/DB.php';
require_once __DIR__ . "/functions/functions.php";

use Classes\DB;

AuthOnly();
try{
$db = DB::connect();

$id = $_GET['id'];
$category = $_POST['category'];

$query = "UPDATE categories SET name = :name WHERE id = $id";
$stmt = $db->prepare($query);
$stmt->execute([
    ':name' => $category
]);}
catch (PDOException $e) {
    file_put_contents("./../errors.txt", $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location:500.php");
    die();
}
header("Location:" . $_SERVER['HTTP_REFERER']);
die();
