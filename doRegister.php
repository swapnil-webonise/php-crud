<?php
	if(isset($_POST['submit']))
	{
		include 'dbConnection.php';
		
		$AccPassword=$_POST['txtPassword'];
		$randomno= substr(number_format(time() * rand(),0,'',''),0,8); 
		$AccPassword .= $randomno;  
		$AccPassword=md5($AccPassword);
		
		$insertQuery="INSERT INTO users(id,firstname,lastname,password,random_no,gender,email_id,address,country,state,city,zip_code,biography,user_type_id,created_on,modified_on) VALUES
(null,'".$_POST['txtFname']."','".$_POST['txtLname']."','".$AccPassword."','".$randomno."','".$_POST['gender']."','".$_POST['txtEmailId']."','".$_POST['txtAddrs']."','".$_POST['comboCountry']."','".$_POST['txtState']."','".$_POST['txtCity']."',".$_POST['txtZipCode'].",'".$_POST['txtBiography']."',2,now(),null)";

		if(mysql_query($insertQuery))
		{
			echo '<b>Registered successfully...</b><br />';
			echo 'Click here for login : <a href="http://'.$_SERVER['SERVER_NAME'].'/PHP_Assignment_III/index.php">Login</a>';
		}
		else
		{
			echo '<b>Not Registered...</b><br />';
		}
	}
?>
