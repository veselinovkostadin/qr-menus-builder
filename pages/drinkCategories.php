<?php
require_once __DIR__ . "/../functions/functions.php";
require_once __DIR__ . "/../classes/DB.php";

getHeader();
AuthOnly();


try {
    $db = \Classes\DB::connect();

    $query = $db->prepare("SELECT categories.*,restaurant.user_id FROM categories JOIN restaurant on menu_id = restaurant.id WHERE menu_id = :id and belongs_to = 2");
    $query->bindParam(":id", $_GET['id']);
    // $query->bindParam(":userId", $_SESSION['user']['id']);
    $query->execute();
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    file_put_contents("./../errors.txt", $e->getMessage() . PHP_EOL, FILE_APPEND);
}



if (!empty($categories)) {
    $allowedUser = $categories[0]['user_id'];
    if ($_SESSION['user']['id'] != $allowedUser) {
        header("Location:404.php");
        die();
    }
}
if (empty($categories)) {
    $categories = "No existing categories.";
}

?>
<div class="container mt-5 mb-2">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10 text-center" id="content-wraper">

            <h2 class='mb-5 fw-bold'>Drink</h2>
            <!-- categories -->
            <?php
            if (is_array($categories)) {
                foreach ($categories as $category) { ?>

                    <div class="accordion" id="editAcordition-<?= $category['id'] ?>">
                        <div class="accordion-item my-3 bg-transparent" style="border-radius: 10px;">
                            <div class="accordion-header d-flex p-2" id='orangeButtons'>
                                <a href="products.php?id=<?= $category['id'] ?>" class=' ms-4 fs-3 text-decoration-none ' style=' color: #D9D9D9;'><?= $category['name'] ?></a>
                                <div class="ms-auto d-flex align-items-center border-0">
                                    <button class=" collapsed btn text-dark  me-5 rounded-pill" style=' width:80px; background-color:  #D9D9D9;' type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?= $category['id'] ?>" aria-expanded="false" aria-controls="collapseOne"><span style='color: black'>Edit</span></button>
                                    <a href="#deleteCategoryModal-<?= $restaurant['id']; ?>" data-bs-toggle='modal' data-bs-target='#deleteCategoryModal-<?= $category['id']; ?>' class='btn btn-danger me-5 rounded-pill text-white' style='width: 80px'>Delete</a>
                                    <a href="products.php?id=<?= $category['id'] ?>" class="text-decoration-none" style="color: #D9D9D9;"><i class='bi bi-arrow-right me-4 fs-3'></i></a>
                                </div>
                            </div>
                            <div id="collapseOne-<?= $category['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#editAcordition-<?= $category['id'] ?>">
                                <div class="accordion-body" id="accorditionBody" style="border-radius: 10px;">
                                    <h2 class="mb-5">Edit <?= $category['name'] ?></h2>
                                    <form action="./../editCategory.php?id=<?= $category['id'] ?>" method="POST">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label for="accorditionInput" class="text-dark">Category name:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" name='category' placeholder="ex. Salads" id='accorditionInput' value="<?= $category['name'] ?>">
                                            </div>
                                            <input type="hidden" name='belongs' value='1'>
                                        </div>
                                        <div class="row d-flex justify-content-end my-3">
                                            <input type="submit" class="btn col-lg-4 col-5" value='Submit' id='submitBtnAcr'>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="deleteCategoryModal-<?= $category['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id=deleteCategoryModal-<?= $category['id']; ?>>Delete <?= $category['name']; ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>Are you sure you want to delete this category?</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                    <a href="../deleteCategory.php?id=<?= $category['id']; ?>" class="btn btn-primary">Delete Category</a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php  }
            } else { ?>
                <a href='' style='text-decoration:none;'>
                    <div class='col-12 my-3 p-2 d-flex justify-content-center' id='orangeButtons'>
                        <span class='ms-4'><?= $categories ?></span>
                    </div>
                </a>
            <?php } ?>
            <!-- Acordition -->

            <div class="accordion" id="addAcordition">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" id="accorditionHeader"><span style='color:white'>Add new category</span></button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#addAcordition">
                        <div class="accordion-body" id='accorditionBody'>

                            <form action="./../saveCategory.php?id=<?= $_GET['id'] ?>" method="POST" id="form">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="accorditionInput">Category name:</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name='category' placeholder="ex. Beer" id='categoryname'>
                                        <p class="text-start fs-5 fw-bold" id="error"></p>
                                    </div>
                                    <input type="hidden" name='belongs' value='2'>
                                </div>
                                <div class="row d-flex justify-content-end my-3">
                                    <input type="submit" class="btn col-lg-4 col-5" value='Submit' id='submitBtnAcr'>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>

        <a href="./../dashboard.php" class='text-decoration-none col-lg-1 col-4 rounded-pill text-center fixed-bottom mb-5 ms-auto me-4' id="backBtn">
            <span>Go back</span>
        </a>


    </div>
</div>
<script src="categories.js"></script>
<?php
getEnd();
?>