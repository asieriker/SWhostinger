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
		if(!isset($_SESSION['email']) ){?>
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
		<span><a href="layout.php">Inicio</a></spam>
		<span><a href='creditos.html'>Creditos</a></spam>
	</nav>
    <section class="main" id="s1">
    
	<div>
<?php
	$servername = getenv('IP');
	$username = getenv('C9_USER');
	$password = "";
	$dbport = 3306;
	// Create connection
	$link = new mysqli($servername, $username, $password, "quiz", $dbport);
	//$link = mysqli_connect("mysql.hostinger.es", "u410012855_root", "quepazaloko23", "u410012855_quiz");
	
	$preguntas = mysqli_query($link, "select * from pregunta" );
	echo '<div align="center">';
	echo '<table border=1> <tr> 
		<th> Numero </th> 
		<th> Email </th> 
		<th> Pregunta</th>
		<th> Respuesta</th>
		<th> Complejidad</th>
	</tr>';
	
	while ($row = mysqli_fetch_array( $preguntas )) {
		echo '<tr><td>' . $row['Numero'] . '</td> <td>' . $row['Email'] . '</td>
		 <td>' . $row['Pregunta'] . '</td> <td>' . $row['Respuesta'] .'</td> <td>' . $row['Complejidad'] . '</td></tr>';
	}
	
	echo '</table>';
	echo '</div>';
	$ip=$_SERVER['REMOTE_ADDR'];
	$sql="INSERT INTO acciones (Tipo, Hora, IP) VALUES('VerPreguntas',CURTIME(), '$ip')";
	if (!mysqli_query($link ,$sql)){
		die('Error: ' . mysqli_error($link));
	}
	$preguntas->close(); //poner notacion no OO
	mysqli_close($link);

?>
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>