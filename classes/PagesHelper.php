<?php
namespace MyApp\classes;


class PagesHelper
{
    const HOME = '/';
    const LOGIN = '/login.php';
    const REGISTER = '/register.php';
    const TODO_FORM = '/todoform.php';

    public static function currentPage()
    {
        if(strpos($_SERVER['REQUEST_URI'], "?"))
        return substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "?"));
        return $_SERVER['REQUEST_URI'];
    }

    public static function goHome()
    {
        header('Location: /');
    }

    public static function goToTodos($parent_id)
    {
        header('Location: /' . ($parent_id ? '?sub='.$parent_id : ''));
    }

    public static function isActionRegister()
    {
        return isset($_POST['action-register']);
    }

    public static function isActionLogin()
    {
        return isset($_POST['action-login']);
    }

    public static function isActionLogout()
    {
        return isset($_POST['action-logout']);
    }

    public static function isActionDelete()
    {
        return isset($_POST['action-delete']);
    }

    public static function isActionDone()
    {
        return isset($_POST['action-done']);
    }

    public static function getTodoParentId()
    {
        return isset($_GET['sub']) ? $_GET['sub'] : 0;
    }

    public static function isHome()
    {
        return self::currentPage() == self::HOME;
    }

    public static function isLoginPage()
    {
        return self::currentPage() == self::LOGIN;
    }

    public static function isRegisterPage()
    {
        return self::currentPage() == self::REGISTER;
    }

    public static function isPageCreateTodo()
    {
        return self::currentPage() == self::TODO_FORM && !isset($_GET['edit']);
    }

    public static function isPageEditTodo()
    {
        return self::currentPage() == self::TODO_FORM && isset($_GET['edit']) && $_GET['edit'];
    }

    public static function getTodoId()
    {
        return isset($_GET['edit']) ? $_GET['edit'] : 0;
    }

    public static function getDeletingId()
    {
        return (self::isActionDelete() && isset($_POST['id'])) ? $_POST['id'] : 0;
    }

    public static function getDoneId()
    {
        return (self::isActionDone() && isset($_POST['id'])) ? $_POST['id'] : 0;
    }

}