<?php 
require_once 'connect.php';
require_once 'resetEmail.php';
require_once 'verificationEmail.php';
if(isset($_POST['sForget'])){

	$sEmail = $_POST['sEmail'];

	$sql = "SELECT banned,verified,vkey from oneshopy_undolt.student where sEmail = :e";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':e',$sEmail);
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
							verificationEmail('no_reply@undolt.com','sid',$sEmail,$vK,'https://abhi.oneshopy.in/verifyAccount.php');
							header("refresh:0; url= index.html");
							exit();
						}

						$vKey = md5(time());
          				$sql2 = "update oneshopy_undolt.student set vKey = '$vKey' where sEmail = '".$sEmail."';";
						$stmt2 = $conn->prepare($sql2);
          				$stmt2->execute();

						try{
							resetEmail('no_reply@undolt.com','sid',$sEmail,$vKey,'https://abhi.oneshopy.in/resetPassword.php');
						}catch(PDOException $e){
							
							myAlert("Internal Error");
							header("refresh:0; url= studentForgetPassword.html");
							exit();
						}
						myAlert('Password reset link has been sent to your email-id');
						header("refresh:0; url= index.html");
						exit();
						
		}
		else{
		myAlert("Email-id does not exists");
		header("refresh:0; url= studentForgetPassword.html");
		}
	
}

?>
<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>