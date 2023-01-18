<?php
    $user = "root"; 
    $password = "adminroot"; 
    $database = "testdatabase";
    $hostname = "localhost:1403";

    $link = new mysqli($hostname, $user, $password, $database);

    if($link -> connect_errno) {
        echo "Falha na conexão: (".$link->connect_errno.") ".$link->connect_error;
    }
?>