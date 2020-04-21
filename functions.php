<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start() ;



use MyApp\classes\auth\Auth;
use MyApp\classes\dispatchers\EventDispatcher;
use MyApp\classes\events\TodoDeleteEvent;
use MyApp\classes\forms\TodoForm;
use MyApp\classes\forms\UserLoginForm;
use MyApp\classes\forms\UserRegisterForm;
use MyApp\classes\services\TodoService;
use MyApp\classes\services\UserService;
use MyApp\classes\repositories\TodoRepository;
use MyApp\classes\User;
use MyApp\classes\auth\storage\AuthSessionStorage;
use MyApp\classes\PagesHelper;
use MyApp\classes\repositories\UserRepository;

require_once __DIR__ . '/vendor/autoload.php';


$eventDispatcher = new EventDispatcher([
    'MyApp\classes\events\TodoDeleteEvent' => [
        'MyApp\classes\listeners\TodoDeleteEventListener'
    ],
    'MyApp\classes\events\TodoDoneEvent' => [
        'MyApp\classes\listeners\MakeDoneTodoChildren',
        'MyApp\classes\listeners\MakeDoneTodoParent',
    ]
]);


$sessionStorage = new AuthSessionStorage('user');
$auth = new Auth($sessionStorage);
$error_message = '';
$todos = [];
$user = null;
$todoRepository =new TodoRepository();
$todoService = new TodoService($todoRepository, $eventDispatcher);
$todoParentId = PagesHelper::getTodoParentId();
$todo_id = PagesHelper::getTodoId();
$user = $auth->currentUser();


if(!$auth->isGuest() && (PagesHelper::isLoginPage() || PagesHelper::isRegisterPage())){
    PagesHelper::goHome();
}

if(PagesHelper::isActionRegister()){
    $form = new UserRegisterForm();
    try{
        if($form->load($_POST) && $form->validate()){
            $userService = new UserService( new UserRepository());
            $user = $userService->register($form);
            $auth->login($user);
        }
    } catch(\Exception $e) {
        $error_message = $e->getMessage();
    }

}

if(PagesHelper::isActionLogin()){
    $form = new UserLoginForm();
    try{
        if($form->load($_POST) && $form->validate()){
            $userService = new UserService( new UserRepository());
            $user = $userService->login($form);
            $auth->login($user);
        }
    } catch(\Exception $e) {
        $error_message = $e->getMessage();
    }

}

if(PagesHelper::isActionLogout()){
    $auth->logout();
}

if(!$auth->isGuest()){

    if(PagesHelper::isHome()){
        $todos = $todoRepository->getUserTodos($user, $todoParentId);
    }


    if(PagesHelper::isPageCreateTodo()){
        $todoForm = new TodoForm();
        $todoForm->parent_id = $todoParentId;
        try{
            if($todoForm->load($_POST) && $todoForm->validate()){
                $todoService->create($todoForm);
                PagesHelper::goToTodos($todoForm->parent_id);
            }
        } catch(\Exception $e) {
        $error_message = $e->getMessage();
        }
    }

    if(PagesHelper::isPageEditTodo()){

        $todoForm = new TodoForm();
        $editedTodo = $todoRepository->getById($todo_id);
        $todoForm->loadTodo($editedTodo);
        try{
            if($todoForm->load($_POST) && $todoForm->validate()){
                $todoService->edit($editedTodo->id, $todoForm->title, $todoForm->text, $todoForm->date);
                PagesHelper::goToTodos($todoForm->parent_id);
            }
        } catch(\Exception $e) {
            $error_message = $e->getMessage();
        }
    }

    if(PagesHelper::isActionDelete()){
        $deletingId = PagesHelper::getDeletingId();
        try {
            $todoService->delete($deletingId);
            PagesHelper::goToTodos($todoParentId);
        } catch(\Exception $e) {
            $error_message = $e->getMessage();
        }

    }

    if(PagesHelper::isActionDone()){
        $doneId = PagesHelper::getDoneId();
        try{
            $doneTodo = $todoRepository->getById($doneId);
            $todoService->done($doneTodo);
            PagesHelper::goToTodos($todoParentId);
        } catch(\Exception $e) {
            $error_message = $e->getMessage();
        }

    }


}