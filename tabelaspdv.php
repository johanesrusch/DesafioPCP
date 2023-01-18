<?php 
    include "connection.php" ;

    $sql1 = "SELECT * FROM itensvenda";
    $resultado = mysqli_query($link, $sql1);
    $conta = mysqli_affected_rows($link);
    // Verifica se a consulta retornou linhas
    if ($conta > 0) {
        // Atribui o código HTML para montar uma tabela
        $table = "<table>
                    <thead>
                        <tr>
                            <th>Identificador do Produto</th>
                            <th>Descrição</th>
                            <th>Estoque</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>";
        $return = $table;
        // Captura os dados da consulta e inseri na tabela HTML
        while ($row = mysqli_fetch_array($resultado)) {
            $return.= "<td>" . $row["id_produto"] . "</td>";
            $return.= "<td>" . $row["Descricao"] . "</td>";
            $return.= "<td>" . $row["Estoque"] . "</td>";
            $return.= "</tr>";
        }
        echo $return.="</tbody></table>";
}
?>