<?php 
require_once 'connect.php';
require_once 'verificationEmail.php';
if(isset($_POST['mReg'])){


	$sql = "INSERT INTO oneshopy_undolt.manager(mName,mEmail,mContact,mPass,approved,vkey) VALUES(:n,:e,:c,:p,:a,:v)";
	$pass = md5($_POST['mPass']);
	$stmt = $conn->prepare($sql);
	$vkey = md5(time());

	try{
		
	$stmt->execute(
		array(
			':n' => $_POST['mName'], 
			':e' => $_POST['mEmail'],
			':c' => $_POST['mContact'],
			':p' => $pass,
			':a' => 'No',
			':v' => $vkey,
		)
	);

	
	$mEmail = $_POST['mEmail'];
	verificationEmail('no_reply@undolt.com','mid',$mEmail,$vkey,'https://abhi.oneshopy.in/verifyAccount.php');

	myAlert("Verification Email send, we will get back to you shortly.");
	$stmt = $conn->query("SELECT mid FROM oneshopy_undolt.manager where mEmail='$mEmail';");
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	
	session_start();

	$_SESSION['Navmid'] = $row['mid'];

	header("refresh:1; url= ManagerLogin.php");
    exit();
	}catch(PDOException $e){
	myAlert("Already registered.");
	header("refresh:1; url= ManagerLogin.php");
	exit();
	}
	
}

?>
<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>