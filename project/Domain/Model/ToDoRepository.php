<?php

interface ToDoRepository
{
    public function addToDo(ToDo $toDo);

    public function retrievePendingToDos();

    public function completeToDo($id);
}
