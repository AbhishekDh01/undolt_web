<?php  
	require_once 'connect.php';
	session_start();
	$sid=$_SESSION['navSid'];
	$stmt = $conn->query("SELECT * FROM oneshopy_undolt.student where sid=$sid");
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

	$stmt2 = $conn->query("SELECT * FROM oneshopy_undolt.sreferral where sid=$sid");
	$row2=$stmt2->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>
	<button onclick="location.href='studentDash.php';" style="margin-left: 92%;">To Dashboard</button>
	<h1 style="text-align: center;">Profile</h1>
	<form action="studentProfileBack.php" method="POST" style="text-align: center;">

		Client id: 
		<input type="text" name="sid" style="pointer-events: none;" value="<?php echo $sid;  ?>">

		<br>
		Name: 

		<input type="text" name="sName"  required="required" value="<?php echo $row['sName'];  ?>">

		<br>
		Email: 

		<input type="email" name="sEmail" style="pointer-events: none;" value="<?php echo $row['sEmail'];  ?>">
		
		<br>
		Contact:

		<input type="text" name="sContact" required="required" value="<?php echo $row['sContact'];  ?>">
		
		<br>
		Ref_code:

		<input type="text" name="rCode" style="pointer-events: none;" value="<?php echo $row2['ref_code'];  ?>">
		<br>
		
		<input type="submit" name='update' value="Update">
		<input type="submit" name="cancel" value="cancel">		
	</form>

</body>
</html>
