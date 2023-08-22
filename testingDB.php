<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location:categories.php");
}

try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=nextmenu;", "root", "");
} catch (PDOException $er) {
    die("Database down");
}

$num = count($_POST); //broj na kolku pati treba da ima insert vo db

while ($num > 0) {
    $element = array_shift($_POST); // kategorijata koja ja trgame od niza i ja zapisuvame vo baza

    $sql = "INSERT INTO categories(category) VALUES (?)";
    $stmt = $pdo->prepare($sql);

    $result = $stmt->execute([$element]);

    $num--;
}
header("Location:categories.php");
