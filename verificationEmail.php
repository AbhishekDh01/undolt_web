<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

function verificationEmail($from,$id,$to,$vkey,$page){

	$subject = "Account Verification";

	$message = "
	<html>
	<head>
	<title>Account Verification</title>
	</head>
	<body>
	<h1>Hello $to</h1>
	<p>blah blah....</p>
	<h3>Please click on below link to verify your account</h3>
	<a href='$page?id=$id&vKey=$vkey' style=''>Click me</a>
	<p>Policy: ...</p>
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