<?php
	if(!isset($_SESSION['email'])){
	echo '<script language="javascript">alert("No estas correctamente identificado");</script>'; 
	header("Location: layout.html");
	}
	if (isset($_GET['preg']) && isset($_GET['asig']) && isset($_GET['resp']) && ($_GET['preg']!="")&& ($_GET['asig']!="")&& ($_GET['resp']!="")){
		$link = mysqli_connect("mysql.hostinger.es", "u410012855_root", "quepazaloko23", "u410012855_quiz");
		if (!$link){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}

		$email=$_SESSION['email'];
		$asig=$_GET['asig'];
		$preg=$_GET['preg']; 
		$resp=$_GET['resp'];
		$comp=$_GET['comp'];
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql = mysqli_query($link, "SELECT MAX(Id)FROM conexiones WHERE Correo='$email'" );	
		$resultado=mysqli_fetch_row($sql);
		$Id=$resultado[0];
		$sql="INSERT INTO pregunta (Email, Asignatura, Pregunta, Respuesta, Complejidad) VALUES ('$email','$asig', '$preg', '$resp', '$comp')";
		if (!mysqli_query($link ,$sql)){
			die('Error: ' . mysqli_error($link));
		}
		$sql="INSERT INTO acciones (IdConexion, Correo, Tipo, Hora, IP)values('$Id','$email', 'InsertarPregunta',CURTIME(), '$ip')";
		if (!mysqli_query($link ,$sql)){
			die('Error: ' . mysqli_error($link));
		}
		mysqli_close($link);
		
		try{
			libxml_use_internal_errors(true);
			$Preguntas= new SimpleXMLElement('preguntas.xml', null, true);
			$pregunta=$Preguntas->addChild('assessmentItem');
			$pregunta->addAttribute('subject', $asig);
			$pregunta->addAttribute('complexity',$comp);
			$itemBody=$pregunta->addChild('itemBody');
			$itemBody->addChild('p', $preg);
			$correctResponse=$pregunta->addChild('correctResponse');
			$correctResponse->addChild('value', $resp);
			$Preguntas->asXML('preguntas.xml');
			echo "Pregunta añadida al documento XML. ";
			echo "Pregunta insertada correctamente. ";
		}catch (Exception $e){
			echo "Error cargando XML. ";
		}	
	}else{
		echo '<FONT COLOR="red">Por favor rellena el formulario </FONT>';
	}
?>