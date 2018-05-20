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

    $lotpage = renderTemplate('./templates/add.php', ["item" => $item, "categories" => $categories, "is_auth" => $is_auth]);
    if ($lotpage) {
        $content = $lotpage;
        $layout_content = renderTemplate('templates/layout.php', ["content" => $content, "categories" => $categories, "nameOfPage" => "Главная", "is_auth" => $is_auth]);
        print($layout_content);
    } else {
        http_response_code(404);
        $content = "Лот не найден!";
    }

if ($_SERVER["REQUEST_METHOD"] == POST) {
    $item = $_POST["item"];

    $fileName = uniqid() . ".jpg";
    $item["itemImg"] = $fileName;
    move_uploaded_file($_FILES["jpg_img"]["tmp_name"], '/uploads' . $fileName);

    $sql = 'INSERT INTO items (userId, itemName, description, itemImg, categoryId, startPrice, dateOfEnd, betStep) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = db_get_prepare_stmt($con, $sql, [$item['name'], $item['category'], $item['description'], $item["itemImg"], $item['startPrice'], $item['betStep'], $item['dateOfEnd']]);
    $res = mysqli_stmt_execute($stmt);

    if ($res) {
        $itemId = mysqli_insert_id($con);

        header("Location: lot.php?id=" . $itemId);
    } else {
        $content = "Лот не найден!";
    }
}

?>