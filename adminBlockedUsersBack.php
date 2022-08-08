<?php  
	require_once 'connect.php';

	if (isset($_POST['unblockStudent'])) {
		$sid = $_POST['sid'];
		$sql15 = "update oneshopy_undolt.student set banned = 0 where sid = $sid;";
		$stmt15 = $conn->prepare($sql15);

		try{
			$stmt15->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= adminBlockedUsers.php");
			exit();
		}

		myAlert("Student Unblocked Successfully");
		header("refresh:0; url= adminBlockedUsers.php");
    	exit();

	}
	if (isset($_POST['unblockTutor'])) {
		$tid = $_POST['tid'];
		$sql16 = "update oneshopy_undolt.tutor set banned = 0 where tid = $tid;";
		$stmt16 = $conn->prepare($sql16);

		try{
			$stmt16->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= adminBlockedUsers.php");
			exit();
		}

		myAlert("Tutor Unblocked Successfully");
		header("refresh:0; url= adminBlockedUsers.php");
    	exit();

	}
	if (isset($_POST['unblockManager'])) {
		$mid = $_POST['mid'];
		$sql17 = "update oneshopy_undolt.manager set banned = 0 where mid = $mid;";
		$stmt17 = $conn->prepare($sql17);

		try{
			$stmt17->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:2; url= adminBlockedUsers.php");
			exit();
		}

		myAlert("Manager Unblocked Successfully");
		header("refresh:0; url= adminBlockedUsers.php");
    	exit();

	}
?>

<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>