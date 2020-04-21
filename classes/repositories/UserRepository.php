<?php


namespace MyApp\classes\repositories;


use MyApp\classes\DB;
use MyApp\classes\User;

class UserRepository implements UserRepositoryInterface
{

    public function add(User $user): int
    {
        $db = DB::getConnection();
        $email=$db->real_escape_string($user->email);
        $password=password_hash($db->real_escape_string($user->password),PASSWORD_DEFAULT);
        $query="INSERT INTO `users` (email,password) VALUES ('$email','$password')";
        if(!$db->query($query)){
            throw new \RuntimeException($db->error);
        }

        return $db->insert_id;

    }

    public function findByEmail(string $email) : User
    {
        $db = DB::getConnection();
        $email=$db->real_escape_string($email);
        $query = "SELECT * FROM `users` WHERE `email` = '$email'";
        if(!$db_result = $db->query($query)){
            throw new \RuntimeException('You provided invalid email or password.');
        }
        $rowUser = $db_result->fetch_array(MYSQLI_ASSOC);
        return new User($rowUser['email'], $rowUser['password'], $rowUser['id']);
    }

}