<?php
require_once __DIR__ . "/../consts.php";

function AuthOnly()
{
    // echo APP_PATH;
    // die();
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['user']) || is_null($_SESSION['user'])) {
        header("Location:" . APP_URL .  "/loginForm.php");
        die();
    }
}

function cantAccess()
{
    if (isset($_SESSION['user'])) {
        header("Location:dashboard.php");
        die();
    }
}

function generateImageLink($imageName)
{
    return APP_URL . "/$imageName";
}


function getHeader($arg = 0)
{
    if ($arg == 0) {
        require_once __DIR__ . "/../parts/headerAdmin.php";
    } else {
        require_once __DIR__ . "/../parts/headerAdmin.php";
        require_once __DIR__ . "/../parts/navbar.php";
    }
}

function getEnd($arg = 0)
{
    // dokolku se pusti nekoj broj vo ovaa funkcija ke se dodade i footerot
    if ($arg == 0) {
        require_once __DIR__ . "/../parts/end.php";
    } else {
        require_once __DIR__ . "/../parts/footer.php";
        require_once __DIR__ . "/../parts/end.php";
    }
}


function deleteFolder($folderPath)
{
    if (!is_dir($folderPath)) {
        return false;
    }

    $files = glob($folderPath . '/*');

    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteFolder($file);
        } else {
            unlink($file);
        }
    }

    rmdir($folderPath);
    return true;
}

function generateProductImage($image)
{
    if (empty(NGROK)) {

        return APP_URL . "/restaurants/" . $image;
    }
    return NGROK . NGROK_REST . "/restaurants/" . $image;
}

function generateProductImageAdmin($image)
{
    return APP_URL . "/restaurants/" . $image;
}
