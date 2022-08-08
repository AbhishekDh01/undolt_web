<?php  
	require_once 'connect.php';
	session_start();
	$tid=$_SESSION['navTid'];
	$stmt = $conn->query("SELECT * FROM oneshopy_undolt.tutor where tid=$tid");
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>
	<button onclick="location.href='tutorDash.php';" style="margin-left: 92%;">To Dashboard</button>
	<h1 style="text-align: center;">Profile</h1>
	<form action="tutorProfileBack.php" method="POST" style="text-align: center;">

		Tutor id: 
		<input type="text" name="tid" style="pointer-events: none;" value="<?php echo $tid;  ?>">

		<br>
		Name: 

		<input type="text" name="tName"  required="required" value="<?php echo $row['tName'];  ?>">

		<br>
		Email: 

		<input type="email" name="tEmail" style="pointer-events: none;" value="<?php echo $row['tEmail'];  ?>">
		
		<br>
		Contact:

		<input type="text" name="tContact" required="required" value="<?php echo $row['tContact'];  ?>">

		<br>
		Subject:

		<input type="text" name="tsubject" style="pointer-events: none;"  value="<?php echo $row['tsubject'];  ?>">

		<br>
		Rating: 

		<input type="text" name="rating" style="pointer-events: none;" value="<?php echo $row['rating'];  ?>">

		<br>
		Upi-id: 

		<input type="text" name="upi"  placeholder="Preferable" value="<?php echo $row['upi'];  ?>">

		<br>
		Bank A/C no: 

		<input type="email" name="bank" placeholder="If Upi is not available" value="<?php echo $row['bank'];  ?>">
		
		<br>
		Ifsc code:

		<input type="text" name="ifsc"  value="<?php echo $row['ifsc'];  ?>">

		<br>	
		Name as per bank account:

		<input type="text" name="bankName" value="<?php echo $row['bankName'];  ?>">
		
		<br>
		
		<input type="submit" name='update' value="Update">
		<input type="submit" name="cancel" value="cancel">		
	</form>

</body>
</html>
