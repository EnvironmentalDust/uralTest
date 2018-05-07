<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form name="register_form" action="../php/register.php" method="post">
        <label for='form_name'>Имя: </label>
        <input type='text' id='form_name' name='form_name'>

        <label for='form_password'>Пароль: </label>
        <input type='password' id='form_password' name='form_password'>

        <button type="submit" name="register">Зарегистрироваться</button>
    </form>
</body>
</html>