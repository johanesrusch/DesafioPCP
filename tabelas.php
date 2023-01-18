<?php 
    include "connection.php" ;
// Verifica se existe a variável txtnome
    $sql = "SELECT * FROM Produtos";
    $result = mysqli_query($link, $sql);
    $cont = mysqli_affected_rows($link);
    // Verifica se a consulta retornou linhas
    if ($cont > 0) {
        // Atribui o código HTML para montar uma tabela
        $tabela = "<table>
                    <thead>
                        <tr>
                            <th>Identificador do Produto</th>
                            <th>Descrição</th>
                            <th>Estoque</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>";
        $return = $tabela;
        // Captura os dados da consulta e inseri na tabela HTML
        while ($linha = mysqli_fetch_array($result)) {
            $return.= "<td>" . $linha["id_produto"] . "</td>";
            $return.= "<td>" . $linha["Descricao"] . "</td>";
            $return.= "<td>" . $linha["Estoque"] . "</td>";
            $return.= "</tr>";
        }
        echo $return.="</tbody></table>";
}
?>