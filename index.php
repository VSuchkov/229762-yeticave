<?php
// подключаем функции

require_once('./functions.php');


date_default_timezone_set('Europe/Moscow');
// остаток времени до полуночи:
/*
$now = NOW();
$midnight = strtotime( midnight);
$restOfSeconds = $midnight + 86400 - $now;
$restOfTimeHours = floor(($restOfSeconds) / 3600);
$restOfTimeMinutes = floor(($restOfSeconds) % 3600 / 60);
$restOfTime = $restOfTimeHours . ":" . $restOfTimeMinutes;
*/
// переменные

$categories = [];
$goods = [];

// подключаю базу
$now = date('Y-m-d', time());

$con = mysqli_connect("localhost", "root", "", "yeticave");

// проверка подключения
if ($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
    $error = mysqli_error($con);
} else {
    print("Cоединение установлено");

    $sql = 'SELECT * FROM items WHERE dateOfEnd > ' . $now . ' ORDER BY dateOfEnd';


    $res = mysqli_query($con, $sql);
    if($res) {
        $goods = mysqli_fetch_all($res, MYSQLI_ASSOC);
    } else {
        print("переменной для товаров не существует");
    };
    $sql = 'SELECT category FROM  categories';
    $res = mysqli_query($con, $sql);
    if($res) {
        $categories = mysqli_fetch_all($res, MYSQLI_ASSOC);
    } else {
        print("переменной для категорий не существует");
    };
}






$is_auth = (bool)rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';




/*

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

$goods = [
    ["name" => "2014 Rossignol District Snowboard",
        "category" => "Доски и лыжи",
        "price" => "10999",
        "path" => "img/lot-1.jpg",
    ],
    ["name" => "DC Ply Mens 2016/2017 Snowboard",
        "category" => "Доски и лыжи",
        "price" => "159999",
        "path" => "img/lot-2.jpg",
    ],
    ["name" => "Крепления Union Contact Pro 2015 года размер L/XL",
        "category" => "Крепления",
        "price" => "8000",
        "path" => "img/lot-3.jpg",
    ],
    ["name" => "Ботинки для сноуборда DC Mutiny Charocal",
        "category" => "Ботинки",
        "price" => "10999",
        "path" => "img/lot-4.jpg",
    ],
    ["name" => "Куртка для сноуборда DC Mutiny Charocal",
        "category" => "Одежда",
        "price" => "7500",
        "path" => "img/lot-5.jpg",
    ],
    ["name" => "Маска Oakley Canopy",
        "category" => "Разное",
        "price" => "5400",
        "path" => "img/lot-6.jpg",
    ],
];
*/
/*
if (isset($_GET["item"])) {
    if (isset($goods[$_GET["item"] + 1]["id"])) {
        $itemId = $_GET["item"];
        $sql = 'SELECT * FROM items WHERE id = ' . $itemId . '';
        $res = mysqli_query($con, $sql);
        if ($res) {
            $item = mysqli_fetch_all($res, MYSQLI_ASSOC);
            $lotpage = renderTemplate('./templates/lot.php', ["item" => $item, "categories" => $categories, "is_auth" => $is_auth]);
            $content = $lotpage;
            $layout_content = renderTemplate('templates/layout.php', ["content" => $content, "categories" => $categories, "nameOfPage" => "Главная", "is_auth" => $is_auth]);
            print($layout_content);
        }
    } else {
        http_response_code(404);
    }
}  else {
    // HTML код главной страницы
    $content = renderTemplate('templates/index.php', ['goods' => $goods, "categories" => $categories, "restOfTime" => $restOfTime]);
// окончательный HTML код
    $layout_content = renderTemplate('templates/layout.php', ["content" => $content, "categories" => $categories, "nameOfPage" => "Главная", "is_auth" => $is_auth]);
    print($layout_content);
// переходим на страницу товара
}
*/

if (isset($_GET["add"])) {


    renderTemplate('templates/layout.php', ["content" => $content, "categories" => $categories, "nameOfPage" => "Главная", "is_auth" => $is_auth]);
            print($layout_content);

};
$content = renderTemplate('templates/index.php', ['goods' => $goods, "categories" => $categories, "restOfTime" => $restOfTime]);
// окончательный HTML код
$layout_content = renderTemplate('templates/layout.php', ["content" => $content, "categories" => $categories, "nameOfPage" => "Главная", "is_auth" => $is_auth]);
print($layout_content);



?>

    </body>
</html>
