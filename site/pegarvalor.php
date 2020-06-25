<?php
require_once('../persistencia/connection.php');

$id = intval($_GET['idproduto']);
$pdo = Connection::getInstance();

$query = $pdo->prepare("SELECT nome, preco FROM Produto WHERE idproduto = :idproduto;");
$query->bindValue(':idproduto', $id);

$query->execute();
$value = $query->FetchAll(PDO::FETCH_OBJ);
?>

      <div class="form-group">
            <label>Preco</label>
            <input type="number" name="preco" id="preco" value="<?= $value[0]->preco;?>" class="form-control" disabled>
        </div>
        <div class="form-group">
            <label>Quantidade</label>
            <input type="number" id="quantidade" name="quantidade" min="1" id="quantidade" onkeyup="calcula()" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Total</label>
            <input type="number" name="total"  id="total" class="form-control" disabled>
        </div>
        <p><input type="hidden"  name="nome_produto" id="nome_produto" value="<?= $value[0]->nome;?>"></p><br>
        <input type="button" class="btn btn-default" value="Adicionar" onclick = "insere()">
        &emsp;<input type="button"  class="btn btn-default" value="enviar" onclick="enviar()">

