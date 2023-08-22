<?php
require_once __DIR__ . "/../classes/DB.php";
require_once __DIR__ . "/../consts.php";
require_once __DIR__ . "/../functions/functions.php";

use Classes\DB;

$db = DB::connect();
// echo APP_PATH . "/pages/404.php";
// if (!isset($_GET["UUID"])) {
//   header("Location:" . APP_PATH . "\\pages\\404.php");
//   die();
// }

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location:" . APP_URL . "/pages/400.php");
    die();
}
if (empty($_POST['search'])) {
    if (empty(NGROK)) {
        header("Location:" . APP_URL . "/frontend/homePage.php?UUID={$_GET['UUID']}");
        die();
    } else {
        header("Location:" . NGROK . NGROK_REST . "/frontend/homePage.php?UUID={$_GET['UUID']}");
        die();
    }
}

$query = $db->prepare("SELECT * FROM restaurant WHERE UUID = :uuid");
$query->bindParam(":uuid", $_GET['UUID']);
$query->execute();

$restaurant = $query->fetch(PDO::FETCH_ASSOC);
// print_r($restaurant);
// die();
if (!$restaurant) {
    echo "No restaurant found";
    die();
}

$query = $db->prepare("SELECT cat.* from categories as cat JOIN restaurant as rest ON cat.menu_id = rest.id WHERE rest.UUID = :UUID and cat.name LIKE :search");
$query->execute([":UUID" => $_GET["UUID"], ":search" => "%{$_POST['search']}%"]);
$categories = $query->fetchAll(PDO::FETCH_ASSOC);


