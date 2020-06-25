<?php

if(isset($_POST['adicionar'])){

    require_once('../class/cliente.php');

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['sexo'];

    $cons = new Cliente($nome, $cpf, $sexo);

    if($cons->save()){
        header('Location: ../site/indexcliente.php?adicionado');
    } else{
        header('Location: ../site/indexcliente.php?naoadicionado');
    }

    
}

?>