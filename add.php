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


if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $item = $_POST;
    $required = ["title", "category", "desc", "startPrice", "betStep", "dateOfEnd"];
    $dict = [
        "name" => "Наименование",
        "category" => "Категория",
        "description" => "Описание",
        "startPrice" => "Стартовая цена",
        "betStep" => "Шаг ставки",
        "dateOfEnd" => "Дата окончания торгов"
    ];
    $errors = [];

    foreach ($item as $key => $val) {
        if ((!$item[$key]) or ($item[$key] == 'Выберите категорию')) {
            $errors[$key] = 1;
        }
    }
    if (!is_numeric($item["startPrice"])) {
        $errors["startPrice"] = 2;
    }
    if (!is_numeric($item["betStep"])) {
        $errors["betStep"] = 2;
    }



    if (is_uploaded_file($_FILES['itemImg']['tmp_name'])) {
        $tmp_name = $_FILES['itemImg']['tmp_name'];
        $path = uniqid() . '.jpg';
        $file_type = mime_content_type($tmp_name);
        if ($file_type == "image/jpg" OR $file_type == "image/jpeg") {
            $path = uniqid() . '.jpg';
            $item['itemImg'] = 'img/' . $path;
            move_uploaded_file($tmp_name, 'img/' . $path);
        } else {
            $errors['file'] = 'Загрузите картинку в формате jpg';
        }
    } else {
        $errors['file'] = 'Вы не загрузили файл';
    }
    if (count($errors)) {
        $content = renderTemplate('./templates/add.php', ["item" => $item, "categories" => $categories, "is_auth" => $is_auth, 'errors' => $errors]);

    } else {
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
        $content = renderTemplate('./templates/index.php', ["item" => $item, "categories" => $categories, "is_auth" => $is_auth]);
    }
    $layout_content = renderTemplate('templates/layout.php', ["content" => $content, "categories" => $categories, "nameOfPage" => "Главная", "is_auth" => $is_auth]);
    print ($layout_content);
    } else {
        $lotpage = renderTemplate('./templates/add.php', ["item" => $item, "categories" => $categories, "is_auth" => $is_auth]);
        if ($lotpage) {
            $content = $lotpage;
            $layout_content = renderTemplate('templates/layout.php', ["content" => $content, "categories" => $categories, "nameOfPage" => "Главная", "is_auth" => $is_auth]);
            print($layout_content);
        } else {
            http_response_code(404);
            $content = "Лот не найден!";
        }
}
?>