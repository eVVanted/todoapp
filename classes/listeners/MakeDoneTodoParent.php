<?php


namespace MyApp\classes\listeners;


use MyApp\classes\events\TodoDoneEvent;
use MyApp\classes\repositories\TodoRepository;

class MakeDoneTodoParent
{
    public function handle(TodoDoneEvent $event) :void
    {
        $count_dodos = TodoRepository::countTodos($event->todo->parent_id);
        if($count_dodos['count_all_todos'] && $count_dodos['count_all_todos'] == $count_dodos['count_done_todos']){
            TodoRepository::makeDoneTodoParent($event->todo->parent_id);
        }

    }

}