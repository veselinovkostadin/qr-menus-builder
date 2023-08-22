<?php
require_once __DIR__ . "/../classes/DB.php";
require_once __DIR__ . "/../functions/functions.php";
getHeader();
AuthOnly();
try {
    $db = \Classes\DB::connect();

    $query = $db->prepare("SELECT promotions.*,products.id as pid,products.name as pname, products.price as price,restaurant.id as rest_id FROM promotions JOIN restaurant ON promotions.restaurant_id = restaurant.id 
        JOIN products ON promotions.id = products.promotion_id 
            WHERE products.promotion_id = :id and restaurant.user_id = :userId");
    $query->bindParam(":id", $_GET['id']);
    $query->bindParam(":userId", $_SESSION['user']['id']);
    $query->execute();
    $promotions = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    file_put_contents("./../errors.txt", $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location:500.php");
    die();
}

// print_r($promotions);
// die();
if (empty($promotions)) {
    $query = $db->prepare("SELECT promotions.*,restaurant.id from promotions JOIN restaurant ON promotions.restaurant_id = restaurant.id WHERE restaurant.user_id = :userId and promotions.id = :id");
    $query->execute([':userId' => $_SESSION['user']['id'], ":id" => $_GET['id']]);
    $promotions = $query->fetchAll(PDO::FETCH_ASSOC);
}


?>

<div class="container-lg text-light mt-3">
    <div class="row">
        <h2 class='text-center'>Products in <?= $promotions[0]['name'] ?></h2>
        <div>
            <h3>Promotion info:</h3>
            <ul class='d-lg-flex justify-content-between'>
                <li class='col-lg-3 col-12'>Name: <?= $promotions[0]['name'] ?></li>
                <li class='col-lg-3 col-12'>Discount: <?= $promotions[0]['discount'] ?>%</li>
                <li class='col-lg-3 col-12'>From: <?= $promotions[0]['start_date'] ?></li>
                <li class='col-lg-3 col-12'>To: <?= $promotions[0]['end_date'] ?></li>
            </ul>
        </div>
    </div>
    <div class="row mb-3">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Product name:</th>
                    <th>Product price:</th>
                    <th>Action:</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ((isset($promotions[0]['pname'])) && (isset($promotions[0]['price']))) {
                    foreach ($promotions as $promotion) {
                        echo "<tr>
                        <td>{$promotion['pname']}</td>
                        <td>{$promotion['price']}</td>
                        <td><a href='./../removeProductPromotion.php?id={$promotion['pid']}' class='btn btn-danger p-1'>Remove</a></td>
                    </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No products in this promotion yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


    <a class='text-decoration-none col-lg-2 col-4 rounded-pill text-center fixed-bottom ms-auto mb-5 me-4' id="backBtn" href="./../pages/promotions.php?id=<?= $promotions[0]['restaurant_id'] ?>">Go back</a>

</div>


<? getEnd() ?>