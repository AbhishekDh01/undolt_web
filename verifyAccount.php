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
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
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
	<title>Verify Account</title>
</head>
<body>

<?php  
  
	if($who=='student'){
      
		$sql1 = "update oneshopy_undolt.student set verified = 1 where sid = $id;";
		$sql2 = "update oneshopy_undolt.student set vKey = 'XXX' where sid = $id;";

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
			myAlert("Account Successfully Verified");
				header("refresh:0; url= index.html");
			    exit();
	}
	if($who=='tutor'){
		$sql1 = "update oneshopy_undolt.tutor set verified = 1 where tid = $id;";
		$sql2 = "update oneshopy_undolt.tutor set vKey = 'XXX' where tid = $id;";

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
			myAlert("Account Successfully Verified");
				header("refresh:0; url= index.html");
			    exit();
	}
	if($who=='manager'){
		$sql1 = "update oneshopy_undolt.manager set verified = 1 where mid = $id;";
		$sql2 = "update oneshopy_undolt.manager set vKey = 'XXX' where mid = $id;";

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
			myAlert("Account Successfully Verified");
				header("refresh:0; url= index.html");
			    exit();
	}
?>	

</body>
</html>


<?php
	function myAlert($msg){
		echo "<script>alert('$msg');</script>";
	}

?>


