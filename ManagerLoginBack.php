<?php
  require_once 'connect.php';
  require_once 'verificationEmail.php';
  if(isset($_POST['mLogin'])){
  		$sql = "SELECT * from oneshopy_undolt.manager where mEmail = :e";
		$pass = md5($_POST['mPass']);
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':e',$_POST['mEmail']);
		$stmt->execute();
		$mEmail = $_POST['mEmail'];

		if($stmt->rowCount()>0){
			$getRow = $stmt->fetch(PDO::FETCH_ASSOC);
					if($getRow['mPass']==$pass)
					{

						if($getRow['banned']==1){
							myAlert("You have been blocked for not following rules.");
							header("refresh:0; url= index.html");
							exit();
						}

						$vKey = $getRow['vkey'];

						if($getRow['verified']==0){
							myAlert("Your account in not verified, Please check your email account");
							verificationEmail('no_reply@undolt.com','mid',$mEmail,$vKey,'https://abhi.oneshopy.in/verifyAccount.php');
							header("refresh:0; url= index.html");
							exit();
						}
						
						if($getRow['approved']=='No'){
							myAlert("Please wait, we will get back to your shortly");
							header("refresh:0; url= index.html");
							exit();
						}

						
						
						myAlert("Login Successfully");
						$mEmail = $_POST['mEmail'];
						$stmt = $conn->query("SELECT mid FROM oneshopy_undolt.manager where mEmail='$mEmail';");
						$row=$stmt->fetch(PDO::FETCH_ASSOC);
		
						session_start();

						$_SESSION['navMid'] = $row['mid'];
						header("refresh:0; url= ManagerDash.php");
						
					}
					else
					{
						myAlert("Password is incorrect");
						header("refresh:0; url= ManagerLogin.php");
					}
		}
		else{
		myAlert("User does not exists");
		header("refresh:0; url= ManagerLogin.php");
		}	
}
?>
<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>