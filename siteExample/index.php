<?php 


require_once("assets/php/connection.php");
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
        if($username == $dbusername && $password == $dbpassword ) {
            setcookie("username", $dbusername, time()+1200); 
            setcookie("priv", $dbpriv, time()+1200); 
            // $_COOKIE["username"] = $dbusername;
            // $_COOKIE["priv"] = $dbpriv;
            include("assets/phpHtml/head.html.php");
            include("assets/phpHtml/body.html.php");
        } else {
            unset($_COOKIE);
            unset($_POST);
            $error = "Неправильный логин или пароль";
            include("assets/phpHtml/head.html.php");
            include("assets/phpHtml/body.html.php");
        }
    } elseif (empty($username) || empty($password)) {
        setcookie("username", "", time() - 3600);
        setcookie("priv", "", time() - 3600);
        $error = "Заполните все поля";
        include("assets/phpHtml/head.html.php");
        include("assets/phpHtml/body.html.php");
    }

} elseif (isset($_POST["logout"])) {
    setcookie("username", "", time() - 3600);
    setcookie("priv", "", time() - 3600);
    include("assets/phpHtml/head.html.php");
    include("assets/phpHtml/body.html.php");
} else {
    include("assets/phpHtml/head.html.php");
    include("assets/phpHtml/body.html.php");
    var_dump($_SERVER["REQUEST_URI"]);
}

?>

