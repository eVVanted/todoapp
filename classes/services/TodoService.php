<?php


namespace MyApp\classes\services;

use MyApp\classes\dispatchers\EventDispatcherInterface;
use MyApp\classes\events\TodoDeleteEvent;
use MyApp\classes\events\TodoDoneEvent;
use MyApp\classes\forms\TodoForm;
use MyApp\classes\repositories\TodoRepository;
use MyApp\classes\Todo;
use MyApp\classes\User;

class TodoService
{
    private $todoRepository;
    private $eventDispatcher;

    public function __construct(
        TodoRepository $todoRepository,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->todoRepository = $todoRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function create(TodoForm $form): void
    {
        $todo = new Todo($form->user_id, $form->parent_id, $form->title, $form->text, $form->date);
        $this->todoRepository->add($todo);
    }

    public function edit($id, $title, $text, $date): void
    {
        $todo = $this->todoRepository->getById($id);
        $todo->edit($title, $text, $date);
        $this->todoRepository->save($todo);
    }

    public function done(Todo $todo): void
    {
        $todo->done();
        $this->todoRepository->save($todo);
        $this->eventDispatcher->dispatch(new TodoDoneEvent($todo));
    }

    public function delete(int $id): void
    {
        $this->todoRepository->delete($id);
        $this->eventDispatcher->dispatch(new TodoDeleteEvent($id));
    }

}