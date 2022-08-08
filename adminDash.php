<?php  
	require_once 'connect.php';
	session_start();
	$aid=$_SESSION['navAid'];
	$stmt = $conn->query("SELECT * FROM oneshopy_undolt.admin where aid=$aid");
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
</head>
<body>

	<h1>Admin Dashboard - Hi <?php echo $row['aName'];  ?></h1>

	<br>
	<br>

	<button onclick="location.href='adminApproveManager.php';">New Managers</button>

	<br>
	<br>

	<button onclick="location.href='adminSearchOthers.php';">Search Student/Tutor/Manager</button>

	<br>
	<br>

	<button onclick="location.href='adminBlockedUsers.php';">Blocked Users</button>

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


