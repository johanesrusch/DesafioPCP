<?php 
    include "connection.php" ;

    $consulta_pdv = "SELECT * FROM itensvenda";
    $resultado = mysqli_query($link, $consulta_pdv);
    $cont = mysqli_affected_rows($link);
    // Verifica se a consulta retornou linhas
    if ($cont > 0) {
        // Atribui o código HTML para montar uma tabela
        $table = "<table>
                    <thead>
                        <tr>
                            <th>Identificador da Venda</th>
                            <th>Identificador do Produto</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>";
        $return = $table;
        // Captura os dados da consulta e insere na tabela HTML
        while ($row = mysqli_fetch_array($resultado)) {
            $return.= "<td>" . $row["id_venda"] . "</td>";
            $return.= "<td>" . $row["id_produto"] . "</td>";
            $return.= "<td>" . $row["quantidade"] . "</td>";
            $return.= "</tr>";
        }
        echo $return.="</tbody></table>";
}
?>