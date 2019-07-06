<?php

include dirname(__FILE__) . '/../Domain/Model/ToDo.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Domain/Model/ToDoRepository.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Infrastructure/Domain/Model/MySQLToDoRepository.php';

class CompleteToDoService
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

    public function execute(CompleteToDoCommand $command)
    {
        $this->repository->completeTodo(Id::fromString($command->id()));
    }
}
