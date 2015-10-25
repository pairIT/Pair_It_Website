<?php
    
    $local = true;
    if ($local)
    {
        $username="root";
        $password="root";
        $database="testpairit";
        $host="localhost:8889";
    }
    else
    {
        $username="b60bcff3aa35e3";
        $password="0f12a061";
        $database="heroku_595ad00ac5b85f9";
        $host="us-cdbr-iron-east-03.cleardb.net";
    }

    mysql_connect($host, $username, $password);
    @mysql_select_db($database) or die("Database Error");
?>