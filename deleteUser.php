<?php
	include 'PDOConnection.php';
	
	$cnt=$db->exec("DELETE FROM users WHERE id =".$_GET['userId']);
	
	if($cnt==1)
	{
		header("Location:http://".$_SERVER[SERVER_NAME]."/PHP_Assignment_III/home.php");
	}
?>
