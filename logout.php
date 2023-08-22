<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: {$_SERVER['HTTP_REFERER']}");
    die();
}
session_destroy();

header("Location: index.php");
die();
