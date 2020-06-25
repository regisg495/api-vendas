<?php

if(isset($_POST['adicionar'])){
    require_once('../class/produto.php');

    $nome = $_POST['nome'];
    $preco = (float)$_POST['preco'];

    $produto = new Produto(null, $nome, $preco);

    if($produto->save()){
        header('Location: ../site/indexproduto.php?adicionado');
    } else{
        header('Location: ../site/indexproduto.php?naoadicionado');
    }

}
