<?php
  require_once 'connect.php';
  require_once 'verificationEmail.php';
  if(isset($_POST['tLogin'])){
  		$sql = "SELECT * from oneshopy_undolt.tutor where tEmail = :e";
		$pass = md5($_POST['tPass']);
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':e',$_POST['tEmail']);
		$stmt->execute();
		$tEmail = $_POST['tEmail'];

		if($stmt->rowCount()>0){
			$getRow = $stmt->fetch(PDO::FETCH_ASSOC);
					if($getRow['tPass']==$pass)
					{

						if($getRow['banned']==1){
							myAlert("You have been blocked for not following rules.");
							header("refresh:0; url= index.html");
							exit();
						}

						$vKey = $getRow['vkey'];

						if($getRow['verified']==0){
							myAlert("Your account in not verified, Please check your email account");
							verificationEmail('no_reply@undolt.com','tid',$tEmail,$vKey,'https://abhi.oneshopy.in/verifyAccount.php');
							header("refresh:0; url= index.html");
							exit();
						}
						
						if($getRow['approved']=='Pending'){
							myAlert("Please wait, we will get back to your shortly");
							header("refresh:0; url= index.html");
							exit();
						}

						
						
						myAlert("Login Successfully");
						$tEmail = $_POST['tEmail'];
						$stmt = $conn->query("SELECT tid FROM oneshopy_undolt.tutor where tEmail='$tEmail';");
						$row=$stmt->fetch(PDO::FETCH_ASSOC);
		
						session_start();

						$_SESSION['navTid'] = $row['tid'];
						header("refresh:0; url= tutorDash.php");
						
					}
					else
					{
						myAlert("Password is incorrect");
						header("refresh:0; url= tutorLogin.php");
					}
		}
		else{
		myAlert("User does not exists");
		header("refresh:0; url= tutorLogin.php");
		}	
}
?>
<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>