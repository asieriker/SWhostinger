<?php
		session_start();
		if(!isset($_SESSION['email'])){
			header("Location: layout.html");
		}
		$link = mysqli_connect("mysql.hostinger.es", "u410012855_root", "quepazaloko23", "u410012855_quiz");
		if (!$link){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}

		$sql = mysqli_query($link,"SELECT * FROM pregunta");
		$numPregTotal=mysqli_num_rows($sql);
		$usuario = $_SESSION['email'];
		$sql = mysqli_query($link,"SELECT * FROM pregunta WHERE email='$usuario' ");
		$numPregUsuario=mysqli_num_rows($sql);

		echo "Mis preguntas/Todas las preguntas: " . $numPregUsuario . "/". $numPregTotal;
		mysqli_close($link);
?>