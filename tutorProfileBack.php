<?php 
require_once 'connect.php';
if(isset($_POST['update']) ){
	$tid = $_POST['tid'];

	$sql1 = "update oneshopy_undolt.tutor set tname ='".$_POST['tName']."' where tid = $tid;";
	$sql2 = "update oneshopy_undolt.tutor set tContact ='".$_POST['tContact']."' where tid = $tid;";
	$sql3 = "update oneshopy_undolt.tutor set upi ='".$_POST['upi']."' where tid = $tid;";
	$sql4 = "update oneshopy_undolt.tutor set bank ='".$_POST['bank']."' where tid = $tid;";
	$sql5 = "update oneshopy_undolt.tutor set ifsc ='".$_POST['ifsc']."' where tid = $tid;";
	$sql6 = "update oneshopy_undolt.tutor set bankName ='".$_POST['bankName']."' where tid = $tid;";

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
		header("refresh:0; url= tutorProfile.php");
		exit();
	}
	myAlert("Details Successfully Updated");
	header("refresh:0; url= tutorProfile.php");
    exit();
	
}
if(isset($_POST['cancel'])){
	header("refresh:0; url= tutorDash.php");
    exit();
	
}
?>
<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>