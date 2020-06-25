
<?php

if(isset($_POST['editar'])){
    require_once('../class/produto.php');

    $idproduto = $_POST['idproduto'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    $produto = new Produto($idproduto, $nome, $preco);

    if($produto->edit()){
        header('Location: ../site/indexproduto.php?atualizado');
    }else{
        header('Location: ../site/indexproduto.php?naoatualizado');
    }
}

