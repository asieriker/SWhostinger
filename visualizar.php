<?php

$link = mysqli_connect("mysql.hostinger.es", "u410012855_root", "quepazaloko23", "u410012855_quiz");

$usuarios = mysqli_query($link, "select NombreApellidos, Correo from usuario" );
echo '<table border=1> <tr> <th> Nombre y Apellidos </th> <th> Correo </th>
</tr>';

while ($row = mysqli_fetch_array( $usuarios )) {
echo '<tr><td>' . $row['NombreApellidos'] . '</td> <td>' . $row['Correo'] . 
'</td></tr>';
}

echo '</table>';
$usuarios->close(); //poner notacion no OO
mysqli_close($link);

?>