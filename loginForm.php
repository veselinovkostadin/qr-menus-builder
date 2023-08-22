<?php
require_once __DIR__ . "/functions/functions.php";
require_once __DIR__ . "/parts/header.php";
require_once __DIR__ . "/parts/navbar.php";

cantAccess();
?>

<section style="height:100vh; position:relative;">
    <h2 class="mb-3 text-center pt-5">NextMenu</h2>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">

            <form class=" border border-dark rounded p-4 text-start loginRegisterForm" action="userLogin.php" method="POST">

                <label for="exampleInputEmail" class="form-label mt-3">Email</label>
                <input type="email" class="inputField form-control w-100 mx-auto mx-lg-0 mb-3" id="exampleInputEmail" aria-describedby="emailHelp" name="email" placeholder="name@example.com">

                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="inputField form-control mb-3 w-100 mx-auto mx-lg-0 " id="exampleInputPassword1" name="password" placeholder="********">

                <div class="d-flex mt-2">

                    <input type="checkbox" name="rememberMe" id="">
                    <label for="rememberMe" class="ms-2">Remember me</label>

                    <a href="" class="ms-auto text-decoration-none">Forgot your password?</a>

                </div>

                <div class="mt-4">
                    <button class="logInBtn rounded-2 px-4 py-1 me-3" name="submit">LOG IN</button>
                </div>

            </form>
        </div>
    </div>


    <?php
    if (isset($_SESSION["errors"])) {
        echo "<div class='alert alert-danger d-flex align-items-center ms-auto me-5 fixed-bottom w-25' role='alert'>
    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle mx-2' viewBox='0 0 16 16'>
  <path d='M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z'/>
  <path d='M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z'/>
</svg>
        <div>
            {$_SESSION["errors"]}
        </div>
    </div>";
        unset($_SESSION['errors']);
    }
    if (isset($_GET['register']) && $_GET['register'] === 'true') {
        echo "<div class='alert alert-success d-flex align-items-center ms-auto me-5 fixed-bottom w-25' role='alert'>
    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-check-circle' viewBox='0 0 16 16'>
  <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
  <path d='M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z'/>
</svg>
</svg>
        <div class='px-2'>
            Registration successfull, you can now log in!
        </div>
    </div>";
    }
    ?>

</section>

<?php
require_once __DIR__ . '/parts/footer.php';

?>
<script src="./script.js"></script>