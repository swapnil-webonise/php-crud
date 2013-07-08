<?php
    try 
	{
		  $db = new PDO('mysql:host=localhost;dbname=user_management_system;', 'root', 'root');
	} 
	catch (PDOException $e) 
	{
		  echo $e->getMessage();
	}
?>
