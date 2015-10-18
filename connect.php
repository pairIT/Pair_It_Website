<?php
    $username="root";
    $password="root";
    $database="TestPairit";

    mysql_connect(localhost,$username,$password);
    @mysql_select_db($database) or die("Database Error");
?>

