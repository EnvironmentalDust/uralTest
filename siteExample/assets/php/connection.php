<?php
try
{
    $pdo = new PDO('mysql:host=localhost;dbname=ural', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
    $output = 'Unable to connect to the database server.';
    include 'assets/phpHtml/output.php';
    exit();
}
$output = 'Database connection established.';
// include 'assets/phpHtml/output.php';
?>