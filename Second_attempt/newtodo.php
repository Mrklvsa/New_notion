<?php

echo '<pre>';
var_dump($_POST);
echo '</pre>';


$todoName = $_POST['todo_name'] ?? '';
$todoName = trim($todoName);
if ($todoName) {
    if (file_exists('todo3.json')) {
        $json = file_get_contents('todo3.json');
        $jsonArray = json_decode(@$json, true);

    } else {
        $jsonArray = [];
    }
    $jsonArray[$todoName] = ['completed' => false];
    echo '<pre>';
    var_dump($jsonArray);
    echo "</pre>";
    file_put_contents('todo3.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
}

header('Location: index.php');
