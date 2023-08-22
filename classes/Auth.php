<?php

namespace Classes;

abstract class Auth
{
    public function init()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function setSession($key, $value)
    {
        self::init();
        $_SESSION[$key] = $value;
    }

    public function getSession($key)
    {
        self::init();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return false;
    }
}
