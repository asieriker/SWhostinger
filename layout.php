<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<?php
		session_start();
		if(!isset($_SESSION['email'])){?>
			<span class="right"><a href="registroHTML5.php">Registrarse </a></span>
			<span class="right"><a href="Login.php"> Login</a></span>
			<?php
		}else{
			?>
			<span class="right">Sesión iniciada como <b><?php echo $_SESSION['email']?> </b></span>
      <span class="right"><a href="Logout.php">Logout</a></span>
      <?php
		}
		?>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='verPreguntas.php'>Ver preguntas</a></spam>
		<?php
		if($_SESSION['rol']=="alumno"){?>
			<span><a href='GestionPreguntas.php'>Gestionar preguntas</a></spam>
		<?php
		}else if($_SESSION['rol']=="profesor"){
		?>
			<span><a href='Revision.php'>Revisar preguntas</a></spam>
		<?php
		}
		?>
			<span><a href='creditos.html'>Creditos</a></spam>
	</nav>
    <section class="main" id="s1">
    
	<div>
	<img src="imagenes/interes.png">
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/asieriker/SWhostinger'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
