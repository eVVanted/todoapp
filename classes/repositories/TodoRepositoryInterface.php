<?php


namespace MyApp\classes\repositories;


use MyApp\classes\Todo;
use MyApp\classes\User;

interface TodoRepositoryInterface
{
    /**
     * @param User $user
     * @param int $parentTodoId
     * @return Todo[]
     */
    public function getUserTodos(User $user, int $parentTodoId) : array;

    /**
     * @param int $id
     * @return Todo
     */
    public function getById(int $id) : Todo;

    /**
     * @param Todo $todo
     * @return void
     */
    public function save(Todo $todo) : void;

    /**
     * @param Todo $todo
     * @return void
     */
    public function add(Todo $todo) : void;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id) : void;

}