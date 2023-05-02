<?php

$lists_str = file_get_contents("todo3.json");
$json_lists = json_decode($lists_str, 1);

function save_json($save) {
    file_put_contents("todo3.json", json_encode($save));
    header("Location: index.php");
}

function create_list($list) {
    $submit = $_GET["name"];
    $format = $_GET["num"];
    $list[] = [
        "name" => $submit,
        "format" => $format,
        "id" => $_GET["id"],
        "tasks" => [$_GET["task"]]
    ];
    save_json($list);
}

function delete_list($del, $list)  {

    unset($list[$del]);
    file_put_contents("todo3.json", json_encode($list));
    header("Location: index.php");
}

function create_task($del_task_arg, $list) {
    $add_task = $del_task_arg;
    $index = $_GET["add_index"];
    $list[$index]["tasks"][] = $add_task;

    save_json($list);
}
function delete_task($task_index, $list_index, $list) {

//    $index = $_GET["list_index_to_delete_task"];
    unset($list[$list_index]["tasks"][$task_index]);

    save_json($list);
}

function create_todo_form($i) {
    return '<form>
    <input type="text" name="add_text">
    <input name="add_index" value="'.$i.'" type="hidden">
    <input type="submit" value="add_button">
    
</form>';
}
function delete_todo_form($i) {
    return '<form>
    <input name="delete" value="'.$i.'" type="hidden">
    <input type="submit" value="delete">
</form>'."<br>"."<br>"."<br>";
}
function delete_todo_task($i, $j) {
    return '<form>
        
        <input name="list_index_to_delete_task" value="'.$i.'" type="hidden">
        <input name="task_index_to_delete" value="'.$j.'" type="hidden">
        <input type="submit" value="delete">
            </form>';
}
if (isset($_GET["name"])){
    create_list($json_lists);

}

if (isset($_GET["delete"])){
    delete_list($_GET["delete"], $json_lists);
}

if (isset($_GET["add_text"])) {
    create_task($_GET["add_text"], $json_lists);
}


if (isset($_GET["list_index_to_delete_task"])) {
    delete_task(
            $_GET["task_index_to_delete"],
            $_GET["list_index_to_delete_task"],
            $json_lists
    );
}
?>
<head>
    <link rel="stylesheet" href="index.css">
</head>
<form>
    <input name="name" placeholder="Write, please">
    <select name="num">
        <option value="num">Numerovaniy</option>
        <option value="*">Markirovaniy</option>
    </select>
    <input name="id" placeholder="id">
    <input name="task" placeholder="task">
    <input type="submit" value="Push">
</form>


<?php
foreach ($json_lists as $i => $item) {

    echo $item["name"];
    foreach ($item["tasks"] as $j => $it)  {
        echo "<br> ";
        if ($item["format"] === "num") {
            echo ($j+1).".  ".$it;
        } else {
            echo "- ".$it;
        }
        $task_del = delete_todo_task($i, $j);
        echo $task_del;
    }

    $add_button = create_todo_form($i);
    echo $add_button;
    
    $del_button = delete_todo_form($i);
    echo $del_button;

}