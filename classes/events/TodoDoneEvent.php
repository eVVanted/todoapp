<?php


namespace MyApp\classes\events;


use MyApp\classes\Todo;

class TodoDoneEvent extends Event
{
    public $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

}