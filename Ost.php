





<form>

    <input name="folder" placeholder="Имя списка">
    <input type="submit" value="Создаём">

</form>

<?php

function getLists($name){
    $str = file_get_contents($name);
    $arr = json_decode($str, 1);
    return $arr;
}

function saveLists($save) {
    file_put_contents("text3", json_encode($save));
}

function showLists($lists)
{
    foreach ($lists as $item=>$list_obj) {
//        printList($item);
        echo $item."<br><button>добавить</button><br>";
    }
}

$Lists = getLists("text3");


if (isset($_GET["folder"])) {
    $new_obj = [
        "folder" => $_GET["folder"]];
//            "id" => $_GET["id"]];
    $Lists[] = $new_obj;
    saveLists($Lists);
}
if (isset($_GET["i_to_delete"])) {
//    echo "delete";
    unset($Lists[$_GET['i_to_delete']]);
    saveLists($Lists);
}
showLists($Lists);









_________________________________





<?php
$todos = [];
if (file_exists('todo3.json')) {
    $json = file_get_contents('todo3.json');
    $todos = json_decode($json, true);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="Second_attempt/newtodo.php" method="post" style="margin-bottom: 20px">
    <input type="text" name="todo_name" placeholder="Enter your todo">
    <button>New Todo</button>

</form>
<?php foreach ($todos as $todoName => $todo):  ?>
    <div style="margin-bottom: 20px">
        <input type="checkbox" <?php echo $todo['completed'] ? 'checked' : '' ?>>
        <?php echo $todoName ?>
        <form style="display: inline-block" action="Second_attempt/Delete.php" method="post">
            <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">
            <button> Delete</button>
        </form>

    </div>
<?php endforeach; ?>
</body>
</html>




_____








<form>

    <input name="folder" placeholder="Имя списка">
    <input type="submit" value="Создаём">

</form>

<?php

function getLists($name){
    $str = file_get_contents($name);
    $arr = json_decode($str, 1);
    return $arr;
}

function saveLists($save) {
    file_put_contents("text3", json_encode($save));
}

function showLists($lists)
{
    foreach ($lists as $item=>$list_obj) {
//        printList($item);
        echo $item."<br><button>добавить</button><br>";
    }
}


$Lists = getLists("text3");


if (isset($_GET["folder"])) {
    $new_obj = [
        "name" => $_GET["folder"]];

    $Lists[] = $new_obj;
    saveLists($Lists);
}
if (isset($_GET["i_to_delete"])) {
//    echo "delete";
    unset($Lists[$_GET['i_to_delete']]);
    saveLists($Lists);
}
showLists($Lists);
//echo $Lists;

foreach ($Lists as $item=> $list_obj) {
//        printList($item);
    echo $item."<br><button>добавить</button><br>";
}
