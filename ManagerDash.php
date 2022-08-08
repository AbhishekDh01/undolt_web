<?php  
	require_once 'connect.php';
	session_start();
	$mid=$_SESSION['navMid'];
	$stmt = $conn->query("SELECT * FROM oneshopy_undolt.manager where mid=$mid");
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager Dashboard</title>
</head>
<body>

	<h1>Manager Dashboard - Hi <?php echo $row['mName'];  ?></h1>

	<br>
	<hr>

	<button onclick="location.href='ManagerApproveAssignment.php';">Student Side Assignments</button>

	<br>
	<br>

	<button onclick="location.href='managerReviewSolution.php';">Tutor's Solution</button>

	<br>
	<br>

	<button onclick="location.href='managerApproveTutor.php';">New tutors</button>

	<br>
	<br>

	<button onclick="location.href='managerSearchOthers.php';">Search Student/Tutor/Assignment</button>

	<br>
	<br>

	<button onclick="location.href='managerProfile.php';">Profile</button>

	<!-- ------------------- logout button--------------- -->
	<br>
	<br>
	<form action="" method="post" >
		<input type="submit" name="logout" value="Logout">
	</form>


</body>
</html>

<?php
	if(isset($_POST['logout'])){
		session_destroy();
		header("refresh:0; url= index.html");
	}
?>