$query = $db->prepare("SELECT prod.* FROM products as prod JOIN categories as cat ON prod.category_id = cat.id
    JOIN restaurant as rest ON cat.menu_id = rest.id WHERE rest.UUID = :UUID and prod.name LIKE :search");
$query->execute([":UUID" => $_GET["UUID"], ":search" => "%{$_POST['search']}%"]);
$products = $query->fetchAll(PDO::FETCH_ASSOC);

// print_r($categories);
// die();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="./styles/homePage.css">
    <link rel="stylesheet" href="./styles/foodCategory.css">
    <link rel="stylesheet" href="./styles/foodSection.css">
    <link rel="stylesheet" href="./styles/drinkCategory.css">
    <link rel="stylesheet" href="./styles/drinkSection.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Menu</title>
</head>

<body>
    <nav class="navbar bg-transparent">
        <div class="container-fluid">
            <a id="logoname" href="homePage.php?UUID=<?= $_GET['UUID'] ?>" class="col-10"><?= $restaurant['name'] ?></a>

            <div class="btn-group dropdown col-2">
                <button type="button" class="btn dropbtn" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                        <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z" />
                    </svg>
                </button>
                <ul id="myDropdown" class="dropdown-menu dropdown-menu-end">
                    <?php
                    echo "
          <li><a class='dropdown-item' type='button'><img class='flags' src='images/macedonian-flag.svg' alt=''> Macedonian</a></li>
          <li><a class='dropdown-item' type='button'> <img class='flags' src='images/british-flag.svg' alt=''> English</a></li>";
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="mx-3">
        <p> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
            </svg> <?= $restaurant['address'] ?> | <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
            </svg> <?= $restaurant['phone'] ?></p>
        <p> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wifi" viewBox="0 0 16 16">
                <path d="M15.384 6.115a.485.485 0 0 0-.047-.736A12.444 12.444 0 0 0 8 3C5.259 3 2.723 3.882.663 5.379a.485.485 0 0 0-.048.736.518.518 0 0 0 .668.05A11.448 11.448 0 0 1 8 4c2.507 0 4.827.802 6.716 2.164.205.148.49.13.668-.049z" />
                <path d="M13.229 8.271a.482.482 0 0 0-.063-.745A9.455 9.455 0 0 0 8 6c-1.905 0-3.68.56-5.166 1.526a.48.48 0 0 0-.063.745.525.525 0 0 0 .652.065A8.46 8.46 0 0 1 8 7a8.46 8.46 0 0 1 4.576 1.336c.206.132.48.108.653-.065zm-2.183 2.183c.226-.226.185-.605-.1-.75A6.473 6.473 0 0 0 8 9c-1.06 0-2.062.254-2.946.704-.285.145-.326.524-.1.75l.015.015c.16.16.407.19.611.09A5.478 5.478 0 0 1 8 10c.868 0 1.69.201 2.42.56.203.1.45.07.61-.091l.016-.015zM9.06 12.44c.196-.196.198-.52-.04-.66A1.99 1.99 0 0 0 8 11.5a1.99 1.99 0 0 0-1.02.28c-.238.14-.236.464-.04.66l.706.706a.5.5 0 0 0 .707 0l.707-.707z" />
            </svg> <?= $restaurant['wifi_password'] ?></p>
    </div>

    <!-- food and drink sections -->
    <?php
    if ($restaurant['food'] == 1 && $restaurant['drink'] == 1) {
        echo "<div id='foodDrinkButtons' class='container d-flex justify-content-around mb-3'>

    <div class='menuButton col-5' id='foodButton'>
      <a class='text-decoration-none' href='foodSection.php?UUID={$_GET['UUID']}' id='shadowButton'>
        <span>Food</span>
      </a>
    </div>

    <div class='menuButton col-5' id='drinkButton'>
      <a class='text-decoration-none' href='drinkSection.php?UUID={$_GET['UUID']}'>
        <span>Drink</span>
      </a>
    </div>
  </div>";
    } else if ($restaurant['food'] == 1) {
        echo "<div id='foodDrinkButtons' class='container d-flex justify-content-center mb-3'>

    <div class='menuButton col-5' id='foodButton'>
      <a class='text-decoration-none' href='foodSection.php?UUID={$_GET['UUID']}' id='shadowButton'>
        <span>Food</span>
      </a>
    </div>
    </div>";
    } else {
        echo "<div id='foodDrinkButtons' class='container d-flex justify-content-center mb-3'>
    <div class='menuButton col-5' id='drinkButton'>
    <a class='text-decoration-none' href='drinkSection.php?UUID={$_GET['UUID']}'>
      <span>Drink</span>
    </a>
  </div>
</div>";
    }
    ?>
    <!-- Search div -->
    <?php
    if (!empty($categories)) {
        echo "<div class='container mt-4' id='categories' style='border-top:solid 2px #E67226;'>";
        foreach ($categories as $category) {
            if ($category['belongs_to'] == 2) {
                $url = "drinkCategory.php";
            } else if ($category['belongs_to'] == 1) {
                $url = "foodCategory.php";
            }
            echo "<div class='drinkCategories leftShadow row mx-auto mt-2'>
                    <a href='{$url}?UUID={$_GET["UUID"]}&categoryId={$category['id']}' class='d-flex justify-content-center align-items-center mb-0'>{$category['name']}</a>
                    </div>";
        }
        echo "</div>";
    } else {
        echo "<div class='container mt-4 mb-2 text-center'  style='border:solid 2px #E67226;'>
                    <h3 class='p-2' style='color:#E67226;'>No categories found</h3>
                </div>";
    }

    if (!empty($products)) {
        echo "<div class='container mt-4 mx-auto' style='border-top:solid 2px #E67226; padding-bottom:85px;'>
            <div class='d-flex flex-wrap justify-content-around align-items-start text-center'>";
        foreach ($products as $product) {
            if ($product['belongs_to'] == 1) {
                echo "<div class='container productCard leftShadow d-flex justify-content-center align-items-center mt-2'>
                            <div class='row mh-100'>
 
                                 <div class='col-6 d-flex justify-content-center align-items-center'>
                                    <img src='" . generateProductImage($product['picture']) . "' class='img-fluid productImg rounded-circle' alt=''>
                                  </div>
 
                             <div class='col-6 text-center '>
                                 <div class='row'>
                                      <p class='productName mb-0'>{$product['name']}</p>
 
                                    <p class='productDescription mb-1'>{$product['description']}</p>
                                 </div>
                                      <div class='row d-flex justify-content-between align-items-center'>
 
                                    <div class='col-5 me-0 d-inline-block'>
                                          <p class='m-0 fs-4'>{$product['price']} &euro;</p>
                                    </div>
                                    <div class='seeMoreBtn col-6 me-1 d-inline-block'>
                                        <a href='./foodProduct.php?UUID={$_GET['UUID']}&id={$product['id']}' class=''>See more</a>
                                    </div>
 
                                </div>
                             </div>
                         </div>
                     </div>";
            } else if ($product['belongs_to'] == 2) {
                echo "
                       <div class='col-5 drinkCard h-100 m-2'>
                            <p class='drinkName'>{$product['name']}</p>
                            <img src='" . generateProductImage($product['picture']) . "' width='125px' class='img-fluid rounded-circle'>
                         <p class='fs-3 fw-medium'>{$product['price']} &euro;</p>
                    </div>";
            }
        }
        echo "</div>
                </div>";
    } else {
        echo "<div class='container mt-4 mb-2 text-center'  style='border:solid 2px #E67226;'>
                    <h3 class='p-2' style='color:#E67226;'>No products found</h3>
                </div>";
    }
    ?>

    <!-- search bar -->
    <div class="container-fluid d-flex justify-content-center mt-3 fixed-bottom">
        <div class="row w-100">

            <form action="searchProducts.php?UUID=<?= $_GET['UUID'] ?>" method="POST" id='search'>
                <input type="text" class="form-control" placeholder="Search..." name='search' value='<?= $_POST['search'] ?? "" ?>'>
                <span><button id="searchButton"><i class="bi bi-search fs-3"></i></button></span>
            </form>
        </div>
    </div>


    <?php require_once __DIR__ . "/layouts/footer.php" ?>