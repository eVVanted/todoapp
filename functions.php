<?php
require("classes/db.php");
require("classes/user.php");
require("classes/todo.php");

$uri = $_SERVER['REQUEST_URI'];
$form_invalid = false;
$error_message = '';
$todos_array = [];
$parent_id = 0;
$edit_todo = [];
$error = false;


if($uri === '/' && isset($_COOKIE['is_logded_in']) && $_COOKIE['is_logded_in']){
    $todos_array = Todo::getTodos($_COOKIE['logged_in_user_id']);
//    var_dump($todos_array);
}

if(isset($_GET['sub']) && stripos ( $uri, '/?sub=') >=0 && isset($_COOKIE['is_logded_in']) && $_COOKIE['is_logded_in']){
    $parent_id = $_GET['sub'];
    $todos_array = Todo::getSubTodos($_COOKIE['logged_in_user_id'], $_GET['sub']);
}

if(isset($_GET['sub']) && stripos ( $uri, '/taskform.php?sub=') >=0 && isset($_COOKIE['is_logded_in']) && $_COOKIE['is_logded_in']){
    $parent_id = $_GET['sub'];
}
if(isset($_GET['edit']) && stripos ( $uri, '/taskform.php?edit=') >=0 && isset($_COOKIE['is_logded_in']) && $_COOKIE['is_logded_in']){
    $edit_todo = Todo::getTodoById($_GET['edit']);
}

if(isset($_POST['action-delete']) && isset($_COOKIE['is_logded_in']) && $_COOKIE['is_logded_in']){
    $result = Todo::delete($_POST['id']);
    if($result['error']){
        $error = true;
        $error_message = $result['message'];
    }else {
        header('Location: /');
    }
}

if(isset($_POST['action-done']) && isset($_COOKIE['is_logded_in']) && $_COOKIE['is_logded_in']){
    Todo::done($_POST['id']);
    if($result['error']){
        $error = true;
        $error_message = $result['message'];
    }else {
        header('Location: /');
    }
}


if(isset($_POST['action-task-form']) && isset($_COOKIE['is_logded_in']) && $_COOKIE['is_logded_in']){
    if(strlen( trim($_POST['title'])) > 0 && strlen( trim($_POST['text'])) > 0 && strlen( trim($_POST['datetime'])) > 0){
        $date = date('Y-m-d H:i');
        if($date < $_POST['datetime']){
            if(isset($_POST['id'])){
                $result = Todo::updateTodo($_POST['id'],trim($_POST['title']), trim($_POST['text']), trim($_POST['datetime']));
            }else{
                $result = Todo::addTodo(trim($_POST['title']), trim($_POST['text']), trim($_POST['datetime']), $_COOKIE['logged_in_user_id'], isset($_POST['parent_id'])?$_POST['parent_id']:0);
            }
            if($result['error']){
                $form_invalid = true;
                $error_message = $result['message'];
            }else {
                header('Location: /');
            }

        } else {
            $form_invalid = true;
            $error_message = ' The date cannot be in past.';
        }
    } else {
        $form_invalid = true;
        $error_message = ' Please fill all the fields and try again.';
    }
}

if(isset($_POST['action-register'])){
    if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", trim ($_POST['email']))) {
        if(strlen ( trim ($_POST['password'])) < 4){
            $form_invalid = true;
            $error_message = ' The password must be at least 4 characters in length.';
        } else{
            if(trim ($_POST['password']) !== trim ($_POST['password2'])) {
                $form_invalid = true;
                $error_message = ' Your new password and confirmation password do not match. Please confirm and try again.';
            } else {
                $result = User::register(trim($_POST['email']), trim($_POST['password']));
                if($result['error']){
                    $form_invalid = true;
                    $error_message = $result['message'];
                }else {
                    header('Location: /');
                }
            }
        }
    }else{
        $form_invalid = true;
        $error_message = ' Enter correct email.';
    }
}

if(isset($_POST['action-login'])){
    if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", trim ($_POST['email']))) {
        if(strlen ( trim ($_POST['password'])) < 4){
            $form_invalid = true;
            $error_message = ' The password must be at least 4 characters in length.';
        } else{
            $result = User::isUserValid(trim ($_POST['email']), trim ($_POST['password']));
            if($result['error']){
                $form_invalid = true;
                $error_message = $result['message'];
            }else {
                header('Location: /');
            }
        }
    }else{
        $form_invalid = true;
        $error_message = ' Enter correct email.';
    }
}

if(isset($_POST['action-logout'])){
    setcookie('logged_in_user',false);
    setcookie('is_logded_in',false);
    header('Location: /');

}



