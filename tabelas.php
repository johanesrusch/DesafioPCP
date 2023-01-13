<?php 
    include "connection.php" ;
    $query = "SELECT * FROM produtos";
    $result = mysqli_query($link, $query);

    while ($row_produto = mysqli_fetch_assoc($result)) {
        echo "id_produto: " . $row_produto['id_produto'] . "<br>";
        echo "Descrição: " . $row_produto['Descricao'] . "<br>";
        echo "Estoque: " . $row_produto['Estoque'] . "<br><hr>";
    }
?>