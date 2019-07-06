<?php

class ToDo
{
    private $id;
    private $task;
    private $status;

    public function __construct(Id $id, $task)
    {
        $this->id = $id;
        $this->task = $task;
        $this->status = 0;
    }

    public static function fromTask($task)
    {
        return new ToDo(Id::fromString(uniqid()), $task);
    }

    public function task()
    {
        return $this->task;
    }

    public function status()
    {
        return $this->status;
    }

    public function id()
    {
        return $this->id;
    }

}

