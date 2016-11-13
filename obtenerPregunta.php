<?php
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
    $sql = mysqli_query($link, "SELECT Email, Pregunta, Respuesta, Complejidad FROM pregunta WHERE numero='$id'");
    if (!$sql) {
        echo 'No se pudo ejecutar la consulta: ' . mysql_error();
        exit;
    }
	$Pregunta=mysqli_fetch_row($sql);
	?>
	<h3>Información de la pregunta seleccionada:</h3>
	<form>
	    <br>Autor:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	    <input type="text" name="autor" id="autor" value="<?php echo $Pregunta[0]?>" readonly  size="35">
			  <br><br>
			  Pregunta:&nbsp&nbsp
			  <input type="text" name="pregunta" id="pregunta" value="<?php echo $Pregunta[1]?>"  size="35">
			  <br><br>
			  Respuesta:
			  <input type="text" name="respuesta" id="respuesta" value="<?php echo $Pregunta[2]?>" size="35">
			  <br><br>
			  Complejidad:
			  <select id="modificarPregunta">
			      <?php
			      switch ($Pregunta[3]) {
                        case 1:
                            ?>
                              <option value="nada">Sin especificar</option>
            				  <option value="1" selected>1</option>
            				  <option value="2">2</option>
            				  <option value="3">3</option>
            				  <option value="4">4</option>
            				  <option value="5">5</option>
            				<?php
            				break;
                        case 2:
                            ?>
                              <option value="nada">Sin especificar</option>
            				  <option value="1">1</option>
            				  <option value="2" selected>2</option>
            				  <option value="3">3</option>
            				  <option value="4">4</option>
            				  <option value="5">5</option>
            				<?php
            				break;
            			case 3:
            			    ?>
                              <option value="nada">Sin especificar</option>
            				  <option value="1">1</option>
            				  <option value="2">2</option>
            				  <option value="3" selected>3</option>
            				  <option value="4">4</option>
            				  <option value="5">5</option>
            				<?php
            				break;
            			case 4:
            			    ?>
                              <option value="nada">Sin especificar</option>
            				  <option value="1">1</option>
            				  <option value="2">2</option>
            				  <option value="3">3</option>
            				  <option value="4" selected>4</option>
            				  <option value="5">5</option>
            				<?php
            				break;
            			case 5:
            			    ?>
                              <option value="nada">Sin especificar</option>
            				  <option value="1">1</option>
            				  <option value="2">2</option>
            				  <option value="3">3</option>
            				  <option value="4">4</option>
            				  <option value="5" selected>5</option>
            				<?php
            				break;
            		    default:
                            ?>
                              <option value="nada" selected>Sin especificar</option>
            				  <option value="1">1</option>
            				  <option value="2">2</option>
            				  <option value="3">3</option>
            				  <option value="4">4</option>
            				  <option value="5">5</option>
            				<?php
                            break;
                    }
                    ?>
			  </select>
			  	</form> 
			  <br><br>
			  <form>  
				<input type ="button" value ="Aplicar cambios" onclick ="actualizarPregunta()">  
			  </form> 
	
