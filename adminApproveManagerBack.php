<?php 
	require_once 'connect.php';
	$mid = $_POST['mid'];

	$to = $_POST['mEmail'];
	$from = "no_reply@undolt.in";
	$name = $_POST['mName'];

	if(isset($_POST['mApprove'])){
		$sql1 = "update oneshopy_undolt.manager set approved ='Yes' where mid = $mid;";
		$stmt1 = $conn->prepare($sql1);

		try{
			$stmt1->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= adminApproveManager.php");
		}

		// mail

		ini_set( 'display_errors', 1 );
		error_reporting( E_ALL );

         $subject = "Congratulations";
         
         $message = "
					<html>
					<head>
					<title>Manager Approval</title>
					</head>
					<body>
					<h2>Congratulations $name you have been selected as a Manager in Undolt</h2>

					<p>dash dash...</p>
					<h3>Now you can login to your account</h3>
					<a href='https://abhi.oneshopy.in/ManagerLogin.php' style=''>Click me</a>

					<p>Policy:</p>
					</body>
					</html>
					";

		$headers = "From:" . $from. "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'Cc: abhiclass01@gmail.com' . "\r\n";

		if(mail($to,$subject,$message, $headers)) {
		    myAlert("Approval Email sent");
		} else {
		    myAlert("Error in sending email");
		}

		header("refresh:0; url= adminApproveManager.php");

	}

	if(isset($_POST['mDisapprove'])){
		$stmt2 = $conn->prepare("DELETE FROM oneshopy_undolt.manager where mid=:t;");
		$stmt2->bindParam(':t',$mid);
		$stmt2->execute();

		if(!$stmt2->rowCount()){
			myAlert("Some Internal Error Occured");
			header("refresh:0; url= adminApproveManager.php");
		}else{
			myAlert("Tutor Disapproved");
			header("refresh:0; url= adminApproveManager.php");
		}

		// mail

		ini_set( 'display_errors', 1 );
		error_reporting( E_ALL );

         $subject = "Congratulations";
         
         $message = "
					<html>
					<head>
					<title>Manager Disapproval</title>
					</head>
					<body>
					<h2> $name you have been not selected as a Manager</h2>

					<p>dash dash...</p>

					<p>Policy:</p>
					</body>
					</html>
					";

		$headers = "From:" . $from. "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'Cc: abhiclass01@gmail.com' . "\r\n";

		if(mail($to,$subject,$message, $headers)) {
		    myAlert("Disapproval Email sent");
		} else {
		    myAlert("Error in sending email");
		}

		header("refresh:0; url= adminApproveManager.php");
		
	}

	


?>

<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>