<?php
require_once('../persistencia/connection.php');

class ItemVenda implements DAO{
    private $iditemvenda;
    private $idnotafiscal;
    private $idproduto;
    private $quantidade;

    public function __construct($idnotafiscal, $idproduto, $quantidade){
        $this->idnotafiscal = $idnotafiscal;
        $this->idproduto = $idproduto;
        $this->quantidade = $quantidade;
    }
    public function save(){
        $pdo = Connection::getInstance();
        $query = $pdo->prepare("INSERT INTO ItemVenda (idnotafiscal, idproduto, quantidade) VALUES (:idnotafiscal, :idproduto, :quantidade);");
        $query->bindValue(':idnotafiscal', $this->idnotafiscal);
        $query->bindValue(':idproduto', $this->idproduto);
        $query->bindValue(':quantidade', $this->quantidade);
        return $query->execute();
    }

}