<?php
require_once __DIR__ . "/../classes/DB.php";
require_once __DIR__ . "/../functions/functions.php";
getHeader();
AuthOnly();

try {
    $db = \Classes\DB::connect();

    $query = $db->prepare("SELECT promotions.* FROM promotions JOIN restaurant ON promotions.restaurant_id = restaurant.id 
         WHERE promotions.restaurant_id = :id and restaurant.user_id = :userId");
    $query->bindParam(":id", $_GET['id']);
    $query->bindParam(":userId", $_SESSION['user']['id']);
    $query->execute();
    $promotions = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    file_put_contents("./../errors.txt", $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location:500.php");
    die();
}
?>
<div class="container mt-5 mb-2">
    <div class="row d-flex justify-content-center">

        <h3 class='mb-5 text-light text-center'>Promotions:</h3>

        <table class="table table-dark table-striped col-lg-10">
            <tr>
                <th>Name:</th>
                <th>Discount %:</th>
                <th>Start date:</th>
                <th>End date:</th>
                <th>Actions:</th>
            </tr>

            <?php
            if (!empty($promotions)) {
                foreach ($promotions as $promotion) {

                    echo " <tr>
                        <td>" . ucfirst($promotion['name']) . "</td>
                        <td>{$promotion['discount']}</td>
                        <td>{$promotion['start_date']}</td>
                        <td>{$promotion['end_date']}</td>
                        <td>
                        <a href='#editModal-{$promotion['id']}' data-bs-toggle='modal' data-bs-target='#editModal-{$promotion['id']}' class='text-decoration-none btn btn-warning px-4'>Edit</a>
                            <a class='text-decoration-none btn btn-danger' href='../deletePromotion.php?id={$promotion['id']}'>Delete</a>
                            
                            <a class='btn btn-info text-decoration-none' href='productsPromotions.php?id={$promotion['id']}'>View products</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>You have no promotions yet.</td></tr>";
            }

            ?>

        </table>
        <!-- Acordition -->
        <?php
        foreach ($promotions as $promotion) {
        ?>

            <div class="modal fade" id="editModal-<?= $promotion['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content bg-light-subtle text-emphasis-light d-flex justify-content-center align-items-center p-4 border-0">
                        <h1 class="">Edit <?= ucfirst($promotion['name']) ?> promotion</h1>
                        <form method="POST" action="./../editPromotion.php?id=<?= $promotion['id'] ?>" class="text-center w-50" id="editform">
                            <div class="mb-3">
                                <label for="name" class="form-label">Promotion name</label>
                                <input type="text" class="form-control" id="editname" name='name' placeholder="Name" value="<?= $promotion['name'] ?>">
                                <div class="error"></div>

                            </div>
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount (%):</label>
                                <input type="number" class="form-control" id="editdiscount" name='discount' placeholder="Discount %" value="<?= $promotion['discount'] ?>">
                                <div class="error"></div>
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start date:</label>
                                <input type="date" class="form-control" id="editstart_date" name='start_date' value="<?= $promotion['start_date'] ?>">
                                <div class="error"></div>
                            </div>

                            <div class=" mb-3 ">
                                <label for="end_date" class="form-label">End date:</label>
                                <input type="date" class="form-control" id="editend_date" name='end_date' value="<?= $promotion['end_date'] ?>">
                                <div class="error"></div>
                            </div>

                            <button type=" submit" class="btn btn-success">Edit promotion</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="accordion" id="addAcordition">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed bg-light-subtle text-emphasis-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" id="accorditionHeader"><span>Add new promotion</span></button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#addAcordition">
                    <div class="accordion-body bg-light-subtle text-emphasis-light d-flex justify-content-center">

                        <form method="POST" action="./../savePromotion.php?id=<?= $_GET['id'] ?>" class="text-center w-50" id="addform">
                            <div class="mb-3">
                                <label for="name" class="form-label">Promotion name</label>
                                <input type="text" class="form-control" id="addname" name='name' placeholder="Name">
                                <div class="error"></div>
                            </div>
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount (%):</label>
                                <input type="number" class="form-control" id="adddiscount" name='discount' placeholder="Discount %">
                                <div class="error"></div>
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start date:</label>
                                <input type="date" class="form-control" id="addstart_date" name='start_date'>
                                <div class="error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="end_date" class="form-label">End date:</label>
                                <input type="date" class="form-control" id="addend_date" name='end_date'>
                                <div class="error"></div>
                            </div>

                            <button type="submit" class="btn btn-success">Add promotion</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-end fixed-bottom mb-5">
            <a href="./../dashboard.php" class='text-decoration-none col-lg-2 col-4 rounded-pill text-center' id="backBtn">
                <span>Go back</span>
            </a>
        </div>

    </div>
</div>

<script src="promotions.js"></script>
<?php
getEnd();
?>