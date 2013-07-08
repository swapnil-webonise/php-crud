<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>User Management System</title>
	</head>
<?php 
	$countries=array("India","United kingdom","United State");
?>
	<body>
		<h3>Registration Form</h3>
		<form action="doRegister.php" name="registrationForm" method="post">
			<table>
				<tr>
					<td><label>First Name:</label></td>
					<td>
						<input type="text" name="txtFname" >
					</td>
				</tr>
				<tr>
					<td><label>Last Name:</label></td>
					<td>
						<input type="text" name="txtLname" >
					</td>
				</tr>
				<tr>
					<td><label>Password:</label></td>
					<td>
						<input type="password" name="txtPassword" >
					</td>
				</tr>
				<tr>
					<td><label>Gender:</label></td> 
					<td>
						<input type="radio" value="Male" name="gender" >Male&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" value="Female" name="gender">Female
					</td>
				</tr>
				<tr>
					<td><label>Email ID:</label></td>
					<td>
						<input type="text" name="txtEmailId">
					</td>
				</tr>
				<tr>
					<td><label>Address:</label></td>
					<td>
						<textarea name="txtAddrs" rows="3" cols="25"></textarea>
					</td>
				</tr>
				<tr>
					<td><label>Country:</label></td>
					<td>
						<select name="comboCountry">
							<option>Select</option>  
							<?php
								foreach ($countries as $value) {
									if($value==$_GET['comboCountry'])
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
						<input type="text" name="txtState">
					</td>
				</tr>
				<tr>
					<td><label>City:</label></td>
					<td>
						<input type="text" name="txtCity">
					</td>
				</tr>
				<tr>
					<td><label>Zip code:</label></td> 
					<td>
						<input type="text" name="txtZipCode" >
					</td>
				</tr>
				<tr>
					<td><label>Biography:</label></td>
					<td>
						<textarea name="txtBiography" rows="3" cols="25"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Register"></td>
				</tr>
			</table>					
		</form>
	</body>
</html>