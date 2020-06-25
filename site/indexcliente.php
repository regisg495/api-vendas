<?php

session_start();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>CRUD DE CLIENTE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

	<script type="text/javascript">

$(document).ready(function() {
        $(".deletes").click(function(e) {
            var checados = [];
            $.each($("input[name='deletes[]']:checked"), function(){            
                checados.push($(this).val());
            });
            console.log(checados.join(", "));
			document.getElementById("iddeletes").value = checados;
        });
	});

	$('#openBtn').click(function(){
	$('#myModal').modal({show:true})
});

</script>
		
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
									<li class="active"><a href="indexcliente.php">Cliente</a></li>
									<li><a href="indexproduto.php">Produtos</a></li>
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
						<h2><i style="color: #F0F8FF;">Cadastro de Clientes</i></h2>
					</div>
					<div class="col-sm-6">
						<a href="#adicionarcliente" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i>
							<span>Adicionar Cliente</span></a>
						<a href="#deletegrupoModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i>
							<span>Deletar Clientes</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<table style="margin-top:2px" class="table table-striped table-dark">
			<thead>
				<tr>
					<th scope="col">Escolher</th>
					<th scope="col">Nome</th>
					<th scope="col">CPF</th>
					<th scope="col">Sexo</th>
					<th scope="col">Remover</th>
					<th scope="col">Atualizar</th>
					<th scope="col">Relatorio</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php
							require_once('../persistencia/connection.php');
                            require_once('../class/cliente.php');
							
							$quantidade = 6;
							$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;

							$inicio = ($quantidade * $pagina) - $quantidade;

							$dados = loadAll2($inicio, $quantidade);
							foreach($dados as $valores):
							?>

					<td><label class="customcheck"><input type="checkbox" class="deletes" id="<?= $valores->idcliente;?>" name="deletes[]" value="<?= $valores->idcliente;?>">
						<span class="checkmark"></span></label></td>
					<td>
						<?= $valores->nome;?>
					</td>
					<td>
						<?= $valores->cpf;?>
					</td>
					<td><img <?php if($valores->sexo ==="M"){ echo "src=../img/man-icon.png"; } else echo "src=../img/images.jpg";?>></td>
					<td><a href="#deletecliente<?= $valores->idcliente;?>" class="delete" data-toggle="modal"><button type="button"
							 class="btn btn-default btn-sm" title="delete" data-toggle="modal" data-target="modaldelete">
								<span class="glyphicon glyphicon-remove"></span>
							</button></a></td>
					<td><a href="#editcliente<?= $valores->idcliente;?>" class="edit" data-toggle="modal"><button type="button" class="btn btn-default btn-sm">
								<span class="glyphicon glyphicon-pencil"></span>
							</button></a></td>
					<td><form method="post" action="relatoriocliente.php"><input type="hidden" name="idcliente" value="<?= $valores->idcliente;?>"><button name="relatorio" class="btn btn-default btn-sm" type="submit">
							<span class="glyphicon glyphicon-th-list"></span></button>
						</form></td>
				</tr>
				
				
				<div id="deletecliente<?= $valores->idcliente;?>" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form method="post" action="../persistencia/deletecliente.php">

								<input type="hidden" name="idcliente" value="<?= $valores->idcliente;?>">
								<div class="modal-header">

									<h4 class="modal-title">Deletar Cliente</h4>
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
	
	
				<!-- Modal de Delete 1 -->

				<div id="deletecliente<?= $valores->idcliente;?>" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form method="post" action="../persistencia/deletecliente.php">

								<input type="hidden" name="idcliente" value="<?= $valores->idcliente;?>">
								<div class="modal-header">

									<h4 class="modal-title">Deletar Cliente</h4>
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
			  
	<div id="editcliente<?= $valores->idcliente;?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="../persistencia/editcliente.php" method="post">

					<input type="hidden" name="idcliente" value="<?= $valores->idcliente;?>">

					<div class="modal-header">
						<h4 class="modal-title">Editar Cliente</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Nome</label>
							<input type="text" name="nome" value="<?= $valores->nome;?>" class="form-control" required>
						</div>
						<div class="form-group">
							<label>CPF</label>
							<input type="cpf" name="cpf" value="<?= $valores->cpf;?>" class="form-control" required>
						</div>

						<div class="form-group">
							<p><label>Sexo</label></p>

							<label class="radio-inline"><input type="radio" <?php if($valores->sexo==="M") echo "checked";?>
								value="M" name="sexo">Masculino</label>
							<label class="radio-inline"><input type="radio" <?php if($valores->sexo==="F") echo "checked";?>
								value="F" name="sexo">Feminino</label>

						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-info" name="editar" value="Confirmar">
					</div>

				</form>
				
			</div>
		</div>
	</div>
	<?php endforeach;?>
	</tbody>
	</table>
	
	<?php
								$pdo = Connection::getInstance();
								$query = $pdo->prepare("SELECT idcliente FROM Cliente;");
								$query -> execute();
								$total = $query->rowCount();
								$totalPagina = ceil($total/$quantidade);
								$exibir = 3;
								$anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
								$posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;
								?>


	<div  class="clearfix">
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
	

	<div id="adicionarcliente" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="../persistencia/addcliente.php" method="post">
					<div class="modal-header">
						<h4 class="modal-title">Adicionar Cliente</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Nome</label>
							<input type="text" name="nome" class="form-control" required>
						</div>
						<div class="form-group">
							<label>CPF</label>
							<input type="text" name="cpf" class="form-control" required>
						</div>
						<div class="form-group">
							<p><label>Sexo</label></p>
							<label class="radio-inline"><input type="radio" value="M" name="sexo">Masculino</label>
							<label class="radio-inline"><input type="radio" value="F" name="sexo">Feminino</label>
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
	
	<div id="deletegrupoModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="../persistencia/deletesclientes.php" method="post">
					<input type="hidden" id="iddeletes" name="ids">
				
					<div class="modal-header">
						<h4 class="modal-title">Deletar Clientes</h4>
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