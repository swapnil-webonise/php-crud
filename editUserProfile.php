<?php
	session_start();

	echo "Welcome, <b>".$_SESSION['userName']."</b>"; 

	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		include 'PDOConnection.php';

		$updateQuery=" update users set firstname='".$_POST['txtFname']."',lastname='".$_POST['txtLname']."',gender='".$_POST['gender']."',email_id='".$_POST['txtEmailId']."',address='".$_POST['txtAddrs']."',country='".$_POST['comboCountry']."',state='".$_POST['txtState']."',city='".$_POST['txtCity']."',zip_code=".$_POST['txtZipCode'].",biography='".$_POST['txtBiography']."',modified_on='now()' where id=".$_POST['userId'];	
		
		$db->query($updateQuery);
		
		header("Location:http://".$_SERVER[SERVER_NAME]."/PHP_Assignment_III/home.php");
		
	}
	else if($_SERVER['REQUEST_METHOD']=='GET')
	{
		include 'PDOConnection.php';

		$recordSet = $db->query('SELECT * FROM users where id='.$_GET['userId'], PDO::FETCH_ASSOC);
		$userRecord=$recordSet->fetch();
	
		$countries=array("India","United kingdom","United State");	
?>
<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>User Management System</title>
	</head>
	<style>  
		a:link {color:blue;}      /* unvisited link */
		a:visited {color:navy;}  /* visited link */
		a:hover {color:#FF00FF;}  /* mouse over link */
		a:active {color:#0000FF;}
		.menu
		{ 
			padding: 5px 10px; 
			text-decoration: none;
			background-color: #d2d2d2;  
			border:1px solid #666;      
			margin: 2px;
		} 
	</style>
	<body>	
	<br /><br />
	<a href="doLogout.php" name="lnkLogout" class="menu">Logout</a>				
	<br /><br />
	<h3>Edit Profile</h3>
	<form name="editProfileForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<table>
			<tr>
				<td><label>First Name:</label></td>
				<td>
					<input type="text" name="txtFname" value="<?php if(isset($userRecord['firstname']))  echo $userRecord['firstname'];?>">
				</td>
			</tr>
			<tr>
				<td><label>Last Name:</label></td>
				<td>
					<input type="text" name="txtLname"  value="<?php if(isset($userRecord['lastname']))  echo $userRecord['lastname'];?>">
				</td>
			</tr>
			<tr>
				<td><label>Gender:</label></td> 
				<td>
					<input type="radio" value="Male" name="gender"  <?php if($userRecord['gender']=='Male') echo 'checked="checked"'; ?>>Male&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" value="Female" name="gender"  <?php if($userRecord['gender']=='Female') echo 'checked="checked"'; ?>>Female
				</td>
			</tr>
			<tr>
				<td><label>Email ID:</label></td>
				<td>
					<input type="text" name="txtEmailId" value="<?php if(isset($userRecord['email_id']))  echo $userRecord['email_id'];?>">
				</td>
			</tr>
			<tr>
				<td><label>Address:</label></td>
				<td>
					<textarea name="txtAddrs" rows="3" cols="25"><?php if(isset($userRecord['address']))  echo $userRecord['address'];?></textarea>
				</td>
			</tr>
			<tr>
				<td><label>Country:</label></td>
				<td>
					<select name="comboCountry">
						<option>Select</option>  
						<?php
							foreach ($countries as $value) {
								if($value==$userRecord['country'])
									echo '<option value="'.$value.'" selected>'.$value.'</option>';		
								else
									echo '<option value="'.$value.'" >'.$value.'</option>';		
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>State:</label></td>
				<td>
					<input type="text" name="txtState" value="<?php if(isset($userRecord['state']))  echo $userRecord['state'];?>">
				</td>
			</tr>
			<tr>
				<td><label>City:</label></td>
				<td>
					<input type="text" name="txtCity" value="<?php if(isset($userRecord['city']))  echo $userRecord['city'];?>">
				</td>
			</tr>
			<tr>
				<td><label>Zip code:</label></td> 
				<td>
					<input type="text" name="txtZipCode" value="<?php if(isset($userRecord['zip_code']))  echo $userRecord['zip_code'];?>">
				</td>
			</tr>
			<tr>
				<td><label>Biography:</label></td>
				<td>
					<textarea name="txtBiography" rows="3" cols="25"><?php if(isset($userRecord['biography']))  echo $userRecord['biography'];?></textarea>
				</td>
			</tr>
			<tr>
				<td><input type="hidden" name="userId" value="<?php echo $_GET['userId'];?>"></td>
				<td><input type="submit" name="btnEditProfile" value="Update"></td>
			</tr>
		</table>					
	</form>	
<?php
	}
?>
