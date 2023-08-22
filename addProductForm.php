<?php
session_start();
require_once __DIR__ . '/classes/DB.php';
require_once __DIR__ . '/consts.php';
require_once __DIR__ . "/functions/functions.php";
AuthOnly();
if (!isset($_GET['id'])) {
    header("Location: ../dashboard.php");
    die();
}

use Classes\DB;

$db = DB::connect();

$categoryId = $_GET['id'];

$query = $db->prepare('SELECT * FROM products WHERE category_id = :categoryId');
$query->bindParam(':categoryId', $categoryId);
$query->execute();

$products = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $db->prepare('SELECT * FROM categories WHERE id = :categoryId LIMIT 1');
$query->bindParam(':categoryId', $categoryId);
$query->execute();

$categories = $query->fetchAll(PDO::FETCH_ASSOC);
$category = $categories[0]['name'];


$query = $db->prepare('SELECT r.name,r.id
FROM restaurant AS r JOIN categories AS c ON r.id = c.menu_id
WHERE c.id = :id LIMIT 1');
$query->bindParam(':id', $categoryId);
$query->execute();

$restaurant = $query->fetchAll(PDO::FETCH_ASSOC);
$restaurantName = $restaurant[0]['name'];

$type = $categories[0]['belongs_to'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
    <style>
        body {
            background-color: #252A2D;
            margin-bottom: 100px;
        }

        .name {
            color: #E67226;

        }

        .text-color {
            color: #252A2D;
        }

        .bg-orange {
            background-color: #E67226;
        }

        .bg-red {
            background-color: #AA2323;
        }

        .bg-form {
            background: rgba(230, 114, 38, 0.5);
            ;
        }

        .product-card {
            /* width: 350px; */
            height: auto;
            /* left: 89px;
            top: 253px; */

            background: #D9D9D9;
            box-shadow: inset 0px 10px 7px rgba(0, 0, 0, 0.25);
            border-radius: 35px;

            padding-top: 25px;
        }

        .form-card {
            padding-top: 10px;
            padding-left: 10px;
            padding-right: 10px;
            padding-bottom: 10px;
        }

        .input {
            margin-left: 100%;
        }

        .product-img {
            width: 213px;
            height: 214px;
            left: 200px;
            top: 305px;
        }

        .margins {
            margin-top: 20px;
        }

        #orangeButtons:hover {
            background-color: rgb(240, 135, 65);
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.5) inset;
        }

        .borderdash {
            border: 3px dashed #252A2D;
        }
    </style>
</head>

