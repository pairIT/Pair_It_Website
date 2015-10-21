<?php
    $username="root";
    $password="root";
    $database="testpairit";

    mysql_connect('localhost:8889', 'root', 'root');
    @mysql_select_db($database) or die("Database Error");
?>

