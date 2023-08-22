<?php
session_start();
require_once __DIR__ . '/classes/DB.php';
require_once __DIR__ . '/consts.php';
require_once __DIR__ . "/functions/functions.php";
AuthOnly();


use Classes\DB;

$db = DB::connect();

$user_id = $_SESSION['user']['id'];

$query = $db->prepare('SELECT * FROM restaurant WHERE user_id = :user_id');
$query->bindParam(':user_id', $user_id);
$query->execute();

$restaurants = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    body {
        overflow-x: hidden;
        background-color: #252A2D;
    }


    .restaurant-card {
        width: 350px;
        background: #D9D9D9;
        box-shadow: inset 0px 10px 7px rgba(0, 0, 0, 0.25);
        border-radius: 35px;
        position: absolute;
        padding-top: 25px;
        transition: filter 0.25s;
    }

    .restaurant-card:hover {
        filter: drop-shadow(0px 0px 8px rgba(255, 255, 255, 0.7));
    }

    .plus-restaurant-card {
        text-decoration: none;
        width: 350px;
        height: 500px;

        background: rgba(217, 217, 217, 1);
        border: 5px dashed #D9D9D9;
        box-shadow: inset 0px 10px 7px rgba(0, 0, 0, 0.25);
        border-radius: 35px;
        transition: filter 0.25s
    }

    .plus-restaurant-card:hover {
        filter: drop-shadow(0px 0px 8px rgba(255, 255, 255, 0.7));
    }

    .add-restaurant {
        width: 150px;
        height: 150px;

        background-color: #E67226;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    }

    .restaurantCardButtons {
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border: none;
        border-radius: 10px;
    }

    #heading {
        color: #D9D9D9;
        font-family: Georgia, serif;
        font-weight: 700;
        transition: text-shadow 0.3s;
    }

    #heading:hover {
        text-shadow: 1px 2px 4px rgba(255, 255, 255, 0.4);
    }

    #logout {
        background-color: #E67226;
        font-size: 18px;
        font-weight: 700;
        color: #D9D9D9;
        transition: background-color 0.2s, box-shadow 0.2s;
    }

    #logout:hover {
        background-color: #dd8245;
        box-shadow: 2px 4px 2px rgba(0, 0, 0, 0.35);
    }

    .restaurantCardButtons:hover {
        box-shadow: 2px 4px 2px rgba(0, 0, 0, 0.45);
    }

    .qrImg {
        border: 2px solid #E67226;
        width: 250px;
        height: 250px;
        box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.35);
    }

    #welcome-heading {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 800;
        font-size: 28px;
    }

    form {

        background: #E67226;
        box-shadow: inset 0px 10px 7px rgba(0, 0, 0, 0.25);
        border-radius: 35px;

        font-family: 'Inter';
        font-style: normal;
        font-size: 35px;
    }

    form input[type='radio'] {
        width: 28px;
        height: 28px;
    }

    form input[type='radio']:checked {
        background-color: #252A2D;
        filter: drop-shadow(0px 0px 8px rgba(0, 0, 0, 0.75));
    }

    form input[type='checkbox']:checked {
        background-color: #252A2D;
    }
</style>
</head>

