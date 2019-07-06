<?php

include 'Application/CreateToDoCommand.php';
include 'Application/CreateToDoService.php';
include 'Application/CompleteToDoCommand.php';
include 'Application/CompleteToDoService.php';
//include 'Infrastructure/Domain/Model/MySQLToDoRepository.php';

error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

$dbc = mysqli_connect('database', 'root', 'root', 'notes') or die('Connection to database failed');

if(isset($_POST['submit'])){
    $create_command = new CreateToDoCommand($_POST['task']);
    $create_service = CreateToDoService::getInstance();
    $create_service-> execute($create_command);
}

if(isset($_POST['complete'])){
    foreach ($_POST['completed_tasks'] as $completed_task) {
        $complete_command = new CompleteToDoCommand($completed_task);
        $complete_service = CompleteToDoService::getInstance();
        $complete_service-> execute($complete_command);
    };
}
?>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="styles.css">
    <title>TO·DO</title>
</head>
<body>
    <div id="content">
        <div id="header">
            <h1>TO·DO</h1>
        </div>
        <div id="todos">
            <form id="add" method="post" action="<?php $_SERVER['PHP_SELF']?>">
                <input type="text" id="task" name="task"/>
                <input type="submit" value="+" name="submit" id="add_button"/>
            </form>
            <form id="list" method="post" action="<?php $_SERVER['PHP_SELF']?>">
                <?php
                $repository = new MySQLToDoRepository();
                $pendingToDos = $repository->retrievePendingToDos();
                foreach ($pendingToDos as $toDo){
                    echo '<input type="checkbox" name="completed_tasks[]" value="' . $toDo->id()->id() . '"/> ';
                    echo $toDo->task() . '<br/>';
                }
                ?>
                <br/><input type="submit" name="complete" value="Complete!" id="complete_button"/>
            </form>
        </div>
    </div>
</body>
</html>


