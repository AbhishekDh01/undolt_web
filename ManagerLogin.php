<?php
	require_once 'connect.php';
	session_start();
 	if(isset($_SESSION['navMid'])){
 		header("refresh:0; url= managerDash.php");
 		exit();
 	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Manager Login</title>
</head>
<body>

	<form action="ManagerLoginBack.php" method="POST" style="text-align: center;">
		<h1>Manager Login</h1>

		<input type="email" name="mEmail" placeholder="email-id" required="required">

		<input type="password" name="mPass" placeholder="password" required="required">

		<input type="submit" name="mLogin" value="Login">

		<p>forget password, <a href="managerForgetPassword.html">Click here</a></p>
		
		<p>Don't have a account register here <a href="ManagerReg.html">Click here</a></p>
	</form>
</body>
</html>
