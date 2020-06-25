<html>

<head>
	<title>CRUD DE CLIENTE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">	
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
                                <li><a href="indexproduto.php">Produtos</a></li>
                                <li class="active"><a href="comprar.php">Comprar</a></li>
                                            </ul>
                                            </div>
                                            </div>
                                   
                                </nav>
                  </header>
   
          
	<div id="cpf" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Entre com seu CPF para Comprar</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" id="id" name="cpf" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                            <input type="submit" id="botao" class="btn btn-success" name="adicionar" value="Enviar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
     

   
          <div id="txtHint">
        
             </div>
            <div id="txtHint2">
        
            </div>
         <div class="container-fluid">
        <label for="lista">      
        <div id ="lista"></label>
            </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="comprar.js"></script>

</body>
</html>