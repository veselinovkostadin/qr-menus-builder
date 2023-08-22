<?php

require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/DB.php';
require_once __DIR__ . '/classes/UserRepository.php';


use Classes\User;
use Classes\DB;
use Classes\UserRepository;

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);


$db = DB::connect();
$userRepo = new UserRepository($db);

$user = new User($name, $surname, $email, $password);
try{
$userRepo->save($user);
}
catch(PDOException $e){
$_SESSION['email'] = "Email must be unique";
header("Location: registerForm.php");
die();
}

header("Location: loginForm.php?register=true");
