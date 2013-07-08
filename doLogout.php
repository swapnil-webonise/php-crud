<?php
	session_start();  
	session_unset();
	session_destroy();  
	header('Location: http://'.$_SERVER[SERVER_NAME].'/PHP_Assignment_III/index.php' ) ;
?>   
