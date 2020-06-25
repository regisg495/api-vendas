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
<script>
    $(window).on('load',function(){
        $('#nomecliente').modal('show');
    });

	
</script>

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
						<li><a href="indexproduto.php">Produtos</a></li>
                        <li><a href="comprar.php">Comprar</a></li>
				                	</ul>
                                    </div>
                                    </div>
                           
		                </nav>
				</header>
				<?php

				require_once('../class/cliente.php');
				require_once('../persistencia/connection.php');

				session_start();
				

				if(isset($_POST['relatorio'])){
						
				$cliente = new Cliente(null, null, null);
				$cliente->setID($_POST['idcliente']);
				$_SESSION['cliente'] = $cliente;
				
				}
			
				 ?>

				

                <?php
                $pdo = Connection::getInstance();
                $query = $pdo->prepare("SELECT nome FROM Cliente WHERE idcliente = :idcliente;");
                $query->bindValue(":idcliente", $_SESSION['cliente']->getID());
                $query->execute();
                $result = $query->FetchAll(PDO::FETCH_ASSOC);

                ?>
              

                <div class="container-fluid">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2><i style="color: #F0F8FF;">Histórico do Cliente <?= $result[0]['nome'];?></i></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
	<div class="container-fluid">
		<table style="margin-top:2px" class="table table-striped table-dark">
			<thead>
				<tr>
					<th scope="col">ID da Nota Fiscal</th>
					<th scope="col">Data da Compra</th>
					<th scope="col">Nome do Produto</th>
					<th scope="col">Preço</th>
					<th scope="col">Quantidade</th>
					<th scope="col">Total</th>
				</tr>
			</thead>
			<tbody>
				<tr>
                <?php
							$quantidade = 6;
							$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;

							$inicio = ($quantidade * $pagina) - $quantidade;
                            
							$dados = $_SESSION['cliente']->getComprasLimit($inicio, $quantidade);
							foreach($dados as $valores):
                            ?>
                    <td>
						<?= $valores->idnotafiscal;?>
					</td>
					<td>
						<?= $valores->datanota;?>
					</td>
					<td>
						<?= $valores->nome;?>
                    </td>
                    <td>
                            <?= "R$ ".$valores->preco;?>
                    </td>
                    <td>
                        <?= $valores->quantidade;?>
                    </td>
                    <td>
                        <?= "R$ ".$valores->total;?>
                            </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                            </table>
                            
							<?php

								$query = $_SESSION['cliente']->getCompras();
								
								$total = count($query);
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
	
    <footer class="footer">
		<i>© Trabalho Final do Telecken - Todos os Direitos Reservados</i>
	</footer>

</body>
    
</html>
