<?php

require_once('../persistencia/connection.php');
require_once('../class/notafiscal.php');
require_once('../class/itemvenda.php');

$carrinho= $_GET['carrinho'];
$compras = json_decode($carrinho);

array_shift($compras->produtos);

$pdo =  Connection::getInstance();

$pdo->beginTransaction();

$notafiscal = new NotaFiscal((int)$compras->idcomprador, (string)$compras->data);

if(!$notafiscal->save()){
    die("Erro!");
} 

$query1 = $pdo->prepare("SELECT MAX(idnotafiscal) as lastid FROM NotaFiscal;");
if(!$query1->execute()){
     $pdo->rollBack();
     die("Houve um erro");

    } 
   
    $id = $query1->FetchAll(PDO::FETCH_OBJ);


   foreach($compras->produtos as $values){
       $itemvenda = new ItemVenda($id[0]->lastid, (int)$values->idproduto, (double)$values->quantidade);
        if(!$itemvenda->save()){
            $pdo->rollBack();
            die("Houve um erro");
        }


    }
    $pdo->commit();

    
    ?>

