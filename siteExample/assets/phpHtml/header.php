<header>
	<h1>Заголовок</h1>
</header>
<nav>
	<ul>
		<li><a class="z2" href="assets/php/editor.php">Редактор карты</a></li>
		<li><a class="z2" href="index.php">Заглушка 1</a></li>
		<li><a class="z2" href="index.php">Заглушка 2</a></li>
		<li><?php if (!isset($_SESSION["session_username"])) 
        { 
            include("login.html.php"); 
        } else {
            include("logout.html.php");
		}
		if (isset($error)) {
			echo $error;
		}
		?></li>
	</ul>

</nav>