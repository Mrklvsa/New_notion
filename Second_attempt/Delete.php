


<?php

$json = file_get_contents('todo3.json');
$jsonArray = json_decode($json, true);

$todoName = $_POST['todo_name'];
unset($jsonArray[$todoName]);
file_put_contents('todo3.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
header('Location: index.php');