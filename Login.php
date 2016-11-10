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
		<span class="right"><a href="registroHTML5.php">Registrarse</a></span>
      		<span class="right"><a href="Login.php">Login</a></span>
      		<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='verPreguntas.php'>Preguntas</a></spam>
		<span><a href='creditos.html'>Creditos</a></spam>
	</nav>
    <section class="main" id="s1">
    
	<div>
		<form id="login" action="Login.php"   method="post">           
		<h2>Identificación de usuario </h2>                
			Email   : <input type="email"  required id="email" name="email" size="21" value="" /><br>               
			Password: <input type="password" required id="pass" name="pass" size="21" value="" /><br>
			Repetir Password: <input type="password" required id="pass2" name="pass2" size="21" value="" /><br>
			<input id="input" type="submit" value="Inicar sesion"/>
		</form>
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/asieriker/SWhostinger'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
<?php
	if (isset($_POST['email']) && isset($_POST['pass'])&&isset($_POST['pass2'])){
		$link = mysqli_connect("mysql.hostinger.es", "u410012855_root", "quepazaloko23", "u410012855_quiz");
		if (!$link){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}
	
	$email=$_POST['email'];
	$pass=$_POST['pass']; 
	$pass2=$_POST['pass2'];
	if($pass!=$pass2){
		echo '<script language="javascript">alert("Las contraseñas no coinciden");</script>'; 
	}else{
		$usuarios = mysqli_query($link,"select * from usuario where Correo='$email' and Contrasena='$pass'"); 
		$cont= mysqli_num_rows($usuarios); 
			
		if($cont==1){
			$sql="INSERT INTO conexiones (Correo, Hora) VALUES ('$email',CURTIME())";
			if (!mysqli_query($link ,$sql))
			{
				die('Error: ' . mysqli_error($link));
			}
			mysqli_close($link); 
			session_start();
			$_SESSION["autentificado"]="SI";
			header("Location: GestionPreguntas.php?email=$email");
		}else{
			echo '<script language="javascript">alert("Datos incorrectos");</script>'; 
		}
	}
	}
	
?>