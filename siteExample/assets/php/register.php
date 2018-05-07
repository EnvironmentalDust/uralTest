<?php

if (isset($_POST["register"])) {
	$name = htmlspecialchars($_POST["form_name"]);
	$pswd = htmlspecialchars($_POST["form_password"]);
	echo $name;
	echo $pswd;
	
}

?>