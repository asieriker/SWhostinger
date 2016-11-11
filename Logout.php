<?php
session_start(); 
session_destroy();
echo "<SCRIPT type='text/javascript'> //not showing me this
     alert('Gracias por su visita');
     window.location.replace(\"layout.html\");
    </SCRIPT>";
?>