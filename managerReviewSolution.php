<?php
	require_once 'connect.php';
	session_start();
	$mid = $_SESSION['navMid'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Tutor Solutions</title>
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
		<col width="120">

		<tr>

			<th>S.N.</th>
			<th>Qid</th>
			<th>Tid</th>
			<th>Subject</th>
			<th>Status</th>
			<th>Details</th>
			
	    </tr>
	<?php
	$i=1;
	$stmt = $conn->query("SELECT * FROM oneshopy_undolt.assignment where aStatus='Solved and in Review';");
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		$sid=$row['sid'];
		echo "<tr>";
		echo '<td>';
	echo $i;
	$i++;
	echo '</td>';
		echo '<td>';
	echo $row['qid'];
	echo '</td>';
	echo '<td>';
	echo $row['assignTid'];
	echo '</td>';
	echo '<td>';
	echo $row['subject'];
	echo '</td>';
	echo '<td>';
	echo $row['aStatus'];
	echo '</td>';
	echo '<td>';
	echo "<form method='post' action='managerReviewSolutionDetails.php'>";
	echo "<input type='hidden' name='qid' value=";
	echo $row['qid'];
	echo ">";
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