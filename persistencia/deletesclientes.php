<?php
require_once('../class/cliente.php');

if(isset($_POST['deletar'])){

    $ids = explode(",", $_POST['ids']);

    $cliente = new Cliente(null, null, null);

    foreach($ids as $id){
        $cliente->setID($id);
        $cliente->delete();
    }
    header('Location: ../site/indexcliente.php');

}
