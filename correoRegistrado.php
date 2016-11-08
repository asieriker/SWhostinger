<?php
	//incluimos la clase nusoap.php
	require_once('nusoap-0.9.5/lib/nusoap.php');
	require_once('nusoap-0.9.5/lib/class.wsdlcache.php');
	//creamos el objeto de tipo soapclient.
	//donde se encuentra el servicio SOAP que vamos a utilizar.
	$soapclient = new nusoap_client( 'http://asiksw.hol.es/LabServiciosWeb/comprobarmatricula.php?wsdl',true);
	//Llamamos la funci�n que hab�amos implementado en el Web Service
	//e imprimimos lo que nos devuelve
	echo $soapclient->call('comprobarMatricula',array('x'=>$_GET['email'])); 
	//echo '<h2>Request</h2><pre>' . htmlspecialchars($soapclient->request, ENT_QUOTES) . '</pre>';
	//echo '<h2>Response</h2><pre>' . htmlspecialchars($soapclient->response, ENT_QUOTES) . '</pre>';
	//echo '<h2>Debug</h2>';
	//echo '<pre>' . htmlspecialchars($soapclient->debug_str, ENT_QUOTES) . '</pre>';
				
?>