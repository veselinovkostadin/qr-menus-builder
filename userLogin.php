<?php

require_once __DIR__ . '/classes/DB.php';
require_once __DIR__ . '/classes/UserRepository.php';


use Classes\DB;
use Classes\UserRepository;


$email = $_POST['email'];
$password = $_POST['password'];

$db = DB::connect();
$userRepo = new UserRepository($db);

$userRepo->login($email, $password);
