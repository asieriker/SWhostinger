<?php

//Crear conexión
$mysqli = mysqli_connect("mysql.hostinger.es", "u410012855_root", "quepazaloko23", "u410012855_quiz");
if (!$mysqli)
{
echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
}

$sql="INSERT INTO Usuario (NombreApellidos, Correo, Contrasena, NTelefono, Especialidad, Intereses, Imagen) VALUES ('$_POST[nombreyapellidos]','$_POST[direcciondecorreo]','$_POST[password]',$_POST[numerodetelefono],'$_POST[especialidad]','$_POST[intereses]')";



if (!mysqli_query($mysqli ,$sql))
{
die('Error: ' . mysqli_error($mysqli));
}
echo "1 record added";

echo "<p> <a href='visualizar.php'> Ver registros </a>";

//Cerrar conexión
mysqli_close($mysqli);

?>