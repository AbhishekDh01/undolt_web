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
	<title>Profile</title>
</head>
<body>
	<button onclick="location.href='ManagerDash.php';" style="margin-left: 92%;">To Dashboard</button>
	<h1 style="text-align: center;">Profile</h1>
	<form action="managerProfileBack.php" method="POST" style="text-align: center;">

		Tutor id: 
		<input type="text" name="mid" style="pointer-events: none;" value="<?php echo $mid;  ?>">

		<br>
		Name: 

		<input type="text" name="mName"  required="required" value="<?php echo $row['mName'];  ?>">

		<br>
		Email: 

		<input type="email" name="mEmail" style="pointer-events: none;" value="<?php echo $row['mEmail'];  ?>">
		
		<br>
		Contact:

		<input type="text" name="mContact" required="required" value="<?php echo $row['mContact'];  ?>">

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
