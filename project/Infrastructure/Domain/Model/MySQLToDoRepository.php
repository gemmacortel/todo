<?php

include $_SERVER['DOCUMENT_ROOT'] . '/Domain/VO/Id.php';
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

class MySQLToDoRepository implements ToDoRepository
{
    public function addToDo(ToDo $toDo)
    {
        $dbc = mysqli_connect('database', 'root', 'root', 'notes') or die('Error connecting to MySQL server');
        $task = $toDo->task();
        $status = $toDo->status();
        $id = $toDo->id()->id();

        $query = "INSERT INTO todos (task, status, id)" .
            "VALUES ('$task', $status, '$id');";
        $result = mysqli_query($dbc, $query) or die ('Error inserting data');

        mysqli_close($dbc);
    }

    public function retrievePendingToDos()
    {
        $pendingToDos = [];
        $dbc = mysqli_connect('database', 'root', 'root', 'notes') or die('Error connecting to MySQL server');
        $query = "SELECT * FROM todos WHERE status = 0;";
        $result = mysqli_query($dbc, $query);
        if(!empty($result)){
            while($row = mysqli_fetch_array($result)){
                array_push($pendingToDos, new ToDo(Id::fromString(($row['id'])), $row['task']));
            }
        }
        mysqli_close($dbc);
        return $pendingToDos;
    }

    public function completeToDo($id)
    {
        $dbc = mysqli_connect('database', 'root', 'root', 'notes') or die('Error connecting to MySQL server');
        $id_string = $id->id();

        $complete_query = "UPDATE todos SET status = 1 WHERE id = '$id_string';";
        $complete_result = mysqli_query($dbc, $complete_query);
        if(!$complete_result){
            echo 'There has been a problem completing the task number ' . $id . '<br>';
        }
        mysqli_close($dbc);
    }
}
