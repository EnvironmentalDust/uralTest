<?php

require_once("assets/php/connection.php");
session_start();
if (isset($_POST["login"])) {
    $username=htmlspecialchars($_POST['form_name']);
    $password=htmlspecialchars($_POST['form_password']);
    if(!empty($username) && !empty($password)) {
        $sth = $pdo->prepare('SELECT *
            FROM usertbl
            WHERE username = ? AND userpswd = ?');
        $sth->bindParam(1, $username);
        $sth->bindParam(2, $password);
        $sth->execute();
        $res = $sth->fetch(PDO::FETCH_ASSOC);
        $dbusername=$res['userName'];
        $dbpassword=$res['userPswd'];
        $dbpriv = $res['priv'];
        if($username == $dbusername && $password == $dbpassword) {
            $_SESSION["session_username"] = $dbusername;
            $_SESSION["session_priv"] = $dbpriv;
            include("index.php");
            die();
        } else {
            unset($_SESSION);
            unset($_POST);
            $error = "Неправильный логин или пароль";
            include("index.php");
            die();
        }
    } elseif (empty($username) || empty($password)) {
        unset($_SESSION);
        unset($_POST);
        $error = "Заполните все поля";
        include("index.php");
        die();
    }

} elseif (isset($_POST["logout"])) {
    unset($_SESSION);
    unset($_POST);
    include("index.php");
    die();
}

?>