<?php
	require_once 'connect.php';
	session_start();
 	if(isset($_SESSION['navSid'])){
 		header("refresh:0; url= studentDash.php");
 		exit();
 	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Login</title>
</head>
<body>

	<form action="studentLoginBack.php" method="POST" style="text-align: center;">
		<h1>Student Login</h1>

		<input type="email" name="sEmail" placeholder="email-id" required="required">

		<input type="password" name="sPass" placeholder="password" required="required">

		<input type="submit" name="sLogin" value="Login">

		<p>forget password, <a href="studentForgetPassword.html">Click here</a></p>
		
		<p>Don't have a account register here <a href="studentReg.html">Click here</a></p>
	</form>
</body>
</html>
