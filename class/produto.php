<?php

require_once('../persistencia/connection.php');
require_once('DAO.php');

function loadAll2($valor1, $valor2){
    $pdo =  Connection::getInstance();
    $query = $pdo->prepare("SELECT * FROM Produto LIMIT $valor1, $valor2;");
    $query->execute();
    return $query->FetchAll(PDO::FETCH_OBJ);

}

class Produto implements DAO {
    private $idproduto;
    private $nome;
    private $preco;

    public function __construct($idproduto, $nome, $preco){
        $this->idproduto = $idproduto;
        $this->nome = $nome;
        $this->preco = $preco;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getID(){
        return $this->idproduto;
    }
    public function getPreco(){
        return $this->preco;
    }
    public function setID($idproduto){
        $this->idproduto = $idproduto;
    }
    public function delete(){
        $pdo =  Connection::getInstance();
        $query = $pdo->prepare("DELETE FROM Produto WHERE idproduto = :idproduto;");
        $query->bindValue(':idproduto', $this->idproduto);
        return $query->execute();
    }
    public function edit(){
        $pdo =  Connection::getInstance();
        $query = $pdo->prepare("UPDATE Produto SET nome = :nome, preco = :preco WHERE idproduto = :idproduto;");
        $query->bindValue(':nome', $this->nome);
        $query->bindValue(':preco', $this->preco);
        $query->bindValue(':idproduto', $this->idproduto);
        return $query->execute();
    }
    public function save(){
        $pdo =  Connection::getInstance();
        $query = $pdo-> prepare("INSERT INTO Produto (nome, preco) VALUES (:nome, :preco);");
        $query->bindValue(':nome', $this->nome);
        $query->bindValue(':preco', $this->preco);
        return $query->execute();
    }
    public function read(){
        $pdo =  Connection::getInstance();
        $query = $pdo->prepare("SELECT * FROM Produto WHERE idproduto = :idproduto;");
        $query->bindValue(':idproduto', $this->idproduto);
        return $query->execute();
    }
    function getVendas(){
        $pdo =  Connection::getInstance();
        $query = $pdo -> prepare("SELECT i.idnotafiscal, ROUND((i.quantidade * p.preco),2) as total, i.quantidade, p.preco FROM ItemVenda i INNER JOIN 
        PRODUTO p ON i.idproduto = p.idproduto AND p.idproduto = :idproduto;");
        $query->bindValue(':idproduto', $this->idproduto);
        $query->execute();
        return $query->FetchAll(PDO::FETCH_OBJ);
    }
    function getVendas2($min, $max){
        $pdo = Connection::getInstance();
        $query = $pdo -> prepare("SELECT i.idnotafiscal, ROUND((i.quantidade * p.preco),2) as total, i.quantidade, p.preco FROM ItemVenda i INNER JOIN 
        Produto p ON i.idproduto = p.idproduto AND p.idproduto = :idproduto LIMIT $min, $max;");
        $query->bindValue(':idproduto', $this->idproduto);
        $query->execute();
        return $query->FetchAll(PDO::FETCH_OBJ);
    }

}


?>