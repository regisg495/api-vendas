<?php

require_once('../class/cliente.php');

if(isset($_POST['enviar'])){
    $idcliente = $_POST['idcliente'];

    $cliente = new Cliente(null,null,null);
    $cliente->setID($idcliente);
    


    if($cliente->delete()){
        header('Location: ../site/indexcliente.php?deletado');
    } else{
        header('Location: ../site/indexcliente.php?naodeletado');
    }

   
}

?>