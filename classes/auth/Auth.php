<?php


namespace MyApp\classes\auth;

use MyApp\classes\auth\storage\AuthStorageInterface;
use MyApp\classes\User;

class Auth
{
    private $storage;
    private $user;

    public function __construct(AuthStorageInterface $storage)
    {
        $this->storage = $storage;
    }


    public function login(User $user)
    {
        $this->user = $user;
        $this->saveUser();
    }

    public function logout()
    {
        $this->user = null;
        $this->clearUser();
    }

    public function isGuest()
    {
        $this->loadUser();
        return $this->user ? false : true;
    }

    public function currentUser()
    {
        $this->loadUser();
        return $this->user;
    }

    private function loadUser()
    {
        if ($this->user === null) {
            $this->user = $this->storage->load();
        }
    }

    private function saveUser()
    {
        $this->storage->save($this->user);
    }

    private function clearUser()
    {
        $this->storage->clear();
    }


}