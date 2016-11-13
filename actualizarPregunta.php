<?php	
	if (isset($_GET['id']) && isset($_GET['email']) && isset($_GET['preg']) && isset($_GET['resp'])&& ($_GET['id']!="")&& ($_GET['email']!="") && ($_GET['preg']!="")&& ($_GET['resp']!="")){
		$servername = getenv('IP');
		$username = getenv('C9_USER');
		$password = "";
		$dbport = 3306;
	    // Create connection
	    $link = new mysqli($servername, $username, $password, "quiz", $dbport);
		//$link = mysqli_connect("mysql.hostinger.es", "u410012855_root", "quepazaloko23", "u410012855_quiz");
		if (!$link){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}
		$id=$_GET['id'];
		$email=$_GET['email'];
		$preg=$_GET['preg']; 
		$resp=$_GET['resp'];
		$comp=$_GET['comp'];
		
		$sql="UPDATE pregunta SET Email='$email', Pregunta='$preg', Respuesta='$resp', Complejidad='$comp' WHERE Numero='$id'";
		if (!mysqli_query($link ,$sql)){
			die('Error: ' . mysqli_error($link));
		}
	
		echo 'Pregunta actualizada';
	}else{
		echo 'Falta información';
	}
?>