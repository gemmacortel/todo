<?php

class CreateToDoCommand
{
    private $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function task()
    {
        return $this->task;
    }

}
