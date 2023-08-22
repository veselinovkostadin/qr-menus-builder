<?php

require_once __DIR__ . '/classes/DB.php';
require_once __DIR__ . "/functions/functions.php";

use Classes\DB;

AuthOnly();

$db = DB::connect();

$id = $_GET['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$categoryid = $_GET['categoryid'];
$type = $_POST['type'];


$query = $db->prepare("SELECT `name` from restaurant WHERE id = :id");
$query->bindParam(":id", $_POST['id']);
$query->execute();

$restaurantName = $query->fetchAll(PDO::FETCH_ASSOC);
$restaurantName = $restaurantName[0]['name'];
$photo = null;
if ($_FILES['photo']['size'] > 0) {
    if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {

        $tempFilePath = $_FILES['photo']['tmp_name'];
        $pathInfo = pathinfo($_FILES['photo']['name']);
        // print_r($pathInfo);
        $filename = $pathInfo['filename'] . time() . "." . $pathInfo['extension'];


        if ($type == 1) {
            $destination = __DIR__ . DIRECTORY_SEPARATOR . "restaurants" . DIRECTORY_SEPARATOR .  $restaurantName . DIRECTORY_SEPARATOR . "Food" . DIRECTORY_SEPARATOR .  $filename;
        } else if ($type == 2) {
            $destination = __DIR__ . DIRECTORY_SEPARATOR . "restaurants" . DIRECTORY_SEPARATOR .  $restaurantName . DIRECTORY_SEPARATOR . "Drink" . DIRECTORY_SEPARATOR .  $filename;
        }

        move_uploaded_file($tempFilePath, $destination);
    } else {
        file_put_contents("errors.txt", $_FILES['photo']['error'], FILE_APPEND);
    }

    if ($type == 1) {
        $photo = $restaurantName . "/Food" . "/{$filename}";
    } else {
        $photo = $restaurantName . "/Drink" . "/{$filename}";
    }
}

try {
    $data = [
        ':name' => $name,
        ':description' => $description,
        ':price' => $price,
        ':type' => $type
    ];

    if (is_null($photo)) {
        $query = "UPDATE `products` SET name = :name , description = :description , price = :price , belongs_to = :type WHERE id = $id";
    } else {
        $query = "UPDATE `products` SET name = :name, picture = :photo, description = :description , price = :price , belongs_to = :type WHERE id = $id";
        $data[':photo'] = $photo;
    }
    $stmt = $db->prepare($query);
    $stmt->execute($data);
} catch (PDOException $e) {
    file_put_contents("./../errors.txt", $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location:500.php");
    die();
}
header("Location: pages/products.php?id=" . $categoryid);
die();
