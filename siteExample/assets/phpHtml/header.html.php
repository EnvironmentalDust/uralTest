<header>
	<h1>Карта сети УралАЗ</h1>
</header>
<nav>
	<ul>
		<li><?php if (isset($_COOKIE["username"]) && $_SERVER["REQUEST_URI"] != "/siteExample/editor.php") 
        { 
			print("<a class=\"z2\" href=\"editor.php\">Редактор</a>");
		}
		?></li>
		<li><?php if ($_SERVER["REQUEST_URI"] != "/siteExample/index.php" && $_SERVER["REQUEST_URI"] != "/") 
        { 
			print("<a class=\"z2\" href=\"index.php\">На главную</a>");
		}
		?></li>
		<li><?php if (!isset($_COOKIE["username"])) 
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