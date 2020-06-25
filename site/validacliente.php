<?php

require_once('../persistencia/connection.php');

$cpf = $_REQUEST['cpf'];

$pdo =  Connection::getInstance();
$query = $pdo->prepare("SELECT * FROM Cliente WHERE cpf = :cpf;");
$query->bindValue('cpf', $cpf);

$query->execute();

$result = $query->FetchAll(PDO::FETCH_OBJ);



?>

    	<div class="container-fluid">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2><i style="color: #F0F8FF;">Bem Vindo <?= $result[0]->nome;?></i></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
  <form>
    <div class="form-group">
        <input type="hidden" id="id_cliente" value="<?= $result[0]->idcliente;?>">
        <label for="nomeproduto">Produto</label>
      <select class="form-control" id="idproduto" name="idproduto" onchange="mostrar(this.value)">
            
          <option value="" selected>Escolha um Produto</option>
      <?php 
      $query = $pdo->prepare("SELECT idproduto, nome FROM Produto;");
      $query->execute();
      $dados = $query->FetchAll(PDO::FETCH_OBJ);
      foreach($dados as $valores):
      ?>
      <option value="<?= $valores->idproduto;?>"><?= $valores->nome;?></option>
      <?php endforeach;?>
      </select>

      </div>

  </form>

