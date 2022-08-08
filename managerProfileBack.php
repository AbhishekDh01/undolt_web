<?php 
require_once 'connect.php';
if(isset($_POST['update']) ){
	$mid = $_POST['mid'];

	$sql1 = "update oneshopy_undolt.manager set mname ='".$_POST['mName']."' where mid = $mid;";
	$sql2 = "update oneshopy_undolt.manager set mContact ='".$_POST['mContact']."' where mid = $mid;";
	$sql3 = "update oneshopy_undolt.manager set upi ='".$_POST['upi']."' where mid = $mid;";
	$sql4 = "update oneshopy_undolt.manager set bank ='".$_POST['bank']."' where mid = $mid;";
	$sql5 = "update oneshopy_undolt.manager set ifsc ='".$_POST['ifsc']."' where mid = $mid;";
	$sql6 = "update oneshopy_undolt.manager set bankName ='".$_POST['bankName']."' where mid = $mid;";

	$stmt1 = $conn->prepare($sql1);
	$stmt2 = $conn->prepare($sql2);
	$stmt3 = $conn->prepare($sql3);
	$stmt4 = $conn->prepare($sql4);
	$stmt5 = $conn->prepare($sql5);
	$stmt6 = $conn->prepare($sql6);

	try{
		$stmt1->execute();
		$stmt2->execute();
		if($_POST['upi']){
		 $stmt3->execute();
		}
		if($_POST['bank']){
		 $stmt4->execute();
		 $stmt5->execute();
		 $stmt6->execute();
		}

		
	}catch(PDOException $e){
		myAlert("Internal Error");
		header("refresh:0; url= managerProfile.php");
		exit();
	}
	myAlert("Details Successfully Updated");
	header("refresh:0; url= managerProfile.php");
    exit();
	
}
if(isset($_POST['cancel'])){
	header("refresh:0; url= managerDash.php");
    exit();
	
}
?>
<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>