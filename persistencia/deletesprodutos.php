<?php

if(isset($_POST['deletar'])){
    require_once('../class/produto.php');

    
    $ids = explode(",", $_POST['ids']);

    $produto = new Produto(null, null, null);

    foreach($ids as $id){
        $produto->setID($id);
        $produto->delete();
    }
    header('Location: ../site/indexproduto.php');

}