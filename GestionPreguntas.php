<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['email']) ){
echo "<SCRIPT type='text/javascript'> //not showing me this
     alert('No has iniciado sesion correctamente');
     window.location.replace(\"layout.php\");
    </SCRIPT>";
}
if( ($_SESSION['rol']=="profesor") ){
echo "<SCRIPT type='text/javascript'> //not showing me this
     alert('quieto Vadillo! Zona restringida');
     window.location.replace(\"layout.php\");
    </SCRIPT>";
}
?>

<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Gestionar Preguntas</title>
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
			<span class="right">Sesión iniciada como <b><?php echo $_SESSION['email']?> </b> </span>
      		<span class="right"><a href="Logout.php">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></span>
		<span><a href='verPreguntas.php'>Ver preguntas</a></spam>
		<span><a href='creditos.html'>Creditos</a></spam>
	</nav>
    <section class="main" id="s1">
    
	
		<div id="numPreguntas"><p>Aparecera el numero de preguntas</p></div>

	<form id="pregunta" >     
		<h3>Añadir pregunta </h3><br>                
		<p> Asignatura*: <input type="text" required id="asig" name="asig" size="50" value="" /><br><br> 		
		<p> Pregunta*: <input type="text" required id="preg" name="preg" size="50" value="" /><br><br>
		<p> Respuesta*: <input type="text" required id="resp" name="resp" size="50" value="" /><br><br>
		<p> Complejidad (1,5): <input type="number" min="1" max="5" id="comp" name="comp" size="50" value="" /><br><br>
	</form>

	<form>  
		<input type = "button" value = "Mostrar preguntas XML" onclick = "pedirDatos()">  
		<input type = "button" value = "Insertar pregunta" onclick = "verificar()">  
	</form>  
	<div id="insertado">  
	</div> 
	<div id="resultado" align="center">  <p>Apareceran las preguntas del documento XML</p> </div><br><br>
 
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/asieriker/SWhostinger'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
		<script>
		setInterval(function numeroPreguntas(){
		$.ajax({
			url: 'numPreguntas.php',
			success:function(datos){
				$('#numPreguntas').fadeIn().html(datos);},
			error:function(){
				$('#numPreguntas').fadeIn().html('<p class="error"><strong>El servidor parece que no responde</p>');
				}		
		})}, 5000);
	</script>
	
<script language="javascript">
	function verificar(){ 
			document.getElementById("insertado").value="";
			valor = document.getElementById("asig").value;
			if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ){
				alert("Introduce Asignatura");
				return false;
			}
			
			valor = document.getElementById("preg").value;
			if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ){
				alert("Introduce Pregunta");
				return false;
			}
			
			valor = document.getElementById("resp").value;
			if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ){
				alert("Introduce Respuesta");
				return false;
			}
			insertarDatos();
	}
	function pedirDatos()
	{
		xmlhttp = new XMLHttpRequest();

		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("resultado").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","verPreguntasXML.php"); 
		xmlhttp.send();
	}
/*
setInterval(function pedirNumPreguntas()
	{
		xmlhttp = new XMLHttpRequest();

		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("numPreguntas").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","numPreguntas.php?email="+ document.getElementById('email').value); 
		xmlhttp.send();
	}, 5000);
	*/
	
	function insertarDatos(){
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById('insertado').innerHTML=xmlhttp.responseText;
				alert(xmlhttp.responseText);
			}
		}
		xmlhttp.open("GET","InsertarPregunta.php?asig=" + document.getElementById("asig").value + "&preg=" + document.getElementById("preg").value + "&resp=" + document.getElementById("resp").value + "&comp=" +document.getElementById("comp").value, true);
		xmlhttp.send();
	}
</script>
