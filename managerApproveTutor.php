<?php
	require_once 'connect.php';
	session_start();
	$mid = $_SESSION['navMid'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>New Tutors</title>
</head>
<body>

	<button onclick="location.href='ManagerDash.php';" style="margin-left: 92%;">To Dashboard</button>

	 <div style="overflow-x: auto;">
	  <table class="center" border="2">
	  	 	<col width="60">
	<col width="60">
	<!-- <col width="160"> -->
	<col width="160">
	<col width="160">
	<col width="100">
	<col width="100">
	<col width="160">
	<tr>
		<th>S.N.</th>
		<th>tid</th>
		<th>Name</th>
		<th>Subjects</th>
		<th>Contact</th>
		<th>Email</th>
		<th>Approve/Disapprove</th>
		
	</tr>
	<?php
	$i=1;
	$stmt = $conn->query("SELECT * FROM oneshopy_undolt.tutor WHERE approved='Pending';");
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		$sid=$row['tid'];
		echo "<tr>";
		echo '<td>';
		echo $i;
		$i++;
		echo '</td>';
		echo '<td>';
		echo $row['tid'];
		echo '</td>';
		echo '<td>';
		echo $row['tName'];
		echo '</td>';
		echo '<td>';
		echo $row['tsubject'];
		echo '</td>';
		echo '<td>';
		echo $row['tContact'];
		echo '</td>';
		echo '<td>';
		echo $row['tEmail'];
		echo '</td>';
		echo '<td>';
		echo "<form method='post' action='managerApproveTutorBack.php'>";
		echo "<input type='hidden' name='tid' value=";
		echo $row['tid'];
		echo ">";
		echo "<input type='hidden' name='tEmail' value=";
		echo $row['tEmail'];
		echo ">";
		echo "<input type='hidden' name='tName' value=";
		echo $row['tName'];
		echo ">";
		echo "<input type='submit' value='Approve' name='tApprove'>";
		echo "<input type='submit' value='Disapprove' name='tDisapprove'>";
	    echo "</form>";

		echo '</td>';
		echo "</tr>";
	}
	?>
</table>
</div>



</body>
</html>