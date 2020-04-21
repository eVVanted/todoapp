<?php


namespace MyApp\classes;


class Todo
{
    public $id;
    public $user_id;
    public $parent_id;
    public $title;
    public $text;
    public $date;
    public $is_done;

    const STATUS_DONE = 1;
    const STATUS_NOT_DONE = 0;

    public function __construct($user_id, $parent_id, $title, $text, $date, $id = null, $is_done = 0)
    {
        $this->user_id = $user_id;
        $this->parent_id = $parent_id;
        $this->title = $title;
        $this->text = $text;
        $this->date = $date;
        $this->is_done = $is_done;
        $this->id = $id;
    }

    public function done()
    {
        $this->guardIsNotDone();
        $this->is_done = self::STATUS_DONE;
    }

    public function edit($title, $text, $date)
    {
        $this->title = $title;
        $this->text = $text;
        $this->date = $date;
    }

    private function guardIsNotDone()
    {
        if ($this->isNotDone()) {
            throw new \DomainException('Todo is already done.');
        }

    }

    public function isNotDone()
    {
        return $this->is_done === Todo::STATUS_NOT_DONE;
    }


}