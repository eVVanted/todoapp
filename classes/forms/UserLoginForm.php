<?php


namespace MyApp\classes\forms;

use InvalidArgumentException;

class UserLoginForm
{
    public $email;
    public $password;

    public function load(array $post) :bool
    {
        if (!isset($post['action-login']))
            return false;
        $this->email = trim($post['email']);
        $this->password = trim($post['password']);

        return true;
    }

    public function validate() :bool
    {
        $this->validateNotEmptyEmail();
        $this->validateNotEmptyPassvord();
        $this->validateEmail();
        $this->validatePasswordLength();

        return true;
    }

    private function validateNotEmptyEmail() :void
    {
        if (empty($this->email)) {
            throw new InvalidArgumentException('Please fill email.');
        }
    }
    private function validateNotEmptyPassvord() :void
    {
        if (empty($this->password)) {
            throw new InvalidArgumentException('Please fill password.');
        }
    }

    private function validateEmail() :void
    {
        if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $this->email)) {
            throw new InvalidArgumentException('Please enter valid email.');
        }
    }

    private function validatePasswordLength() :void
    {
        if (strlen($this->password) < 4) {
            throw new InvalidArgumentException('The password must be at least 4 characters in length.');
        }
    }


}