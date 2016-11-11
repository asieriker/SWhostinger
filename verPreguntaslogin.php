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
		<span class="right"><?php echo $_GET['email']?></span>
		<span class="right"><a href="layout.html">Desconectar</a></span>
      	<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href="layoutin.php?email=<?php echo $_GET['email'] ?>">Inicio</a></spam>
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
$preguntas->close(); //poner notacion no OO
$ip=$_SERVER['REMOTE_ADDR'];
$email=$_GET['email'];
$sql = mysqli_query($link, "SELECT MAX(Id)FROM conexiones WHERE Correo='$email'" );	
$resultado=mysqli_fetch_row($sql);
$Id=$resultado[0];
$sql="INSERT INTO acciones (IdConexion, Correo, Tipo, Hora, IP)values('$Id','$email', 'VerPreguntas',CURTIME(), '$ip')";
if (!mysqli_query($link ,$sql)){
		die('Error: ' . mysqli_error($link));
	}
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




