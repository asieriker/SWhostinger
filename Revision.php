<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['email'])){
	echo "<SCRIPT type='text/javascript'> //not showing me this
	     alert('No has iniciado sesion correctamente');
	     window.location.replace(\"layout.php\");
	    </SCRIPT>";
}

if($_SESSION['rol']!="profesor"){
	echo "<SCRIPT type='text/javascript'> //not showing me this
	     alert('No tienes permiso para visualizar esta página');
	     window.history.back();
	    </SCRIPT>";
}
?>

<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Revisar reguntas</title>
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
			<span class="right">Sesion iniciada como <?php echo $_SESSION['email']?></span>
      		<span class="right"><a href="Logout.php">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='verPreguntas.php'>Preguntas</a></spam>
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
	?>
	<form>
		<select id="preguntas" name="preguntas" onChange="preguntaSeleccionada()">
	<?php
		echo '<option value="" selected="selected">- Selecciona una pregunta -</option>';
			while ($row = mysqli_fetch_array( $preguntas )) {
				echo'<option value="'. $row['Numero'] .'">'.$row['Pregunta'].'</option>';
			}
		echo '</select>';
		echo '</form>';
	?>
	<br>
	<br>
	<div id="formModificarPregunta" align="center">
		<h3>Información de la pregunta seleccionada:</h3>
		<form id="formulario">
			<br>
			  Autor*:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			  <input type="text" name="autor" id="autor" size="35" readonly>
			  <br><br>
			  Pregunta*:&nbsp&nbsp
			  <input type="text" name="pregunta" id="pregunta" size="35">
			  <br><br>
			  Respuesta*:
			  <input type="text" name="respuesta" id="respuesta" size="35">
			  <br><br>
			  Complejidad:
			  <select id="modificarPregunta">
				  <option value="nada">Sin especificar</option>
				  <option value="1">1</option>
				  <option value="2">2</option>
				  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
			  </select>
			  <br>
			  </form>
			  <br>
			  <form>  
				<input type ="button" value ="Aplicar cambios" onclick ="actualizarPregunta()">  
			  </form> 
			  	</div>
			  <div id="preguntaModificada"></div>
			  <br>

	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/asieriker/SWhostinger'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>

<script language="javascript">

function preguntaSeleccionada()
	{
		xmlhttp = new XMLHttpRequest();

		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("formModificarPregunta").innerHTML = xmlhttp.responseText;
			}
		}
		
		var lista = document.getElementById("preguntas");
		// Obtener el valor de la opción seleccionada
		var valorSeleccionado = lista.options[lista.selectedIndex].value;
		xmlhttp.open("GET","obtenerPregunta.php?id="+valorSeleccionado); 
		xmlhttp.send();
	}
	
	function actualizarPregunta(){
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				//document.getElementById('preguntaModificada').innerHTML=xmlhttp.responseText;
				alert(xmlhttp.responseText);
			}
		}
		var lista = document.getElementById("preguntas");
		// Obtener el valor de la opción seleccionada
		var id = lista.options[lista.selectedIndex].value;
		var lista = document.getElementById("modificarPregunta");
		// Obtener el valor de la opción seleccionada
		var valorSeleccionado = lista.options[lista.selectedIndex].value;
		xmlhttp.open("GET","actualizarPregunta.php?email=" + document.getElementById("autor").value + "&id=" + id +"&preg=" + document.getElementById("pregunta").value + "&resp=" + document.getElementById("respuesta").value + "&comp=" +valorSeleccionado, true);
		xmlhttp.send();
	}
</script>
