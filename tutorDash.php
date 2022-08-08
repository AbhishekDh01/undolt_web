<?php  
	require_once 'connect.php';
	session_start();
	$tid=$_SESSION['navTid'];
	$stmt = $conn->query("SELECT tName,rating FROM oneshopy_undolt.tutor where tid=$tid");
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

	$stmt2 = $conn->query("SELECT count(*) as currAssign FROM oneshopy_undolt.assignment where assignTid=$tid and aStatus = 'Accepted by Tutor'; ");
	$stmt3 = $conn->query("SELECT count(*) as reviewAssign FROM oneshopy_undolt.assignment where assignTid=$tid and aStatus = 'Solved and in Review'; ");
	$stmt4 = $conn->query("SELECT count(*) as comAssign FROM oneshopy_undolt.assignment where assignTid=$tid and (aStatus = 'Completed' or aStatus = 'Reviewed' ); ");

	$row2=$stmt2->fetch(PDO::FETCH_ASSOC);
	$row3=$stmt3->fetch(PDO::FETCH_ASSOC);
	$row4=$stmt4->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tutor Dash</title>
</head>
<body>
	<h1>Tutor Dashboard</h1>
	<h2> Welcome <?php echo $row['tName']; ?> </h2>

	<button onclick="location.href='tutorCurrentAssignment.php';">Current Assignments</button>

	<button onclick="location.href='tutorAvailableAssignment.php';">Available Assignments</button>

	<button onclick="location.href='tutorCompletedAssignment.php';">History(completed Assignments)</button>

	<button onclick="location.href='tutorProfile.php';">Profile</button>

	<!-- ------------------- logout button--------------- -->
	<br>
	<br>
	<form action="" method="post" >
		<input type="submit" name="logout" value="Logout">
	</form>

	<h2>Stats</h2>

	<h3>Current Assignments: <?php echo $row2['currAssign']; ?> </h3>
	<h3>Completed Assignments: <?php echo $row4['comAssign']; ?>  </h3>
	<h3>Assignments in review: <?php echo $row3['reviewAssign']; ?> </h3>
	<h3>Rating: <?php echo $row['rating']; ?> </h3>
</body>
</html>

<?php
	if(isset($_POST['logout'])){
		session_destroy();
		header("refresh:0; url= index.html");
	}
?>