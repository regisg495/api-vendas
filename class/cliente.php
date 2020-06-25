<?php
require_once('../persistencia/connection.php');
require_once('DAO.php');


function loadAll(){
    $connection = Connection::getInstance();
    $query = $connection->prepare("SELECT * FROM Cliente;");
    $query -> execute();
    return $query->FetchAll(PDO::FETCH_OBJ);

}
function loadAll2($valor1, $valor2){
    $connection = Connection::getInstance();
    $query = $connection->prepare("SELECT * FROM Cliente LIMIT $valor1, $valor2;");
    $query -> execute();
    return $query->FetchAll(PDO::FETCH_OBJ);

}

class Cliente implements DAO {
    private $id;
    private $nome;
    private $cpf;
    private $sexo;
    

    public function __construct($nome, $cpf, $sexo){
        $this ->nome = $nome;
        $this ->cpf = $cpf;
        $this ->sexo = $sexo;
    }

    public function getID(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getCPF(){
        return $this->cpf;
    }
    public function getSexo(){
        return $this->sexo;
    }
    public function setID($id){
        $this->id = $id;
    }
    public function load(){
        $pdo =  Connection::getInstance();
        $query = $pdo->prepare("SELECT * FROM Usuario WHERE idcliente = ':idcliente';");
        $query->bindValue(':nome', $this->id);
        $query->execute();
        return $query ->FetchAll(PDO::FETCH_OBJ);

    }
    public function save(){
        $connection =  Connection::getInstance();
        $query = $connection->prepare("INSERT INTO Cliente(nome, cpf, sexo) VALUES (:nome,:cpf,:sexo);");
        $query->bindValue(':nome', $this->nome);
        $query->bindValue(':cpf', $this->cpf);
        $query->bindValue(':sexo', $this->sexo);
        return $query->execute();

    }
    public function delete(){
        $connection =  Connection::getInstance();
        $query = $connection->prepare("DELETE FROM Cliente WHERE idcliente = :id;");
        $query->bindValue(':id', $this->id);
        return $query ->execute();
    }
    public function edit(){
        $connection =  Connection::getInstance();
        $query = $connection->prepare("UPDATE Cliente SET nome = :nome, cpf = :cpf, sexo = :sexo WHERE idcliente = :idcliente;");
        $query->bindValue(':nome', $this->nome);
        $query->bindValue(':cpf', $this->cpf);
        $query->bindValue(':sexo', $this->sexo);
        $query->bindValue(':idcliente', $this->id);
        return $query->execute();
    }
    public function read(){
        $connection =  Connection::getInstance();
        $query = $connection->prepare("SELECT * FROM Cliente WHERE idcliente = :idcliente;");
        $query->bindValue(':idcliente', $this->id);
        return $query->execute();
    }

    public function getCompras(){
        $connection =  Connection::getInstance();
        $query = $connection->prepare("SELECT p.nome, nf.datanota, nf.idnotafiscal, ROUND((p.preco), 2) as preco, i.quantidade, ROUND((i.quantidade * p.preco), 2) as total FROM Produto p INNER JOIN 
        ItemVenda i ON i.idproduto = p.idproduto INNER JOIN 
        NotaFiscal nf ON i.idnotafiscal = nf.idnotafiscal AND idcliente = :idcliente;");
        $query->bindValue(':idcliente', $this->id);
        $query->execute();
        return $query->FetchAll(PDO::FETCH_OBJ);
    }
    public function getComprasLimit($min, $max){
        $connection =  Connection::getInstance();
        $query = $connection->prepare("SELECT p.nome, nf.datanota, nf.idnotafiscal, ROUND((p.preco),2) as preco, i.quantidade, ROUND((i.quantidade * p.preco),2) as total FROM Produto p INNER JOIN 
        ItemVenda i ON i.idproduto = p.idproduto INNER JOIN 
        NotaFiscal nf ON i.idnotafiscal = nf.idnotafiscal AND idcliente = :idcliente LIMIT $min, $max;");
        $query->bindValue(':idcliente', $this->id);
        $query->execute();
        return $query->FetchAll(PDO::FETCH_OBJ);
    }
   
}

?>