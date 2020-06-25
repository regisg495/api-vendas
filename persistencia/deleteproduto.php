<?php

if(isset($_POST['enviar'])){

    require_once('../class/produto.php');

    $idproduto = $_POST['idproduto'];

    $produto = new Produto($idproduto,null,null);

    
    if($produto->delete()){
        header('Location: ../site/indexproduto.php?deletado');
    }else{
        header('Location: ../site/indexproduto.php?naodeletado');
    }
}

?>