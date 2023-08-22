<?php

use Classes\ProductRepository;
use Classes\Product;
use Classes\DB;

require_once __DIR__ . '/classes/Product.php';
require_once __DIR__ . '/classes/DB.php';
require_once __DIR__ . '/classes/ProductRepository.php';
require_once __DIR__ . "/functions/functions.php";


$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$categoryId = $_POST['categoryid'];
$type = $_POST['type'];
$type = intval($type);

if ($type != 1 && $type != 2) {
    header("Location:addProductForm.php");
    die();
}


$db = DB::connect();
$query = $db->prepare("SELECT `name` from restaurant WHERE id = :id");
$query->bindParam(":id", $_POST['id']);
$query->execute();

$restaurantName = $query->fetchAll(PDO::FETCH_ASSOC);
$restaurantName = $restaurantName[0]['name'];
$restaurantName = str_replace(" ", "_", $restaurantName);

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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = DB::connect();
        $productRepository = new ProductRepository($db);


        $product = new Product($name, $photo, $description, $price, $type);
        $product->setCategoryId($categoryId);
        $productRepository->save($product);
    } catch (PDOException $e) {
        // header("Location:" . $_SERVER['HTTP_REFERER']);
        echo $e->getMessage();
        file_put_contents("errors.txt", $e->getMessage(), FILE_APPEND);
        die();
    }
} else {
    // header("Location: " . $_SERVER['HTTP_REFERER']);
    echo "Here";
    die();
}


header("Location: pages/products.php?id=$categoryId");
die();