<body>

    <div class="container-fluid mt-2">

        <div class="row w-75">
            <div class="col-md-12 col-sm-12">
                <div class="p-3 d-flex justify-content-around">

                    <!-- restaurant name -->
                    <h2 class='name text-center'><?= $restaurantName ?></h2>

                    <h3 class="text-white text-center"><?= $category ?></h3>
                </div>
            </div>


        </div>
    </div>
    <!-- FORMA -->
    <div class="container margins">

        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-8 border border-0 product-card">
                <div class="form-card">
                    <div class="bg-form rounded-3 borderdash m-3 ">
                        <h2 class="text-center mb-5 text-color fw-bold mt-3">Add new product</h2>
                        <form action="addProduct.php?id=<?= $_GET['id'] ?>" method="POST" id="form" enctype="multipart/form-data">
                            <div class="row m-2">

                                <div class="col-sm-12 col-md-4 d-flex justify-content-start">
                                    <label for="" class="fs-5 fw-bold ms-5">Name:</label>
                                </div>

                                <div class="col-sm-12 col-md-8 px-5">
                                    <input type="text" class="w-75 rounded-4 shadow p-1 border border-0" id="name" name="name" class="form-control" placeholder="Name" aria-label="Name">
                                    <div class="error" style='color:red;'></div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-sm-12 col-md-4 d-flex justify-content-start">
                                    <label for="" class="fs-5 ms-5 fw-bold ">Description:</label>
                                </div>

                                <div class="col-sm-12 col-md-8 px-5">
                                    <textarea name="description" placeholder="Description" class="w-75 rounded-4 shadow p-1 border border-0" id="description" cols="30" rows="5"></textarea>
                                    <!-- <div class="error" style='color:red;'></div> -->
                                </div>
                            </div>
                            <div class="row m-2">

                                <div class="col-sm-12 col-md-4 d-flex justify-content-start">
                                    <label for="" class="fs-5 fw-bold ms-5">Price:</label>
                                </div>

                                <div class="col-sm-12 col-md-8 px-5">
                                    <input type="text" class="w-75 rounded-4 shadow p-1 border border-0" name="price" id="price" class="form-control" placeholder="Price" aria-label="Name">
                                    <div class="error" style='color:red;'></div>
                                </div>
                            </div>
                            <div class="row m-2">

                                <div class="col-sm-12 col-md-4 d-flex justify-content-start">
                                    <label for="" class="fs-5 fw-bold ms-5">Photo:</label>
                                </div>

                                <div class="col-sm-12 col-md-8 px-5">
                                    <input type="file" class="w-75 rounded-4 shadow p-1 border border-0 bg-light" name="photo" id="photo">
                                    <div class="error" style='color:red;'></div>
                                </div>
                            </div>

                            <input type="hidden" value="<?= $_GET['id'] ?>" name="categoryid">
                            <!-- rest id -->
                            <input type="hidden" value="<?= $restaurant[0]['id'] ?>" name='id'>
                            <!-- type FOOD/DRINK -->
                            <input type="hidden" value="<?= $type ?>" name="type">

                            <div class=" col-12 d-flex justify-content-end px-5">
                                <button type="submit" class="btn bg-orange text-white btn-lg px-5 mb-4" id="orangeButtons">Submit</button>
                            </div>
                    </div>



                    </form>
                    <!-- <form action="addProduct.php?id=<?= $_GET['id'] ?>" method="POST" class="row mx-5" id="form" enctype="multipart/form-data">

                            <div class="col-md-6 col-sm-12 d-flex justify-content-start">
                                <label for="name " class="fs-5 fw-bold text-start ms-5">Product name:</label>
                            </div>
                            <div class="col-md-6 col-sm-12 d-flex justify-content-end mb-4">
                                <input type="text" name="name" class="rounded-4 w-100 shadow p-1 border border-0" id="name" placeholder=Name>
                                <div class="error"></div>
                            </div>

                            <div class="col-md-6 col-sm-12 d-flex justify-content-start">
                                <label for="description" class="fs-5 fw-bold text-start ms-5">Product description:</label>
                            </div>
                            <div class="col-md-6 col-sm-12 d-flex justify-content-end mb-4">
                                <textarea name="description" id="description" cols="30" rows="5" id="description" class="border-0 border rounded-4 w-100 shadow" placeholder="Description"></textarea>
                                    <div class="error"></div>
                                </div>

                                <div class="col-md-6 col-sm-12 d-flex justify-content-start">
                                    <label for="price" class="fs-5 fw-bold text-start ms-5">Product price:</label>
                                </div>
                                <div class="col-md-6 col-sm-12 d-flex justify-content-end mb-4">
                                    <input type="text" name="price" class="border border-0 rounded-4 w-100 shadow p-1" id="price" placeholder="Price">
                                    <div class="error"></div>
                                </div>
                                <div class="col-md-6 col-sm-12 d-flex justify-content-start">
                                    <label for="photo" class="fs-5 fw-bold text-start ms-5">Product photo:</label>
                                </div>
                                <div class="col-md-6 col-sm-12 d-flex justify-content-end mb-4">
                                    <input type="file" name="photo" class="w-100">
                                     <button class="border border-0 rounded-4 mx-1 shadow">Import</button> -->
                    <!-- </div> -->




                </div>

            </div>
        </div>
    </div>
    </div>


    <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class='text-decoration-none col-lg-1 col-4 rounded-pill text-center fixed-bottom mb-5 ms-auto me-4' id="backBtn">Go back</a>





    <script src="products.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>