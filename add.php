<?php
require_once('./functions.php');

$con = mysqli_connect("localhost", "root", "", "yeticave");
if ($con == false) {
    $error = mysqli_query($con);
    print("Ошибка подключения: " . mysqli_connect_error());
} else {
    $sql = "SELECT category FROM categories";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $categories = mysqli_fetch_all($res, MYSQLI_ASSOC);
    } else {
        print("переменной для категорий не существует");
    };
}
/*
$itemId = $_GET["id"];
$sql = 'SELECT * FROM items WHERE id = ' . $itemId . '';
$res = mysqli_query($con, $sql);
$item = mysqli_fetch_all($res, MYSQLI_ASSOC);
*/

    $lotpage = renderTemplate('./templates/add.php', ["item" => $item, "categories" => $categories, "is_auth" => $is_auth]);
    if ($lotpage) {
        $content = $lotpage;
        $layout_content = renderTemplate('templates/layout.php', ["content" => $content, "categories" => $categories, "nameOfPage" => "Главная", "is_auth" => $is_auth]);
        print($layout_content);
    } else {
        http_response_code(404);
        $content = "Лот не найден!";
    }

?>