<?php 
    if (!isset($_COOKIE["username"])) {
        header("Location: index.php");
    }
?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head> 
    <meta http-equiv="content-type" content="application/xhtml+xml;charset=utf-8"/>
    <title>Редактор</title>
    <script src="assets/js/css.js"></script>
    <script src="assets/js/d3.min.js"></script>
</head>
<body>

    <div id="wrapper">
        <?php include("assets/phpHtml/header.html.php"); ?>
    	<!-- load map and js for graph changing -->
        <div id="map">
        	<?php echo file_get_contents("assets/svg/trueMap.svg") ?>
     
        </div>
        <script type="text/javascript" src="assets/js/editor.js"></script>
        <div id="options">
            <ul>
                <li><input type="text" id="name"></li>
                <li><button style="background: green" id="addPC">Добавить компьютер</button></li>
                <li><button style="background: green" id="addC">Добавить коммутатор</button></li>
                <li><button style="background: green" id="addText">Добавить текст</button></li>
            </ul>
            <ul>
                <li><button style="background: red" id="deleteDev">Удалить элемент</button></li>
            </ul>
            <ul>
                <li><button style="background: red" id="drawLines">Рисование линий</button></li>
            </ul>
            <ul>
                <li><button style="background: red" id="moveDev">Перемещение устройств</button></li>
            </ul>
        </div>
        <button id="save">Сохранить изменения</button>
        <?php include("assets/phpHtml/footer.html.php"); ?>
    </div>
</body>
</html>