<?php 
require_once 'connect.php';
require_once 'resetEmail.php';
require_once 'verificationEmail.php';
if(isset($_POST['mForget'])){

	$mEmail = $_POST['mEmail'];

	$sql = "SELECT banned,verified,vkey from oneshopy_undolt.manager where mEmail = :e";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':e',$mEmail);
		$stmt->execute();

		if($stmt->rowCount()>0){
			$getRow = $stmt->fetch(PDO::FETCH_ASSOC);						
						if($getRow['banned']==1){
							myAlert("You have been blocked for not following rules.");
							header("refresh:0; url= index.html");
							exit();
						}

						

						if($getRow['verified']==0){
							myAlert("Your account in not verified, Please check your email account");
							$vK = $getRow['vkey'];
							verificationEmail('no_reply@undolt.com','mid',$mEmail,$vK,'https://abhi.oneshopy.in/verifyAccount.php');
							header("refresh:0; url= index.html");
							exit();
						}

						$vKey = md5(time());
						$sql2 = "update oneshopy_undolt.manager set vkey = '$vKey' where mEmail = '".$mEmail."';";
						$stmt2 = $conn->prepare($sql2);

						try{
							$stmt2->execute();
							resetEmail('no_reply@undolt.com','mid',$mEmail,$vKey,'https://abhi.oneshopy.in/resetPassword.php');
						}catch(PDOException $e){
							myAlert("Internal Error");
							header("refresh:5; url= tutorForgetPassword.html");
							exit();
						}
						myAlert('Password reset link has been sent to your email-id');
						header("refresh:0; url= index.html");
						exit();
						
		}
		else{
		myAlert("Email-id does not exists");
		header("refresh:0; url= managerForgetPassword.html");
		}
	
}

?>
<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>