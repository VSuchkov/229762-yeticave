<?php

require_once('functions.php');

session_start();

$con = mysqli_connect("localhost", "root", "", "yeticave");
if ($con == false) {
    $error = mysqli_query($con);
    print("Ошибка подключения: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required = ['email', 'password'];
    $errors = [];
    foreach ($required as $field) {
        if (empty($form[$field])) {
            $errors[$field] = 'Это поле надо заполнить';
        }
    }
    $email = mysqli_real_escape_string($con, $form['email']);
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con, $sql);

    $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

    if (!count($errors) and $user) {
        if (password_verify($form['password'], $user['password'])) {
            $_SESSION['user'] = $user;
        }
        else {
            $errors['password'] = 'Неверный пароль';
        }
    }
    else {
        $errors['email'] = 'Такой пользователь не найден';
    }
    if (count($errors)) {
        $content = randerTemplate('login.php', ['form' => $form, 'errors' => $errors]);
    } 	else {
        header("Location: /index.php");
        exit();
    }
} else {
    if (isset($_SESSION['user'])) {
        $content = randerTemplae('index.php', ['username' => $_SESSION['user']['userName']]);
    }
    else {
        $content = randerTemplate('login.php', []);
    }
}

$layout_content = randerTemplate('layout.php', [
    'content'    => $content,
    'categories' => [],
    'title'      => 'Главная'
]);

print($layout_content);


}



}
?>