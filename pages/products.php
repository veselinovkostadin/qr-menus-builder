<?php
session_start();
require_once '../classes/DB.php';
require_once '../consts.php';
require_once "../functions/functions.php";
AuthOnly();
if (!isset($_GET['id'])) {
    header("Location: ../dashboard.php");
    die();
}

use Classes\DB;

$db = DB::connect();

$categoryId = $_GET['id'];

$query = $db->prepare("SELECT products.*,restaurant.user_id FROM products JOIN categories on products.category_id = categories.id JOIN restaurant ON categories.menu_id = restaurant.id WHERE category_id = :categoryId and restaurant.user_id = :userId");

// $query = $db->prepare('SELECT * FROM products WHERE category_id = :categoryId');
$query->bindParam(':categoryId', $categoryId);
$query->bindParam(":userId", $_SESSION["user"]["id"]);
$query->execute();

$products = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $db->prepare('SELECT * FROM categories WHERE id = :categoryId LIMIT 1');
$query->bindParam(':categoryId', $categoryId);
$query->execute();

$categories = $query->fetchAll(PDO::FETCH_ASSOC);

$category = $categories[0]['name'];

$user_id = $_SESSION['user']['id'];

$query = $db->prepare('SELECT r.name,r.id
FROM restaurant AS r JOIN categories AS c ON r.id = c.menu_id
WHERE c.id = :id LIMIT 1');
$query->bindParam(':id', $categoryId);
$query->execute();

$restaurant = $query->fetchAll(PDO::FETCH_ASSOC);
$restaurant = $restaurant[0];

$query = $db->prepare("SELECT * FROM promotions WHERE restaurant_id = :restaurantId");
$query->bindParam(":restaurantId", $restaurant['id']);
$query->execute();

$promotions = $query->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./../styles/style.css">
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

        .product-card {
            width: 350px;
            /* height: 500px; */
            /* left: 89px;
            top: 253px; */

            background: #D9D9D9;
            box-shadow: inset 0px 10px 7px rgba(0, 0, 0, 0.25);
            border-radius: 35px;

            padding-top: 25px;
        }

        .product-img {
            width: 213px;
            height: 214px;
            left: 200px;
            top: 305px;
        }
    </style>
    <script type='text/javascript' src='./../promotions.js'></script>
</head>
<?php
?>

<body>
    <div class="container-fluid mt-2">

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="p-3 d-flex justify-content-around">
                    <!-- restaurant name -->
                    <a class='name text-center h2 text-decoration-none' href='../dashboard.php'><?= $restaurant['name'] ?></a>

                    <h2 class="text-white text-center"><?= $category ?></h2>
                    <a href="../addProductForm.php?id=<?= $categoryId ?>" class="text-white text-center text-decoration-none border border-0 bg-orange p-2 rounded-4 d-none d-sm-none d-md-block w-25">Add new product</a>
                </div>
            </div>
            <div class="row">
                <div class="d-flex justify-content-center align-items-center">
                    <a href="../productForm.php" class="text-white text-center text-decoration-none border border-0 bg-orange p-2 rounded-4  d-lg-none d-xl-none d-sm-block d-md-none w-100">Add new product</a>
                </div>
            </div>

        </div>
    </div>


    <div class="container mt-3">

        <div class="row d-flex justify-content-start">

            <?php
            if (is_null($products) || empty($products)) {
                echo "<div class='col-12 d-flex justify-content-center align-items-center'>
    <h1 class='text-center text-white'>No products found, please add a product.</h1>
    </div>";
            }
            ?>
            <?php
            $i = 0;
            foreach ($products as $product) {
                $i++;
            ?>

                <div class="col-md-4 col-sm-12 mt-3 d-flex justify-content-center">
                    <div class="product-card">
                        <h3 class="text-center fw-bold p-3"><?= $product['name'] ?></h1>

                            <div class="d-flex justify-content-center">
                                <img class="product-img rounded-circle " src="<?= generateProductImageAdmin($product['picture']) ?>" alt="product Image">
                            </div>
                            <h4 class="text-center text-color pt-3 fw-bold">Product description:</h4>
                            <p class="text-center text-color py-3 fw-semibold"><?= $product['description'] ?></p>
                            <hr class="ms-5 border border-dark border-1 w-75 shadow">
                            <div class="d-flex justify-content-around">
                                <p class="text-color fw-semibold fs-5">Price: </p>
                                <p class="text-end text-color fw-semibold  fs-5 "><?= $product['price'] ?> &euro; </p>
                            </div>
                            <div class='mt-2 pb-4 w-100 flex-column text-center'>
                                <div class="p-3">
                                    <a href="../editProductForm.php?id=<?= $product['id'] ?>&categoryid=<?= $categoryId ?>" class="text-decoration-none text-white border border-0 rounded-4 bg-orange btn w-75">Edit product info</a>
                                </div>
                                <div class="p-3">
                                    <a href="../deleteProduct.php?id=<?= $product['id'] ?>&categoryid=<?= $categoryId ?>" class="text-decoration-none text-white bg-red border border-0 rounded-4 btn w-75">Delete product</a>
                                </div>
                                <div class="p-3 border border-secondary col-10 mx-auto" id='promotionDiv'>
                                    <label for="addPromotion<?= $i ?>">Add to promotion</label>
                                    <input type="checkbox" id='addPromotion<?= $i ?>' onchange="promotions(this)">

                                    <div style='display:none;' class='selectPromotion<?= $i ?>'>
                                        <?php
                                        if (empty($promotions)) {
                                            echo "There are no promotions available";
                                        } else {
                                            echo "  <form action='./../addPromotionToProduct.php?id= {$product['id']}' method='POST'>
                                            <select name='promotion' id=''>";
                                        }
                                        foreach ($promotions as $promotion) {


                                            echo "<option value='{$promotion['id']}'>{$promotion['name']} ({$promotion['discount']}%)</option>";
                                        }

                                        ?>
                                        </select>
                                        <input type="submit" class="btn btn-primary mt-2" value="Add to promotion">
                                        </form>
                                    </div>
                                </div>
                            </div>

                    </div>

                </div>
            <?php } ?>




            <?php
            // if (empty($products)) {
            //     echo "<a href='../dashboard.php' class='text-decoration-none text-white bg-orange border border-0 rounded-4 btn px-4 py-2 mx-4'>Go back</a>";
            //     die();
            // }
            foreach ($categories as $category) {
                if ($category['belongs_to'] == 1) {
                    echo "  <a href='foodCategories.php?id={$category['menu_id']}' class='text-decoration-none col-lg-1 col-4 rounded-pill text-center fixed-bottom mb-5 ms-auto me-4' id='backBtn'>
                            <span>Go back</span>
                        </a>";
                    break;
                } else if ($category['belongs_to'] == 2) {
                    echo "  <a href='drinkCategories.php?id={$category['menu_id']}' class='text-decoration-none col-lg-1 col-4 rounded-pill text-center fixed-bottom mb-5 ms-auto me-4' id='backBtn'>
                            <span>Go back</span>
                        </a>";
                    break;
                }
            }





            ?>

        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>