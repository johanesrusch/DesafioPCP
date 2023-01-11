<?php
    $user = "root"; 
    $password = "adminroot"; 
    $database = "testDATABASE";
    $hostname = "localhost";

    $link = new mysqli($hostname, $user, $password, $database);

    if($link -> connect_errno) {
        echo "Falha na conexão: (".$link->connect_errno.") ".$link->connect_error;
    }
?>