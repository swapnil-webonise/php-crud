<?php
	session_start();

	echo "Welcome, <b>".$_SESSION['userName']."</b>"; 

	if(isset($_POST['btnChangePassword']))
	{
		include 'dbConnection.php';
		 
		$OldPassword=$_POST['txtOldPassword'];
		$NewPassword=$_POST['txtNewPassword'];	
		$ConfirmPassword=$_POST['txtConfirmPassword'];	
		
		if($NewPassword===$ConfirmPassword)
		{
			$selectQuery=" select * from users where id=".$_SESSION['userId'];  
			$recordSet=mysql_query($selectQuery) or die(mysql_errno());

			$userRecord=mysql_fetch_row($recordSet);
			$orgpass=$userRecord[3]; 
			$randomno=$userRecord[4];
			$OldPassword=$OldPassword.$randomno;  
			$OldPassword=md5($OldPassword);
	  
			if($orgpass===$OldPassword)
			{   
				$updateQuery="update users set password='".md5($NewPassword.$randomno)."' where id=".$_SESSION['userId'];
				mysql_query($updateQuery) or die(mysql_errno());
				echo "password updated";
			} 
			else if($orgpass!=$password)   
				echo "Wrong Password";
		}
		else
		{
			echo "New password and confirm password is not matching";
		}
		mysql_close($con);
	}
	else if(isset($_POST['btnEditProfile']))
	{
		include 'dbConnection.php';		
		
		$updateQuery=" update users set firstname='".$_POST['txtFname']."',lastname='".$_POST['txtLname']."',gender='".$_POST['gender']."',email_id='".$_POST['txtEmailId']."',address='".$_POST['txtAddrs']."',country='".$_POST['comboCountry']."',state='".$_POST['txtState']."',city='".$_POST['txtCity']."',zip_code=".$_POST['txtZipCode'].",biography='".$_POST['txtBiography']."',modified_on='now()' where id=".$_SESSION['userId'];  
		mysql_query($updateQuery) or die(mysql_errno());
		
		echo "Profile updated";
		mysql_close($con);
	}
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
		<?php
			if($_SESSION['userType']==1)
			{
		?>
				<br /><br />
				<a href="doLogout.php" name="lnkLogout" class="menu">Logout</a>				
				<br /><br />
				<h3>User List</h3>
				<table border="1">
					<tr>
						<th>No</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Gender</th>
						<th>Email Id</th>
						<th>Address</th>
						<th>Country</th>
						<th>State</th>
						<th>City</th>
						<th>Zip Code</th>
						<th>Biography</th>
						<th></th>
						<th></th>
					</tr>
		<?php
				include 'PDOConnection.php';
				$res = $db->query('SELECT * FROM users', PDO::FETCH_ASSOC);
				$i=1;	  
				foreach ($res as $row) {
					echo "<tr><td>".$i++."</td><td>".$row['firstname']."</td><td>".$row['lastname']."</td><td>".$row['gender']."</td><td>".$row['email_id']."</td><td>".$row['address']."</td><td>".$row['country']."</td><td>".$row['state']."</td><td>".$row['city']."</td><td>".$row['zip_code']."</td><td>".$row['biography']."</td><td><a href='editUserProfile.php?userId=".$row['id']."'>Edit</a></td><td><a href='deleteUser.php?userId=".$row['id']."'>Delete</a></td></tr>";
				}
		?>
				</table>
		<?php
			}
			else if($_SESSION['userType']==2)
			{
		?>
				<br /><br />
				<a href="home.php?page=changePassword" name="lnkChangePassword" class="menu">Change Password</a>
				<a href="home.php?page=editProfile" name="lnkChangePassword" class="menu">Edit Profile</a>
				<a href="doLogout.php" name="lnkLogout" class="menu">Logout</a>
				<br /><br />				
		<?php
			}  
			if($_GET['page']==='changePassword')
			{
		?>
				<form name="changePasswordForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<table>
						<tr>  
							<td><label for="txtOldPassword" >Old Password:</label></td>
							<td><input type="password" name="txtOldPassword" id="txtOldPassword" tabindex="1" /></td>  
						</tr>
						<tr>
							<td><label for="txtNewPassword" >New Password:</label></td>
							<td><input type="password" name="txtNewPassword" id="txtNewPassword" tabindex="2" /></td>
						</tr>   
						<tr>
							<td><label for="txtConfirmPassword" >Confirm New Password:</label></td>
							<td><input type="password" name="txtConfirmPassword" id="txtConfirmPassword" tabindex="3" /></td>
						</tr>   							
						<tr>
							<td></td>
							<td><input type="submit" name="btnChangePassword" tabindex="4"  value="Change Password"  /></td>            
						</tr> 
					</table>  
				</form>	 	
		<?php
			}
			else if($_GET['page']==='editProfile')
			{
				include 'dbConnection.php';
				
				$selectQuery=" select * from users where id=".$_SESSION['userId'];  
				$recordSet=mysql_query($selectQuery) or die(mysql_errno());

				$userRecord=mysql_fetch_row($recordSet);	
				
				$countries=array("India","United kingdom","United State");						
		?>			
				<h3>Edit Profile</h3>
				<form name="editProfileForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<table>
						<tr>
							<td><label>First Name:</label></td>
							<td>
								<input type="text" name="txtFname" value="<?php if(isset($userRecord[1]))  echo $userRecord[1];?>">
							</td>
						</tr>
						<tr>
							<td><label>Last Name:</label></td>
							<td>
								<input type="text" name="txtLname"  value="<?php if(isset($userRecord[2]))  echo $userRecord[2];?>">
							</td>
						</tr>
						<tr>
							<td><label>Gender:</label></td> 
							<td>
								<input type="radio" value="Male" name="gender"  <?php if($userRecord[5]=='Male') echo 'checked="checked"'; ?>>Male&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" value="Female" name="gender"  <?php if($userRecord[5]=='Female') echo 'checked="checked"'; ?>>Female
							</td>
						</tr>
						<tr>
							<td><label>Email ID:</label></td>
							<td>
								<input type="text" name="txtEmailId" value="<?php if(isset($userRecord[6]))  echo $userRecord[6];?>">
							</td>
						</tr>
						<tr>
							<td><label>Address:</label></td>
							<td>
								<textarea name="txtAddrs" rows="3" cols="25"><?php if(isset($userRecord[7]))  echo $userRecord[7];?></textarea>
							</td>
						</tr>
						<tr>
							<td><label>Country:</label></td>
							<td>
								<select name="comboCountry">
									<option>Select</option>  
									<?php
										foreach ($countries as $value) {
											if($value==$userRecord[8])
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
								<input type="text" name="txtState" value="<?php if(isset($userRecord[9]))  echo $userRecord[9];?>">
							</td>
						</tr>
						<tr>
							<td><label>City:</label></td>
							<td>
								<input type="text" name="txtCity" value="<?php if(isset($userRecord[10]))  echo $userRecord[10];?>">
							</td>
						</tr>
						<tr>
							<td><label>Zip code:</label></td> 
							<td>
								<input type="text" name="txtZipCode" value="<?php if(isset($userRecord[11]))  echo $userRecord[11];?>">
							</td>
						</tr>
						<tr>
							<td><label>Biography:</label></td>
							<td>
								<textarea name="txtBiography" rows="3" cols="25"><?php if(isset($userRecord[12]))  echo $userRecord[12];?></textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="btnEditProfile" value="Update"></td>
						</tr>
					</table>					
				</form>			
		<?php
				mysql_close($con);
			}
		?>
	</body>
</html>		
