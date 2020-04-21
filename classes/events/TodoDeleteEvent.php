<?php


namespace MyApp\classes\events;


class TodoDeleteEvent extends Event
{
    public $todo_id;

    public function __construct(int $id)
    {
        $this->todo_id = $id;
    }

}