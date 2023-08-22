<?php
require_once __DIR__ . "/../classes/DB.php";
require_once __DIR__ . "/../consts.php";

use Classes\DB;

$db = DB::connect();

$query = $db->prepare("SELECT * FROM restaurant WHERE UUID = :uuid");
$query->bindParam(":uuid", $_GET['UUID']);
$query->execute();

$restaurant = $query->fetchAll(PDO::FETCH_ASSOC);
if (empty($restaurant)) {
     header("Location:" . APP_URL . "/pages/404.php");
     die();
}

$query = $db->prepare("SELECT categories.*,restaurant.name as restaurant FROM categories JOIN restaurant ON categories.menu_id = restaurant.id WHERE restaurant.UUID = :uuid and categories.belongs_to = 2");
$query->bindParam(":uuid", $_GET["UUID"]);
$query->execute();

$categories = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     <link rel="stylesheet" href="./styles/global.css">
     <link rel="stylesheet" href="./styles/drinkSection.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
     <title>Drink Sections</title>
     <style>
          #categories div:nth-child(even) {
               background: linear-gradient(89.88deg, rgba(0, 0, 0, 0) 0.11%, rgba(255, 255, 255, 0.39) 99.9%);
               background-color: #E67226;
          }
     </style>
</head>

<body>
     <nav class="navbar bg-transparent">
          <div class="container-fluid">
               <a id="logoname" href="./homePage.php?UUID=<?= $_GET['UUID'] ?>" class="col-10"><?= $restaurant[0]['name'] ?></a>

               <div class="btn-group dropdown col-2">
                    <button type="button" class="btn dropbtn" data-bs-toggle="dropdown" aria-expanded="false">
                         <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                              <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z" />
                         </svg>
                    </button>
                    <ul id="myDropdown" class="dropdown-menu dropdown-menu-end">
                         <li><a class="dropdown-item" type="button"><img class="flags" src="images/macedonian-flag.svg" alt=""> Macedonian</a></li>
                         <li><a class="dropdown-item" type="button"> <img class="flags" src="images/british-flag.svg" alt=""> English</a></li>
                    </ul>
               </div>
          </div>
     </nav>

     <div class="container mt-3">
          <div class="drinkDivClass row mx-auto img-fluid">
               <p class="d-flex justify-content-center align-items-end">
                    Drink
               </p>
          </div>
     </div>

     <div class="container mt-4" id='categories'>

          <?php
          if (!empty($categories)) {
               foreach ($categories as $category) {
                    echo "<div class='drinkCategories leftShadow row mx-auto mb-2'>
                    <a href='drinkCategory.php?UUID={$_GET["UUID"]}&categoryId={$category['id']}' class='d-flex justify-content-center align-items-center mb-0'>{$category['name']}</a>
                </div>";
               }
          } else {
               echo "<div class='drinkCategories leftShadow row mx-auto mb-2'>
               <a href='#' class='d-flex justify-content-center align-items-center mb-0'>No categories yet.</a>
           </div>";
          }
          ?>



     </div>

     <div class="container d-flex justify-content-end sticky-bottom my-2">
          <div class="col-5 backButton">
               <a href="./homePage.php?UUID=<?= $_GET['UUID'] ?>"><span>Back</span></a>
          </div>
     </div>

     <?php require_once __DIR__ . "/layouts/footer.php"; ?>