<body>

    <div class="container-fluid">
        <div class="row d-flex g-0">


            <div class="col-12">

                <div class="row d-flex px-3 py-2" style='background-color:rgba(217, 217, 217, 1);'>
                    <div class="col d-flex">
                        <h3 id='welcome-heading'>Welcome <?= $_SESSION['user']['name'] . " " . $_SESSION["user"]['surname']; ?></h3>
                        <a href="logout.php" class="ms-auto btn" id='logout'>LOGOUT</a>
                    </div>
                </div>



                <div class="row mx-4 d-flex px-4 py-3">

                    <h2 class="mb-5 text-center" id='heading'>Your Restaurants:</h2>

                    <?php
                    foreach ($restaurants as $restaurant) { ?>
                        <div class='col-12 col-lg-4 mb-5 '>
                            <div class='restaurant-card pb-4'>
                                <h1 class='text-center'><?= $restaurant['name'] ?></h1>
                                <div class=' d-flex justify-content-center w-100 mt-4'>
                                    <?php

                                    echo  '<img src="' . generateImageLink($restaurant['qr_code'])  . '" alt="qrcode" class="qrImg">';
                                    ?>
                                </div>
                                <div class="col-10 mx-auto text-center mt-2 fw-bold">
                                    <span>Wifi password: <?= $restaurant['wifi_password'] ?></span><br>
                                    <span>Address: <?= $restaurant['address'] ?></span>
                                </div>

                                <div class='mt-1 w-100 d-flex justify-content-center flex-wrap'>
                                    <?php
                                    if ($restaurant['food'] == 1) {
                                        echo "<a href='./pages/foodCategories.php?id={$restaurant['id']}' class='col-7 mt-2 btn btn-success restaurantCardButtons' style='background-color:#E67226;'>Add food category</a>";
                                    }
                                    if ($restaurant['drink'] == 1) {
                                        echo "<a href='./pages/drinkCategories.php?id={$restaurant['id']}' class='col-7 mt-2 btn btn-success restaurantCardButtons' style='background-color:#E67226;'>Add drink category</a>";
                                    }

                                    $image = explode("/", $restaurant["qr_code"]);
                                    $imageToDelete = $image[2];
                                    ?>
                                    <a href='./pages/promotions.php?id=<?= $restaurant["id"] ?>' class='col-7 mt-2 btn btn-success restaurantCardButtons' style='background-color:#E67226;'>Add promotions</a>
                                </div>
                                <div class="d-flex justify-content-center flex-wrap">
                                    <a href="downloadImage.php?image=<?= $restaurant["qr_code"] ?>" class='btn btn-primary col-5 me-3 w-25 mt-2 restaurantCardButtons' style='background-color: #4c6de0;'><i class="bi bi-download "></i></a>
                                    <a href="./frontend/homePage.php?UUID=<?= $restaurant["UUID"] ?>" target="_blank" class='btn btn-primary col-5 ms-3 w-25 mt-2 restaurantCardButtons' style='background-color: #F0BC60;'>Menu</a>
                                </div>
                                <div class="d-flex justify-content-center flex-wrap ">
                                    <a href='#editModal-<?php echo $restaurant['id']; ?>' data-bs-toggle='modal' data-bs-target='#editModal-<?php echo $restaurant['id']; ?>' class='btn col-5 w-25  mt-2 me-3  restaurantCardButtons' style=' background-color: #F0BC60;'>Edit</a>
                                    <a href="#deleteModal-<?php echo $restaurant['id']; ?>" data-bs-toggle='modal' data-bs-target='#deleteModal-<?php echo $restaurant['id']; ?>' class='btn col-5 w-25 ms-3 mt-2 restaurantCardButtons' style='background-color: #AA2323; color:#D9D9D9;'>Delete</a>
                                </div>
                            </div>

                        </div>

                        <div class="modal fade" id="editModal-<?php echo $restaurant['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content bg-transparent border-0">


                                    <form class="row g-3 py-5 px-3" action="editRestaurant.php?id=<?= $restaurant['id']; ?>&img=<?= $imageToDelete ?>" id="editform" method="POST">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <h1 class="" id=editModal-<?php echo $restaurant['id']; ?>> <b> Edit <?php echo $restaurant['name']; ?></b>
                                                </h1>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <label for="name" class="form-label">Name:</label>
                                            <input type="text" class="form-control" name="rest_name" id="editrestname" value="<?php echo $restaurant['name']; ?>">
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <label for="inputPassword4" class="form-label">Wi-fi Password:</label>
                                            <input type="text" class="form-control" id="editwifipassword" name="wifi_password" value="<?php echo $restaurant['wifi_password']; ?>">
                                        </div>

                                        <div class="col-lg-6">
                                            <label for="address" class="form-label">Address:</label>
                                            <input type="text" class="form-control" id="editaddress" name="address" value="<?php echo $restaurant['address']; ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="phone_number" class="form-label">Phone number:</label>
                                            <input type="text" class="form-control" id="editphonenumber" name="phone" value="<?php echo $restaurant['phone']; ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="inputCity" class="form-label">Menu categories:</label>
                                            <br>

                                            <?php
                                            if ($restaurant['food'] == 1 && $restaurant['drink'] == 1) { ?>
                                                <input class="form-check-input" type="radio" name="categories" id="editfood" value="2">
                                                <label class="form-check-label" for="inlineRadio1">Food</label><br>
                                                <input class="form-check-input" type="radio" name="categories" id="editdrink" value="1">
                                                <label class="form-check-label" for="inlineRadio2">Drink</label><br>
                                                <input class="form-check-input" type="radio" name="categories" id="editboth" value="3" checked>
                                                <label class="form-check-label" for="inlineRadio3">Both</label>
                                            <?php } else if ($restaurant['food'] == 1 && $restaurant['drink'] == 0) { ?>
                                                <input class="form-check-input" type="radio" name="categories" value="2" checked>
                                                <label class="form-check-label" for="inlineRadio1">Food</label><br>
                                                <input class="form-check-input" type="radio" name="categories" value="1">
                                                <label class="form-check-label" for="inlineRadio2">Drink</label><br>
                                                <input class="form-check-input" type="radio" name="categories" value="3">
                                                <label class="form-check-label" for="inlineRadio3">Both</label>

                                            <?php } else { ?>
                                                <input class="form-check-input" type="radio" name="categories" value="2">
                                                <label class="form-check-label" for="inlineRadio1">Food</label><br>
                                                <input class="form-check-input" type="radio" name="categories" value="1" checked>
                                                <label class="form-check-label" for="inlineRadio2">Drink</label><br>
                                                <input class="form-check-input" type="radio" name="categories" value="3">
                                                <label class="form-check-label" for="inlineRadio3">Both</label>
                                            <?php } ?>

                                        </div>

                                        <div class="col-lg-6">
                                            <label for="inputCity" class="form-label">Menu languages:</label>
                                            <br>
                                            <?php
                                            if ($restaurant['menu_language'] == 'english') { ?>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="editmkd" name="menu_language" value="macedonian">
                                                    <label class="form-check-label" for="inlineCheckbox1">Macedonian</label>
                                                </div>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="editeng" name="menu_language" value="english" checked>
                                                    <label class="form-check-label" for="inlineCheckbox2">English</label>
                                                </div>
                                            <?php } else { ?>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="menu_language" value="macedonian" checked>
                                                    <label class="form-check-label" for="inlineCheckbox1">Macedonian</label>
                                                </div>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="menu_language" value="english">
                                                    <label class="form-check-label" for="inlineCheckbox2">English</label>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn  w-50" style=' background-color: #252A2D; color: #D9D9D9;font-family: " Inter"; font-style: normal; font-weight: 500; font-size: 35px;'>Proceed</button>
                                        </div>
                                    </form>
                                </div>



                            </div>
                        </div>


                        <div class="modal fade" id="deleteModal-<?php echo $restaurant['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id=deleteModal-<?php echo $restaurant['id']; ?>>Delete <?php echo $restaurant['name']; ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>Are you sure you want to delete this restaurant?</div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                        <a href="removeRestaurant.php?id=<?php echo $restaurant['id']; ?>&img=<?= $imageToDelete ?>" class="btn btn-primary">Delete Restaurant</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                    <div class="plus-restaurant-card d-flex justify-content-center align-items-center ms-2">
                        <div class="add-restaurant rounded-circle d-flex justify-content-center align-items-center">
                            <button type="button" class=" display-1 btn h-100 w-100 rounded-circle btn-primary fs-1" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #E67226;">
                                +
                            </button>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content bg-transparent border-0">


                                <form class="row g-3 py-5 px-3" action="restaurantRegistration.php" method="POST" id="addform">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <h1> <b>Add new restaurant</b> </h1>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="inputEmail4" class="form-label">Name:</label>
                                        <input type="text" class="form-control" id="restname" name="rest_name" placeholder='MyRestaurant..'>
                                        <div class="error"></div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="wifi" class="form-label">Wi-fi Password:</label>
                                        <input type="text" class="form-control" id="wifipassword" name="wifi_password" placeholder='wifi1234'>
                                        <div class="error"></div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="hehe" class="form-label">Address:</label>
                                        <input type="text" class="form-control" id="addaddress" name="address" placeholder='Address'>
                                        <div class="error"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="phone" class="form-label">Phone number:</label>
                                        <input type="text" class="form-control" id="phonenumber" name="phone" placeholder='e.g. 070123123'>
                                        <div class="error"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="inputCity" class="form-label">Menu categories:</label>
                                        <br>
                                        <input class="form-check-input" type="radio" name="categories" id="food" value="2">
                                        <label class="form-check-label" for="inlineRadio1">Food</label><br>
                                        <input class="form-check-input" type="radio" name="categories" id="drink" value="1">
                                        <label class="form-check-label" for="inlineRadio2">Drink</label><br>
                                        <input class="form-check-input" type="radio" name="categories" id="both" value="3">
                                        <label class="form-check-label" for="inlineRadio3">Both</label>
                                        <div class="error"></div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="inputCity" class="form-label">Menu languages:</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="mkd" name="menu_language" value="macedonian">
                                            <label class="form-check-label" for="inlineCheckbox1">Macedonian</label>
                                        </div>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="eng" name="menu_language" value="english">
                                            <label class="form-check-label" for="inlineCheckbox2">English</label>
                                            <div class="error"></div>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn  w-50" style=' background-color: #252A2D; color: #D9D9D9;font-family: " Inter"; font-style: normal; font-weight: 500; font-size: 35px;'>Add</button>
                                    </div>
                                </form>
                            </div>



                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="restaurants.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>