<?php

namespace Classes;

session_start();

class Restaurant
{
    private $name;
    private $phone;
    private $address;
    private $wifi_password;
    private $menu_language;
    private $user_id;
    private $QrCode;
    private $food;
    private $drink;
    private $uuid;

    public function __construct($name, $phone, $address, $wifi_password, $menu_language, $path, $food, $drink, $uuid)
    {
        $this->setName($name)->setPhone($phone)->setAddress($address)->setWifiPassword($wifi_password)->setMenuLanguage($menu_language)->setQrCode($path)->setFood($food)->setDrink($drink)->setUUid($uuid);
    }

    public function setUUid($uuid)
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getUUid()
    {
        return $this->uuid;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
    public function setWifiPassword($wifi_password)
    {
        $this->wifi_password = $wifi_password;
        return $this;
    }

    public function setMenuLanguage($menu_language)
    {
        $this->menu_language = $menu_language;
        return $this;
    }
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getWifiPassword()
    {
        return $this->wifi_password;
    }

    public function getMenuLanguage()
    {
        return $this->menu_language;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setQrCode($path)
    {
        $this->QrCode = $path;
        return $this;
    }
    public function getQrCode()
    {
        return $this->QrCode;
    }

    public function setFood(int $food)
    {
        $this->food = $food;
        return $this;
    }

    public function setDrink(int $drink)
    {
        $this->drink = $drink;
        return $this;
    }

    public function getFood()
    {
        return $this->food;
    }
    public function getDrink()
    {
        return $this->drink;
    }
}
