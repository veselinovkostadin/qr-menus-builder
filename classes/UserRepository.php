<?php

namespace Classes;

session_start();

use Classes\Auth as ClassesAuth;
use Classes\User;
use Classes\DB;
use Classes\Auth;

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    public function save(User $user)
    {
        $query = "INSERT INTO users (name, surname, email, password) VALUES (:name, :surname, :email, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':name' => $user->getName(),
            ':surname' => $user->getSurname(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword()
        ]);
    }

    public function login($email, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);


        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
            die();
        } else {
            $_SESSION["errors"] = "Invalid credentials.";
            header("Location:loginForm.php");
            die();
        }
    }
}
