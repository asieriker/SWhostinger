<?php
	//incluimos la clase nusoap.php
	require_once("nusoap-0.9.5/lib/nusoap.php");
	require_once("nusoap-0.9.5/lib/class.wsdlcache.php");
	//creamos el objeto de tipo soapclient.
	//donde se encuentra el servicio SOAP que vamos a utilizar.
	$soapclient = new nusoap_client( "http://asiksw.hol.es/LabServiciosWeb/crearWSDL.php?wsdl",true);

	
	//Llamamos la función que habíamos implementado en el Web Service
	//e imprimimos lo que nos devuelve

	echo $soapclient->call("comprobarContrasena", array("x"=>$_GET['contrasena'],"y"=>$_GET['ticket'])); 
?>