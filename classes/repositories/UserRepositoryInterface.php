<?php


namespace MyApp\classes\repositories;


use MyApp\classes\User;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return int
     */
    public function add(User $user) :int;

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email) :User;


}