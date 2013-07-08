<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>User Management System</title>
	</head>
	<body>	
		<form name="loginform" action="doLogin.php" method="post">	
			<table> 
				<caption><b>Login Form</b></caption>
				<tr>
					<td><label>Username:</label></td>
					<td><input type="text" name="txtUsername" id="txtUsername"></td>
				</tr>
				<tr>
					<td><label>Password:</label></td>
					<td><input type="password" name="txtPassword" id="txtPassword"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Login"></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<label>If a new user </label><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/PHP_Assignment_III/register.php';?>" title="Register">Register</a>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
