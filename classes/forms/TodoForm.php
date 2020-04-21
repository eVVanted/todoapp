<?php


namespace MyApp\classes\forms;


use InvalidArgumentException;
use MyApp\classes\Todo;

class TodoForm
{

    public $user_id;
    public $parent_id;
    public $title;
    public $text;
    public $date;
    public $id;


    public function load(array $post) :bool
    {
        if (!isset($post['action-task-form']))
            return false;
        $this->user_id = $post['user_id'];
        $this->parent_id = $post['parent_id'];
        $this->title = trim($post['title']);
        $this->text = trim($post['text']);
        $this->date = trim($post['date']);
        $this->id = isset($post['id']) && $post['id'] ? $post['id'] : null;

        return true;
    }

    public function loadTodo(Todo $todo) :void
    {
        $this->user_id = $todo->user_id;
        $this->parent_id = $todo->parent_id;
        $this->title = $todo->title;
        $this->text = $todo->text;
        $this->date = $todo->date;
        $this->id = $todo->id;

    }

    public function validate() :bool
    {
        $this->validateNotEmptyTitle();
        $this->validateNotEmptyText();
        $this->validateNotEmptyDate();
        $this->validateDate();


        return true;
    }

    private function validateNotEmptyTitle()
    {
        if (empty($this->title)) {
            throw new InvalidArgumentException('Please fill Title.');
        }
    }

    private function validateNotEmptyText()
    {
        if (empty($this->text)) {
            throw new InvalidArgumentException('Please fill Text.');
        }
    }
    private function validateNotEmptyDate()
    {
        if (empty($this->date)) {
            throw new InvalidArgumentException('Please fill Date.');
        }
    }

    private function validateDate()
    {
        if (date('Y-m-d H:i') > $this->date) {
            throw new InvalidArgumentException('The date cannot be in past.');
        }
    }

}