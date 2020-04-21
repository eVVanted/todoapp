<?php


namespace MyApp\classes\listeners;


use MyApp\classes\events\TodoDeleteEvent;
use MyApp\classes\repositories\TodoRepository;

class TodoDeleteEventListener
{
    public function handle(TodoDeleteEvent $event) :void
    {
        TodoRepository::deleteTodoChildren($event->todo_id);
    }

}