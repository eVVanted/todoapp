<?php
namespace MyApp\classes;


class User {
    public $id;
    public $email;
    public $password;

    public function __construct( $email, $password, $id = null) {
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
    }
}

