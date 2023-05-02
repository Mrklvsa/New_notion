<?php

$lists_str = file_get_contents("todo3.json");
$json_lists = json_decode($lists_str, 1);


if (isset($_GET["name"])){
    $submit = $_GET["name"];
    $json_lists[] = [
        "name" => $submit,
        "id" => $_GET["id"],
        "tasks" => [$_GET["task"]]
    ];
    file_put_contents("todo3.json", json_encode($json_lists));
    header("Location: index.php");
}

if (isset($_GET["delete"])){
    $del = $_GET["delete"];
    unset($json_lists[$del]);
    file_put_contents("todo3.json", json_encode($json_lists));
    header("Location: index.php");
}

if (isset($_GET["add_text"])) {
    $add_task = $_GET["add_text"];
    $index = $_GET["add_index"];
    $json_lists[$index]["tasks"][] = $add_task;

    file_put_contents("todo3.json", json_encode($json_lists));
    header("Location: index.php");
}


if (isset($_GET["list_index_to_delete_task"])) {
    $del_task = $_GET["task_index_to_delete"];
    $index = $_GET["list_index_to_delete_task"];
    unset($json_lists[$index]["tasks"][$del_task]);

    file_put_contents("todo3.json", json_encode($json_lists));
    header("Location: index.php");
}
?>

<form>
    <input name="name" placeholder="Write, please">
    <input name="id" placeholder="id">
    <input name="task" placeholder="task">
    <input type="submit" value="Push">
</form>


<?php
foreach ($json_lists as $i => $item) {

    echo $item["name"];
    foreach ($item["tasks"] as $j => $it)  {
        echo "<br> - ".$it;
        $task_del = '<form>
        
        <input name="list_index_to_delete_task" value="'.$i.'" type="hidden">
        <input name="task_index_to_delete" value="'.$j.'" type="hidden">
        <input type="submit" value="delete">
            </form>';
        echo $task_del;
    }

    $add_button = '<form>
    <input type="text" name="add_text">
    <input name="add_index" value="'.$i.'" type="hidden">
    <input type="submit" value="add_button">
    
</form>';
    echo $add_button;
    
    $del_button = '<form>
    <input name="delete" value="'.$i.'" type="hidden">
    <input type="submit" value="delete">
</form>';
    echo $del_button."<br>"."<br>"."<br>";

}