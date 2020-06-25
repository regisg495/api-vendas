<?php


if(isset($_POST['editar'])){

    require_once('../class/cliente.php');

    $id = $_POST['idcliente'];
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $cpf = $_POST['cpf'];

    
    $cliente = new Cliente($nome, $cpf, $sexo);
    $cliente->setID($id);


    if($cliente->edit()){
        header('Location: ../site/indexcliente.php?atualizado');
    }else{
        header('Location: ../site/indexcliente.php?naoatualizado');
    }


}


?>