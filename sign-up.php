<?php
require_once('./functions.php');


$con = mysqli_connect("localhost", "root", "", "yeticave");
if ($con == false) {
    $error = mysqli_query($con);
    print("Ошибка подключения: " . mysqli_connect_error());
} else {
    print ('соединение установлено');
    $sql = "SELECT category FROM categories";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $categories = mysqli_fetch_all($res, MYSQLI_ASSOC);
    } else {
        print("переменной для категорий не существует");
    };
}

    if ($_SERVER["REQUEST_METHOD"] == 'POST') {

        $form = $_POST;
        var_dump($form);

        $errors = [];
        $email = mysqli_real_escape_string($con, $form['email']);
        $sql = "SELECT id FROM users WHERE email = ' . $email'";
        $res = mysqli_query($con, $sql);


        if (mysqli_num_rows($res) > 0) {
            $errors['oldUser'] = 'Пользователь с этим email уже зарегистрирован';
        } else {
            $required = ["userName", "email", "password", "contact", "dateOfEnd"];
            foreach ($form as $key => $val) {
                if ((!$form[$key])) {
                    $errors[$key] = 1;
                }
            };
            $password = password_hash($form['password'], PASSWORD_DEFAULT);
            $sql = 'INSERT INTO users (userName, email, password, contact, registrationDate) VALUES (?, ?, ?, ?, NOW())';
            $stmt = db_get_prepare_stmt($con, $sql, [
                $form['email'],
                $form['userName'],
                $form['contact'],
                $form['registrationDate'],
                $password]);
            $res = mysqli_stmt_execute($stmt);

        }

        if ($res && empty($errors)) {
           // header("Location: /login.php");
            exit();
        }

        $tpl_data['errors'] = $errors;
        $tpl_data['values'] = $form;
        var_dump($tpl_data['errors']);
        $content =  renderTemplate('./templates/sign-up.php', [
            $tpl_data,
            "categories" => $categories,
            'errors' => $errors
        ]);

        $layout_content = renderTemplate('templates/layout.php', [
            "content" => $content,
            "categories" => $categories,
            "nameOfPage" => "Регистрация",
            "is_auth" => $is_auth
        ]);
    } else {
        $content =  renderTemplate('./templates/sign-up.php', [
            "item" => $item,
            "categories" => $categories,
            "is_auth" => $is_auth,
            'errors' => $errors
        ]);

        $layout_content = renderTemplate('templates/layout.php', [
            "content" => $content,
            "categories" => $categories,
            "nameOfPage" => "Регистрация",
            "is_auth" => $is_auth
        ]);
    }


    print($layout_content);

?>