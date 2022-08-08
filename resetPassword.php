<?php  
	require_once 'connect.php';

	if(isset($_GET['id'])){
		$who = $_GET['id'];

		if (!isset($_GET['vKey'])) {
			myAlert("link expired please try again.");
			header("refresh:0; url= index.html");
			exit();
		}
		if ($_GET['id']=='sid') {
			$stmt = $conn->query("SELECT sid FROM oneshopy_undolt.student where vKey='".$_GET['vKey']."'");
			try{
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				myAlert('Wrong reset link, please try again');
				header("refresh:0; url= index.html");
				exit();
			}
			$who = 'student';
			$id = $row['sid']??-999;
			
		}
		else if ($_GET['id']=='tid') {
			$stmt = $conn->query("SELECT tid FROM oneshopy_undolt.tutor where vKey='".$_GET['vKey']."'");
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$who = 'tutor';
			$id = $row['tid']??-999;
			
		}
		else if ($_GET['id']=='mid') {
			$stmt = $conn->query("SELECT mid FROM oneshopy_undolt.manager where vKey='".$_GET['vKey']."'");
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$who = 'manager';
			$id = $row['mid']??-999;
			
		}else {
			myAlert("link expired please try again.");
			header("refresh:0; url= index.html");
			exit();
		}
		if($id==-999){
			myAlert("link expired please try again.");
			header("refresh:0; url= index.html");
			exit();
		}
	}else{
		header("refresh:0; url= index.html");
		exit();
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
</head>
<body>

	<form action="" method="POST" style="text-align: center;" >
		<h1>Reset Password</h1>

		<input type="hidden" name="who" value="<?php echo $who; ?>" >
		<input type="hidden" name="id" value="<?php echo $id;  ?>">

		<input type="password" id="pass" name="pass" placeholder="password" required="required" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" title="must content atleast 1 upper & 1 lower character and 1 number & 1 special character, min length : 8">

		<br>
		<br>
		<input type='text' id="matchText" name="confirm" placeholder="Confirm Password.." required="required" >

		<input type="submit" name="reset" value="Submit">
	</form>

</body>
</html>

<script>
	var password = document.getElementById("pass"), confirm_password = document.getElementById("matchText");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>

<?php
	function myAlert($msg){
		echo "<script>alert('$msg');</script>";
	}

	if(isset($_POST['reset'])){

	}

?>

<?php  
	if(isset($_POST['reset'])){
		if ($_POST['who']=='student') {
			$sid = $_POST['id'];
			$pass = md5($_POST['pass']);
			$sql1 = "update oneshopy_undolt.student set sPass = '$pass' where sid = $sid;";
			$sql2 = "update oneshopy_undolt.student set vKey = 'XXX' where sid = $sid;";
			$stmt1 = $conn->prepare($sql1);
			$stmt2 = $conn->prepare($sql2);

			try{
				$stmt1->execute();
				$stmt2->execute();

			}catch(PDOException $e){
				myAlert("Internal Error");
				header("refresh:0; url= index.html");
				exit();
			}
			myAlert("Password Successfully Updated");
				header("refresh:0; url= index.html");
			    exit();
			}
		if ($_POST['who']=='tutor') {
			$tid = $_POST['id'];
			$pass = md5($_POST['pass']);
			$sql1 = "update oneshopy_undolt.tutor set tPass = '$pass' where tid = $tid;";
			$sql2 = "update oneshopy_undolt.tutor set vKey = 'XXX' where tid = $tid;";
			$stmt1 = $conn->prepare($sql1);
			$stmt2 = $conn->prepare($sql2);

			try{
				$stmt1->execute();
				$stmt2->execute();

			}catch(PDOException $e){
				myAlert("Internal Error");
				header("refresh:0; url= index.html");
				exit();
			}
			myAlert("Password Successfully Updated");
				header("refresh:0; url= index.html");
			    exit();
			}
		if ($_POST['who']=='manager') {
			$mid = $_POST['id'];
			$pass = md5($_POST['pass']);
			$sql1 = "update oneshopy_undolt.manager set mPass = '$pass' where mid = $mid;";
			$sql2 = "update oneshopy_undolt.manager set vKey = 'XXX' where mid = $mid;";
			$stmt1 = $conn->prepare($sql1);
			$stmt2 = $conn->prepare($sql2);

			try{
				$stmt1->execute();
				$stmt2->execute();

			}catch(PDOException $e){
				myAlert("Internal Error");
				header("refresh:0; url= index.html");
				exit();
			}
			myAlert("Password Successfully Updated");
				header("refresh:0; url= index.html");
			    exit();
			}
		}
?>

