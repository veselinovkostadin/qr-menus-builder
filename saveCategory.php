<?php

require_once __DIR__ . "/classes/DB.php";
require_once __DIR__ . "/classes/Category.php";
require_once __DIR__ . "/classes/CategoryRepository.php";

use Classes\DB;
use Classes\Category;
use Classes\CategoryRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['belongs']) && !is_null($_POST['category'])) {
        try {
            $db = DB::connect();
            $categoryRepo = new CategoryRepository();

            $category = new Category($_POST['category'], $_GET['id'], $_POST['belongs']);

            $categoryRepo->save($category);
        } catch (PDOException $e) {
            header("Location:" . $_SERVER['HTTP_REFERER']);
            file_put_contents("errors.txt", $e->getMessage(), FILE_APPEND);
            die();
        }
    }
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    die();
}
header("Location: " . $_SERVER['HTTP_REFERER']);
// header("Location:./pages/foodCategories.php?id={$_GET['id']}");
die();
