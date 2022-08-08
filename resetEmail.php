<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

function resetEmail($from,$id,$to,$vkey,$page){

	$subject = "Reset Password";

	$message = "
	<html>
	<head>
	<title>Reset Password</title>
	</head>
	<body>
	<h3>Please click on below link to reset your password.</h3>
	<a href='$page?id=$id&vKey=$vkey' style=''>Click me</a>
	<h4>blah blah</h4>
	</body>
	</html>
	";

	$headers = "From:" .$from. "\r\n";
	$headers .= "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'Cc: abhiclass01@gmail.com' . "\r\n";

	if(mail($to,$subject,$message, $headers)) {
	  //  echo "The email message was sent.";
	} else {
	    echo "The email message was not sent.";
	}


}


?>