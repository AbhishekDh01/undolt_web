<?php  
	require_once 'connect.php';
	session_start();
	$sid=$_SESSION['navSid'];
	$stmt = $conn->query("SELECT * FROM oneshopy_undolt.student where sid=$sid");
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

	$stmt2 = $conn->query("SELECT * FROM oneshopy_undolt.sreferral where sid=$sid");
	$row2=$stmt2->fetch(PDO::FETCH_ASSOC);

	// $stmt2 = $conn->query("SELECT count(*) as currAssign FROM oneshopy_undolt.assignment where assignTid=$tid and aStatus = 'Accepted by Tutor'; ");
	// $stmt3 = $conn->query("SELECT count(*) as reviewAssign FROM oneshopy_undolt.assignment where assignTid=$tid and aStatus = 'Solved and in Review'; ");
	// $stmt4 = $conn->query("SELECT count(*) as comAssign FROM oneshopy_undolt.assignment where assignTid=$tid and (aStatus = 'Completed' or aStatus = 'Reviewed' ); ");

	// $row2=$stmt2->fetch(PDO::FETCH_ASSOC);
	// $row3=$stmt3->fetch(PDO::FETCH_ASSOC);
	// $row4=$stmt4->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Dash</title>
</head>
<body>

	<h1>Student Dashboard - Hi <?php echo $row['sName'];  ?></h1>

	<br>
	<hr>
	<button onclick="location.href='assignmentPost.html';">Assignment upload</button>
	<br>
	<br>
	<button onclick="location.href='studentAssignmentDash.php';">Completed Task</button>
	<br>
	<br>
	<button onclick="location.href='studentPendingTask.php';">Pending Task</button>
	<br>
	<br>
	<button onclick="location.href='studentProfile.php';">Profile</button>

	<!-- ------------------- logout button--------------- -->
	<br>
	<br>
	<form action="" method="post" >
		<input type="submit" name="logout" value="Logout">
	</form>
	
	<h2>Referral Code : <?php  echo $row2['ref_code']; ?> </h2>
	<h3>Total Referral (by sign up) - <?php  echo $row2['total_ref']; ?> </h3>
	<h3>Remaining Applicable Referral (by submit task ) - <?php  echo $row2['applicable_ref']; ?> </h3>
	<h3>Used_referral - <?php  echo $row2['used_ref']; ?> </h3>

</body>
</html>


<?php
	if(isset($_POST['logout'])){
		session_destroy();
		header("refresh:0; url= index.html");
	}
?>