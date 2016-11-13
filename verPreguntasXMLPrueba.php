<?php
	$xml = simplexml_load_file("preguntas.xml");

	echo '<table border=1> 
	<tr> 
		<th> Enunciado </th> 
		<th> Complejdiad </th> 
		<th> Tematica </th> 
	</tr>';
	foreach ($xml->assessmentItem as $assessmentItem){
		$att = $assessmentItem->attributes();
		$item= $assessmentItem->itemBody;
		$pregunta= $item->p;
		echo '<tr><td>'.$pregunta.'</td><td>'. $att['complexity'].'</td><td>'. $att['subject'].'</td></tr>';
	}
	echo '</table>';
?>