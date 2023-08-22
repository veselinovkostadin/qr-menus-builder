<?php
require_once __DIR__ . '/parts/header.php';
require_once __DIR__ . '/parts/navbar.php';
?>

<section style="height:100vh">
    <h2 class="mb-3 text-center pt-5">NextMenu</h2>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">

            <form class="border border-dark rounded p-4 text-start loginRegisterForm" action="userRegistration.php" method="POST" id="registerForm">

                <label for="exampleInputFirstName" class="form-label mt-2">First Name</label>
                <div class="input-control">
                    <input type="text" class="inputField form-control w-100 mx-auto mx-lg-0" id="name" name="name" placeholder="ex. John">
                    <div class="error"></div>
                </div>

                <label for="exampleInputLastName" class="form-label mt-2">Last Name</label>
                <div class="input-control">
                    <input type="text" class="inputField form-control w-100 mx-auto mx-lg-0 " id="surname" name="surname" placeholder="ex. Doe">
                    <div class="error"></div>
                </div>

                <label for="exampleInputEmail" class="form-label mt-2">Email</label>
                <div class="input-control">
                    <input type="email" class="inputField form-control w-100 mx-auto mx-lg-0 " id="email" aria-describedby="emailHelp" name="email" placeholder="john@example.com">
                    <div class="error"></div>
                </div>

                <label for="password" class="form-label mt-2">Password</label>
                <div class="input-control">
                    <input type="password" class="inputField form-control  w-100 mx-auto mx-lg-0 " id="password" name="password" placeholder="********">
                    <div class="error"></div>
                </div>

                <label for="password1" class="form-label mt-2">Confirm Password</label>
                <div class="input-control">
                    <input type="password" class="inputField form-control  w-100 mx-auto mx-lg-0 " id="password1" name="confirm_password" placeholder="********">
                    <div class="error"></div>
                </div>

                <div class="mt-4 text-center">
                    <input type="submit" value="REGISTER" class="btn logInBtn">
                </div>

            </form>

        </div>
    </div>

<?php
if (isset($_SESSION["email"])) {
    echo "<div class='alert alert-danger d-flex align-items-center mt-3' role='alert'>
    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle mx-2' viewBox='0 0 16 16'>
  <path d='M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z'/>
  <path d='M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z'/>
</svg>
        <div>
            {$_SESSION["email"]}
        </div>
    </div>";
    unset($_SESSION['email']);
}

?>
</section>


<?php require_once __DIR__ . '/parts/footer.php'; ?>
<script src="./register.js"></script>