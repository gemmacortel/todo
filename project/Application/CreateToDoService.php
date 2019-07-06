<?php

class CreateToDoService
{
    private $repository;

    public function __construct(ToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    public static function getInstance()
    {
        return new self(new MySQLToDoRepository());
    }

    public function execute(CreateToDoCommand $command)
    {
        $id = ToDo::fromTask($command->task());
        $this->repository->addToDo($id);
    }
}
