<?php
if (!isset($_SESSION['user'])) {
    echo "<nav class='navbar navbar-expand-lg fixed-top' id='navBar'>
    <div class='container-fluid w-75 mt-2'>
        <a class='ms-4 me-5 text-decoration-none h3 ' href='index.php'>NextMenu</a>

        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>

        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mx-auto mb-2 mb-lg-0'>
                <li class='nav-item'>
                    <a class='nav-link me-3 navLink' href='./index.php'>Home</a>
                </li>
              
                <li class='nav-item'>
                    <a class='nav-link me-3 navLink' href='#features'>Features</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link me-3 navLink' href='#howItWorks'>How It Works?</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link me-3 navLink' href='#aboutUs'>About Us</a>
                </li>
                </ul>
                <a href='loginForm.php' class='logInBtn rounded-5 px-4 py-1 me-3'>Log In</a>
                <a href='registerForm.php' class='registerBtn rounded-5 px-4 py-1 me-3'>Register</a>
                
        </div>
    </div>
</nav>";
} else {
    echo "<nav class='navbar navbar-expand-lg bg-body-tertiary fixed-top' id='navBar'>
    <div class='container-fluid'>
        <a class='ms-4 me-5 text-decoration-none h3 ' href='index.php'>NextMenu</a>

        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='d-flex align-content-center'>
            <h5>Welcome, {$_SESSION['user']['name']}</h5>
        </div>
        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mb-2 mb-lg-0'>
                <li class='nav-item'>
                    <a class='nav-link active me-3' aria-current='page' href='dashboard.php'>Home</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='logout.php'>Log out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>";
}
