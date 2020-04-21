<?php
namespace MyApp\tests;

use MyApp\classes\auth\Auth;
use MyApp\classes\auth\storage\AuthSessionStorage;
use MyApp\classes\User;


class AuthTest extends \PHPUnit_Framework_TestCase
{
    public function testLogin()
    {
        $user = new User('ww@ww.ww', 'password', 2);
        $authStorage = new AuthSessionStorage('user');
        $auth = new Auth($authStorage);
        $auth->login($user);
        $this->assertEquals($user, $auth->currentUser());
        
    }

    public function testLogout()
    {
        $user = new User('ww@ww.ww', 'password', 2);
        $authStorage = new AuthSessionStorage('user');
        $auth = new Auth($authStorage);
        $auth->login($user);
        $auth->logout();
        $this->assertEquals(true,$auth->isGuest());
    }

    public function testIsGuestTrue()
    {
        $authStorage = new AuthSessionStorage('user');
        $auth = new Auth($authStorage);
        $this->assertEquals(true, $auth->isGuest());
    }

    public function testIsGuestFalse()
    {
        $user = new User('ww@ww.ww', 'password', 2);
        $authStorage = new AuthSessionStorage('user');
        $auth = new Auth($authStorage);
        $auth->login($user);
        $this->assertEquals(false, $auth->isGuest());
    }

    public function testCurrentUser()
    {
        $user = new User('ww@ww.ww', 'password', 2);
        $authStorage = new AuthSessionStorage('user');
        $auth = new Auth($authStorage);
        $auth->login($user);
        $this->assertEquals($user, $auth->currentUser());
        $this->assertEquals('ww@ww.ww', $auth->currentUser()->getEmail());
        $this->assertEquals(2, $auth->currentUser()->getId());
    }


}