<?php

session_start();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CRUD DE PRODUTO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".deletes").click(function (e) {
                var checados = [];
                $.each($("input[name='deletes[]']:checked"), function () {
                    checados.push($(this).val());
                });
                console.log(checados.join(", "));
                document.getElementById("iddeletes").value = checados;
            });
        });

    </script>

</head>

<body>

        <header>
                <nav class="navbar navbar-inverse">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse" id="myNavbar">
                                <ul class="nav navbar-nav">
                                    <li><a href="indexcliente.php">Cliente</a></li>
                                    <li class="active"><a href="indexproduto.php">Produtos</a></li>
                                    <li><a href="comprar.php">Comprar</a></li>
                                                </ul>
                                                </div>
                                                </div>
                                       
                                    </nav>
                      </header>

    <div class="container-fluid">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                            <h2><i style="color: #F0F8FF;">Cadastro de Produtos</i></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#adicionarproduto" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i>
                            <span>Adicionar Produto</span></a>
                        <a href="#deleteprodutos" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i>
                            <span>Deletar Produto</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">Escolher</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preco</th>
                    <th scope="col">Remover</th>
                    <th scope="col">Atualizar</th>
                    <th scope="col">Relatorio</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                                    require_once('../persistencia/connection.php');
                                    require_once('../class/produto.php');
                                    
                                    $quantidade = 6;
                                    $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
        
                                    $inicio = ($quantidade * $pagina) - $quantidade;
        
                                    $dados = loadAll2($inicio, $quantidade);
                                    foreach($dados as $valores):
                                    ?>
                    <td><label class="customcheck"><input type="checkbox" class="deletes" id="<?= $valores->idproduto;?>"
                                name="deletes[]" value="<?= $valores->idproduto;?>">
                            <span class="checkmark"></span></label></td>
                    <td>
                        <?= $valores->nome;?>
                    </td>
                    <td><?= 'R$ '.$valores->preco;?></td>
                    <td><a href="#deleteproduto<?= $valores->idproduto;?>" class="delete" data-toggle="modal"><button
                                type="button" class="btn btn-default btn-sm" title="delete" data-toggle="modal"
                                data-target="modaldelete">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button></a></td>
                    <td><a href="#editproduto<?= $valores->idproduto;?>" class="edit" data-toggle="modal"><button type="button"
                                class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button></a></td>
                    <td>
                        <form method="get" action="relatorioproduto.php">                               
                            <button name="relatorio" type="submit" 
                                value="<?= $valores->idproduto;?>" class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-th-list"></span>
                            </button>
                        </form>
                    </td>
                </tr>
         
                <!-- Modal de Delete 1 -->

                <div id="deleteproduto<?= $valores->idproduto;?>" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="../persistencia/deleteproduto.php">

                                <input type="hidden" name="idproduto" value="<?= $valores->idproduto;?>">
                                <div class="modal-header">

                                    <h4 class="modal-title">Deletar Produto</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Tem certeza que deseja deletar?</p>
                                    <p class="text-warning"><small>Essa ação não poderá ser desfeita</small></p>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                                    <input type="submit" class="btn btn-danger" name="enviar" value="Confirmar">

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
    </div>
    <!-- Modal de edit -->
    <div id="editproduto<?= $valores->idproduto;?>" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../persistencia/editproduto.php" method="post">

                    <input type="hidden" name="idproduto" value="<?= $valores->idproduto;?>">

                    <div class="modal-header">
                        <h4 class="modal-title">Editar Produto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nome" value="<?= $valores->nome;?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                                <label>Preco</label>
                                <input type="text" name="preco" value="<?= $valores->preco;?>" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-info" name="editar" value="Confirmar">
                        </div>

                </form>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    </tbody>
    </table>
    <?php
    $pdo = Connection::getInstance();
    $query = $pdo->prepare("SELECT idproduto FROM Produto;");
    $query -> execute();
    $total = $query->rowCount();
    $totalPagina = ceil($total/$quantidade);
    $exibir = 3;
    $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
    $posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;
    ?>


    <div class="clearfix">
        <ul class="pagination">

            <li class="page-item">
                <?= "<a href=\"?pagina=$anterior\" class='page-link'>anterior</a>";?>
            </li>

            <?php
for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
if($i > 0){
echo "<li class='page-item'>";
echo '<a href="?pagina='.$i.'" class=page-link> '.$i.' </a></li>';
}
}
echo "<li class='page-item'>";
echo '<a href="?pagina='.$pagina.'" class=page-link><strong>'.$pagina.'</strong></a></li>';

for($i = $pagina+1; $i < $pagina+$exibir; $i++){
if($i <= $totalPagina){
echo "<li class='page-item'>";
echo '<a href="?pagina='.$i.'" class=page-link> '.$i.' </a></li>';
}
}
?>

            <li class="page-item">
                <?= "<a href=\"?pagina=$posterior\" class='page-link'>posterior</a>";?>
            </li>


        </ul>
    </div>
    </div>
    </div>

    <!-- Modal de add -->
    <div id="adicionarproduto" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../persistencia/addproduto.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Adicionar Produto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="form-group">
                                <label>Preco</label>
                                <input type="text" name="preco" class="form-control" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" name="adicionar" value="Adicionar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <div id="deleteprodutos" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../persistencia/deletesprodutos.php" method="post">
                    <input type="hidden" id="iddeletes" name="ids">

                    <div class="modal-header">
                        <h4 class="modal-title">Deletar Produtos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja deletar?</p>
                        <p class="text-warning"><small>Essa ação não poderá ser desfeita</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete" name="deletar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer">
        <i>© Trabalho Final do Telecken - Todos os Direitos Reservados</i>
    </footer>
</body>

</html>