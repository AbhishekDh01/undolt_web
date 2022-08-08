<?php
	require_once 'connect.php';
	session_start();
 	if(isset($_SESSION['navTid'])){
 		header("refresh:0; url= tutorDash.php");
 		exit();
 	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tutor Login</title>
</head>
<body>

	<form action="tutorLoginBack.php" method="POST" style="text-align: center;">
		<h1>Tutor Login</h1>

		<input type="email" name="tEmail" placeholder="email-id" required="required">

		<input type="password" name="tPass" placeholder="password" required="required">

		<input type="submit" name="tLogin" value="Login">

		<p>forget password, <a href="tutorForgetPassword.html">Click here</a></p>
		
		<p>Don't have a account register here <a href="tutorReg.html">Click here</a></p>

	</form>
</body>
</html>
