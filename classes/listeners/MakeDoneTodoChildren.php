<?php


namespace MyApp\classes\listeners;


use MyApp\classes\events\TodoDoneEvent;
use MyApp\classes\repositories\TodoRepository;

class MakeDoneTodoChildren
{
    public function handle(TodoDoneEvent $event) :void
    {
        TodoRepository::makeDoneTodoChildren($event->todo->id);
    }

}