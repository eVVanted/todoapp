<?php


namespace MyApp\classes\services;


use MyApp\classes\forms\UserLoginForm;
use MyApp\classes\forms\UserRegisterForm;
use MyApp\classes\User;
use MyApp\classes\repositories\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRegisterForm $form): User
    {
        $user = new User($form->email, $form->password);
        $userId = $this->userRepository->add($user);
        $user->password = '';
        $user->id = $userId;
        return $user;
    }


    public function login(UserLoginForm $form): User
    {

        $user = $this->userRepository->findByEmail($form->email);
        if(!password_verify($form->password, $user->password)){
            throw new \RuntimeException('You provided invalid email or password.');
        }
        $user->password = '';
        return $user;
    }

}