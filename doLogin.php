<?php 
	session_start();  
	
	include 'dbConnection.php';
	 
	$username=$_POST['txtUsername'];
	$password=$_POST['txtPassword'];	
	
	$selectQuery=" select * from users where email_id='".$username."'";  
	$recordSet=mysql_query($selectQuery) or die(mysql_errno());

	if(mysql_num_rows($recordSet)==1)
	{   
		$userRecord=mysql_fetch_row($recordSet);
		$orgpass=$userRecord[3]; 
		$randomno=$userRecord[4];
		$password=$password.$randomno;  
		$password=md5($password);
 
		if($orgpass===$password)
		{   
			$_SESSION['userId']=$userRecord[0];
			$_SESSION['userName']=$userRecord[1].' '.$userRecord[2];   
			$_SESSION['userType']=$userRecord[13]; 
			header("Location:http://".$_SERVER[SERVER_NAME]."/PHP_Assignment_III/home.php");
		} 
		else if($orgpass!=$password)   
			header("Location:http://".$_SERVER[SERVER_NAME]."/PHP_Assignment_III/index.php");
	}
	else
	{
		echo "User does not exist";
	}
?>
