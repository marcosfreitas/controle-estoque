<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Controle de Estoque</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <style type="text/css" media="screen">
		body {

		  padding-top: 20px;
		  padding-bottom: 20px;
		}

		.navbar {
		  margin-bottom: 20px;
		}
    </style>

</head>
<body>
	<section class="container">

		<header class="row">
			<div class="col-xs-10 col-xs-offset-1">
				<nav class="navbar navbar-default">
				  <div class="container">
				    <div class="navbar-header">
				      <a class="navbar-brand" href="#">
				        <img alt="" width="20" height="20" src="<?php echo URL_APP; ?>assets/logo.png">
				      </a>
				    </div>

				    <ul class="nav navbar-nav">
			        	<li class=""><a href="<?php echo URL_APP; ?>">Início</a></li>
			        	<li class="dropdown">
			        		<a href="#" data-toggle="dropdown">Clientes <span class="caret"></span></a>
					          <ul class="dropdown-menu">
					            <li><a href="<?php echo URL_APP; ?>?controller=cliente&acao=adicionar">Adicionar</a></li>
					            <li><a href="<?php echo URL_APP; ?>?controller=cliente&acao=listar">Listar</a></li>
					          </ul>
					        </li>
			        	</li>
			        	<li class="dropdown">
			        		<a href="#" data-toggle="dropdown">Produtos <span class="caret"></span></a>
					          <ul class="dropdown-menu">
					            <li><a href="<?php echo URL_APP; ?>?controller=produto&acao=adicionar">Adicionar</a></li>
					            <li><a href="<?php echo URL_APP; ?>?controller=produto&acao=listar">Listar</a></li>
					          </ul>
					        </li>
			        	</li>
			        	<li class="dropdown">
			        		<a href="#" data-toggle="dropdown">Pedidos <span class="caret"></span></a>
					          <ul class="dropdown-menu">
					            <li><a href="<?php echo URL_APP; ?>?controller=pedido&acao=adicionar">Adicionar</a></li>
					            <li><a href="<?php echo URL_APP; ?>?controller=pedido&acao=listar">Listar</a></li>
					          </ul>
					        </li>
			        	</li>
			      	</ul>
				  </div>
				</nav>

				<?php
				  	if (session_status() !== 0 && session_status() !== 'PHP_SESSION_DISABLED') {

						if (isset($_SESSION['message'])) {
					 		echo '<div class="alert alert-info">'. $_SESSION['message'] ."</div>"; 
				 			unset($_SESSION['message']);
					 	}
					} else {
						echo '<div class="alert alert-danger">Sessões desativadas, o sistema deixará de mostrar mensagens.</div>';
					}


				?>

			</div>
		</header>