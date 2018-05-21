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
    var_dump($item);
    $required = ["title", "category", "desc", "startPrice", "betStep", "dateOfEnd"];
    $dict = [
        "title" => "Наименование",
        "category" => "Категория",
        "desc" => "Описание",
        "startPrice" => "Стартовая цена",
        "betStep" => "Шаг ставки",
        "dateOfEnd" => "Дата окончания торгов"
    ];
    $errors = [];

    foreach ($item as $key) {
        if (!$item[$key]) {
            $errors += $key;
        }
    }
    var_dump($errors);
    if (isset($_FILES['itemImg']['name'])) {
        $tmp_name = $_FILES['itemImg']['tmp_name'];
        $path = $_FILES['itemImg']['name'];


        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type !== "image/jpg") {
            $errors['file'] = 'Загрузите картинку в формате jpg';
        } else {
            move_uploaded_file($tmp_name, 'uploads/' . $path);
            $jpg['path'] = $path;
        }
    } else {
        $errors['file'] = 'Вы не загрузили файл';
    }
    if (count($errors)) {
        $lotpage = renderTemplate('./templates/add.php', ['dict' => $dict, "item" => $item, "categories" => $categories, "is_auth" => $is_auth, 'errors' => $errors]);

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
        $lotpage = renderTemplate('./templates/index.php', ["item" => $item, "categories" => $categories, "is_auth" => $is_auth]);
    }
    $content = $lotpage;
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