<?php


namespace MyApp\classes\auth\storage;


use MyApp\classes\User;

class AuthSessionStorage implements AuthStorageInterface
{
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function load()
    {
        return isset($_SESSION[$this->key]) ? unserialize($_SESSION[$this->key]) : null;
    }

    public function save(User $user)
    {
        $_SESSION[$this->key] = serialize($user);
    }

    public function clear()
    {
        unset($_SESSION[$this->key]);
    }

}