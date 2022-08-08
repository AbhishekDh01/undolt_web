<?php 
require_once 'connect.php';
if(isset($_POST['update']) ){
	$sid = $_POST['sid'];

	$sql1 = "update oneshopy_undolt.student set sname ='".$_POST['sName']."' where sid = $sid;";
	$sql2 = "update oneshopy_undolt.student set sContact ='".$_POST['sContact']."' where sid = $sid;";

	$stmt1 = $conn->prepare($sql1);
	$stmt2 = $conn->prepare($sql2);

	try{
		$stmt1->execute();
		
		$stmt2->execute();
		
	}catch(PDOException $e){
		myAlert("Internal Error");
		header("refresh:0; url= studentProfile.php");
		exit();
	}
	myAlert("Details Successfully Updated");
	header("refresh:0; url= studentProfile.php");
    exit();
	
}
if(isset($_POST['cancel'])){
	header("refresh:0; url= studentDash.php");
    exit();
	
}
?>
<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>