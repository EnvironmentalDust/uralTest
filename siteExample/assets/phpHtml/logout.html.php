<p>Здравствуйте, <?php echo($_SESSION["session_username"]); ?></p>
<form name="logout_form" action="login.php" method="post">
    <button type="submit" name="logout">Выйти</button>
</form>