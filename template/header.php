<?php
    error_reporting(E_ALL);

    ini_set('session.gc_maxlifetime', 1200);
    ini_set('session.cookie_lifetime', 1200);

    session_start();

    if (isset($_GET['login']) && $_GET['login'] == 'no') {
        session_destroy();
        header('Location: /');
        exit;
    }

    include $_SERVER['DOCUMENT_ROOT'] . "/include/controller.php";

    $sessid = session_id();    

    //Проверяем поступил ли параметр login со значением yes через GET-запрос
    if (isset($_GET['login']) && $_GET['login'] == 'yes') {
        $classActive = " class='project-folders-v-active'";
    } else {
        $classActive = '';
    }

    // Проверяем поступила ли форма с данными. Если да, то проверям на существование логина в массиве $arrLogins
    if (isset($_POST['auth'])) {
        include $_SERVER['DOCUMENT_ROOT'] . "/include/logins.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/include/passwords.php";
        if (isset($_COOKIE['login'])) {
            $login = $_COOKIE['login'];
        } else {
            $login = $_POST['login'];
        }        
        $password = $_POST['password'];
        $auth = false;

        // Проверяем соответствие логина и пароля
        $keyLogins = array_search($login, $arrLogins);
        if (!$keyLogins) {
            $notLogin = "Такого логина не существует!";
        } elseif ($password == $arrPasswords[$keyLogins]) {
            $auth = true;
            $_SESSION['PHPSESSID'] = $_COOKIE['PHPSESSID'];
            $_SESSION['auth'] = "true";
            $_SESSION['login'] = $login;
            $timeCookie = $_COOKIE['PHPSESSID'];
            setcookie("login", $login, time() + 3600 * 24 * 30, "/");
            $file = 'success.php';
        } else {
            $file = 'error.php';
        }
    }
    if (isset($_SESSION['auth'])) {
        setcookie("login", $_SESSION['login'], time() + 3600 * 24 * 30, "/");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/styles.css" rel="stylesheet">
    <title>Project - ведение списков</title>
</head>

<body>

    <div class="header">
        <div class="logo"><img src="/i/logo.png" width="68" height="23" alt="Project"></div>
        <div class="clearfix"></div>
    </div>

    <div class="clear">
        <?php showMenu($arrMenu, '', SORT_ASC); ?>
    </div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="left-collum-index">
                <h1><?=getTitle($arrMenu); ?></h1>
                <h1>Возможности проекта —</h1>
                <p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с друзьями и просматривать списки друзей.</p>
            </td>