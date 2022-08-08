<?php
	require_once 'connect.php';
	session_start();
	$mid = $_SESSION['navMid'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Student side Assignment</title>
</head>
<body>
	<button onclick="location.href='ManagerDash.php';" style="margin-left: 92%;">To Dashboard</button>
	
	 <div style="overflow-x: auto;">
	  <table class="center" border="2">
		 <col width="60">
		<col width="60">
		<col width="160">
		<col width="160">
		<col width="100">
		<col width="100">
		<col width="120">

		<tr>

			<th>S.N.</th>
			<th>Qid</th>
			<th>Name</th>
			<th>Subject</th>
			<th>Stu_Price</th>
			<th>tut_Price</th>
			<th>Status</th>
			<th>Details/Update</th>
			
	    </tr>
	<?php
	$i=1;
	$stmt = $conn->query("SELECT * FROM oneshopy_undolt.assignment where aStatus='Pending';");
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		$sid=$row['sid'];
		$stmt2 = $conn->query("SELECT sname FROM oneshopy_undolt.student where sid='$sid';");
		$row2=$stmt2->fetch(PDO::FETCH_ASSOC);
		echo "<tr>";
		echo '<td>';
	echo $i;
	$i++;
	echo '</td>';
		echo '<td>';
	echo $row['qid'];
	echo '</td>';
	echo '<td>';
	echo $row2['sname'];
	echo '</td>';
	echo '<td>';
	echo $row['subject'];
	echo '</td>';
	echo '<td>';
	echo $row['price'];
	echo '</td>';
	echo '<td>';
	echo $row['tPrice'];
	echo '</td>';
	echo '<td>';
	echo $row['aStatus'];
	echo '</td>';
	echo '<td>';
	echo "<form method='post' action='managerUpdateAssignment.php'>";
	echo "<input type='hidden' name='qid' value=";
	echo $row['qid'];
	echo ">";
	echo "<input type='hidden' name = 'header' value = 'ManagerApproveAssignment.php' >";
	echo "<input type='submit' value='click me' name='uSubmit'>";
    echo "</form>";
	echo '</td>';
		echo "</tr>";
	}
	?>
</table>
</div>



</body>
</html>