<?php

namespace MyApp\classes\auth\storage;

use MyApp\classes\User;

interface AuthStorageInterface
{
    /**
     * @return User
     */
    public function load();

    /**
     * @param User $user
     */
    public function save(User $user);

    /**
     * @return Void
     */
    public function clear();

}