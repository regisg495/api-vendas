<?php

require_once('../persistencia/connection.php');

class NotaFiscal {
    private $idnotafiscal;
    private $idcliente;
    private $data;

    public function __construct($idcliente, $data){
        $this->idcliente = $idcliente;
        $this->data = $data;
    }
    public function getIDCliente(){
        return $this->idcliente;
    }
    public function getData(){
        return $this->data;
    }
    public function save(){
        $pdo = Connection::getInstance();
        $query = $pdo->prepare("INSERT INTO NotaFiscal (idcliente, datanota) VALUES (:idcliente, :datanota);");
        $query->bindValue(":idcliente", $this->idcliente);
        $query->bindValue(":datanota", $this->data);
        return $query->execute();
    }
}

?>