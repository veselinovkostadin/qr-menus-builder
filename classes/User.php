<?php

namespace Classes;

class User
{
    private $id;
    private $name;
    private $surname;
    private $password;
    private $email;

    public function __construct($name, $surname, $email, $password)
    {
        $this->setName($name)->setSurname($surname)->setEmail($email)->setPassword($password);
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function getId(){
        return $this->id;
    }
}
