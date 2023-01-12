<?php
    include("connection.php");
    $operation = $_POST["operation"];

    if ($operation == "adicionar_registro_venda") {

        $prod_comp = $_POST["produto_comprado"];
        $qtd_comp = $_POST["qtd_comprada"];
        if($prod_comp == null){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Você deve preencher o nome do produto comprado para incluir o pedido de venda no banco de dados!!')
                window.location.href='http://localhost/DesafioPCP/index.html';
                </SCRIPT>"
            );
        } elseif ($qtd_comp == null){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Você deve preencher a quantidade comprada para incluir o pedido de venda no banco de dados!!')
                window.location.href='http://localhost/DesafioPCP/index.html';
                </SCRIPT>"
            );
        } else {
            $consulta_produt = "SELECT Descricao FROM produtos WHERE Descricao like '%".$prod_comp."%'";
            $result3 = mysqli_query($link, $consulta_produt);
            if (mysqli_num_rows($result3) == 0) {
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Este produto não está cadastrado no banco de dados!')
                    window.location.href='http://localhost/DesafioPCP/index.html';
                    </SCRIPT>"
                );
            } else {
                $id_produto = "SELECT id_produto, Estoque FROM produtos where Descricao like '%".$prod_comp."%'";
                $id_produto = mysqli_query($link, $id_produto);

                $row = $id_produto->fetch_array(MYSQLI_NUM);
                
                if ($row[1] <= 0) {
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Este produto está sem estoque no momento!')
                        window.location.href='http://localhost/DesafioPCP/index.html';
                        </SCRIPT>"
                    );
                } else {
                    $inserir_reg_venda = "INSERT INTO itensvenda(id_produto, quantidade) VALUES ($row[0], $qtd_comp)";
                    $result = mysqli_query($link, $inserir_reg_venda);

                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Pedido de venda inserido com sucesso!')
                        window.location.href='http://localhost/DesafioPCP/index.html';
                        </SCRIPT>"
                    );
                }
            }
        }





        
    } else {

        $id_venda = $_POST["id_venda"];
        $id_produto = $_POST["id_produto"];

        if($id_venda == null){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Você deve preencher o identificador da venda para remover o pedido de venda do banco de dados!!')
                window.location.href='http://localhost/DesafioPCP/index.html';
                </SCRIPT>"
            );
        } elseif ($id_produto == null){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Você deve preencher o identificador do produto para remover o pedido de venda do banco de dados!!')
                window.location.href='http://localhost/DesafioPCP/index.html';
                </SCRIPT>"
            );
        } else {
            $itemvenda_consulta = "SELECT id_venda FROM itensvenda WHERE id_venda = $id_venda";
            $result2 = mysqli_query($link, $itemvenda_consulta);
            if (mysqli_num_rows($result2) == 0) {
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Este pedido de venda não está cadastrado no banco de dados!')
                    window.location.href='http://localhost/DesafioPCP/index.html';
                    </SCRIPT>"
                );
            } else {
                $delete_reg_venda = "DELETE FROM itensvenda WHERE id_venda = '$id_venda' AND id_produto = '$id_produto'";
                $result = mysqli_query($link, $delete_reg_venda);
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Pedido de venda removido com sucesso!')
                    window.location.href='http://localhost/DesafioPCP/index.html';
                    </SCRIPT>"
                );
            }
        }
    }
?>