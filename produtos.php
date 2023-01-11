<?php

    include("connection.php");
    $operacao = $_POST["operacao"];

    if ($operacao == "cadastro_produto"){

        $nome_prod = $_POST["nome_produto"];
        $qtd_ini = $_POST["qtd_ini_estoque"];

        if($nome_prod == null){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Você deve preencher o nome do produto para incluí-lo no banco de dados!!')
                window.location.href='http://localhost/DesafioPCP/index.html';
                </SCRIPT>"
            );
        } elseif ($qtd_ini == null){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Você deve preencher a quantidade inicial do produto para incluí-lo no banco de dados!!')
                window.location.href='http://localhost/DesafioPCP/index.html';
                </SCRIPT>"
            );
        } else {
            $consulta_produto = "SELECT Descricao FROM produtos where Descricao like '%".$nome_prod."%'";
            $result = mysqli_query($link, $consulta_produto);
            if(mysqli_num_rows($result) > 0){
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Este produto já está inserido em seu banco de dados, verifique se você digitou o nome do produto corretamente ou adicione o produto ao seu estoque!!')
                window.location.href='http://localhost/DesafioPCP/index.html';
                </SCRIPT>"
             );
            } else {
                $inserir_produtos = "INSERT INTO produtos(Descricao, Estoque) values ('$nome_prod', $qtd_ini)";
                $result = mysqli_query($link, $inserir_produtos);
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Produto inserido com sucesso!')
                    window.location.href='http://localhost/DesafioPCP/index.html';
                    </SCRIPT>"
                );
            }
        }
    } elseif ($operacao == "consulta_produto"){

        $descricao = $_POST["produto"];
        
        if ($descricao == null) {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Você deve preencher o nome do produto para consultar sua quantidade no banco de dados!!')
                window.location.href='http://localhost/DesafioPCP/index.html';
                </SCRIPT>"
            );
        } else {
            $selecionar_qtd_estoque = " SELECT Descricao, Estoque FROM produtos where  Descricao like '%".$descricao."%'";
            $result = mysqli_query($link, $selecionar_qtd_estoque);
            if(mysqli_num_rows($result) == 0){
                echo("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Este produto não está cadastrado em seu banco de dados!')
                    window.location.href='http://localhost/DesafioPCP/index.html';
                    </SCRIPT>"
                );
            }
            $row = $result->fetch_array(MYSQLI_NUM);
            
            printf("Quantidade de %s em estoque: %s !\n", $row[0], $row[1]);
            echo "<br><input type='button' value='Voltar'
                onclick='voltar()'>";
            echo "<script>
                function voltar(){ window.location.href='http://localhost/DesafioPCP/index.html';}
            </script>";
        }

    } elseif ($operacao == "inserir_estoque") {

        $produto = $_POST["nome_prod"];
        $quantidade = $_POST["quantidade"];
        if($produto == null){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Você deve preencher o nome do produto para inserir seu estoque no banco de dados!!')
                window.location.href='http://localhost/DesafioPCP/index.html';
                </SCRIPT>"
            );
        } elseif ($quantidade == null){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Você deve preencher a quantidade do produto para acrescentá-la ao estoque no banco de dados!!')
                window.location.href='http://localhost/DesafioPCP/index.html';
                </SCRIPT>"
            );
        } else {
            $consulta_prod = "SELECT Descricao FROM produtos WHERE Descricao = '$produto'";
            $result = mysqli_query($link, $consulta_prod);
            if(mysqli_num_rows($result) == 0){
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Este produto não está cadastrado no banco de dados!')
                    window.location.href='http://localhost/DesafioPCP/index.html';
                    </SCRIPT>"
                );
            } else {
                $inserir_estoque = "UPDATE produtos set Estoque = Estoque + $quantidade where Descricao LIKE '%".$produto."%'";
                $result = mysqli_query($link, $inserir_estoque);
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Estoque inserido com sucesso!')
                    window.location.href='http://localhost/DesafioPCP/index.html';
                    </SCRIPT>"
                );
            }
        }

    } else {
    
        $id_product = $_POST["id_product"];
        $prod_name = $_POST["product_name"];

        if($id_product == null){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Você deve preencher o identificador do produto para removê-lo do banco de dados!!')
                window.location.href='http://localhost/DesafioPCP/index.html';
                </SCRIPT>"
            );
        } elseif ($prod_name == null){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Você deve preencher o nome do produto para removê-lo do banco de dados!!')
                window.location.href='http://localhost/DesafioPCP/index.html';
                </SCRIPT>"
            );
        } else {
            $delete_prod = "DELETE FROM produtos WHERE id_produto = $id_product";
            $result = mysqli_query($link, $delete_prod);
            if(mysqli_num_rows($result) == 0){
                echo("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Este produto não está cadastrado em seu banco de dados!')
                    window.location.href='http://localhost/DesafioPCP/index.html';
                    </SCRIPT>"
                );
            } else {
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Produto removido com sucesso!')
                    window.location.href='http://localhost/DesafioPCP/index.html';
                    </SCRIPT>"
                );
            }
        }
        
    }


?>