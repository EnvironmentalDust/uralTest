<?php

if (isset($_POST)) {
   
    $svg = strval($_POST["newPage"]);

    $file = '../svg/trueMap.svg';

    $current = file_get_contents($file);

    $current = $svg;

    file_put_contents($file, $current);
}

?>