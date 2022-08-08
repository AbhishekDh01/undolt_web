<?php
	require_once 'connect.php';
	session_start();
	$tid = $_SESSION['navTid'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Available Assignment</title>
</head>
<body>

	 <div style="overflow-x: auto;">
	  <table class="center" border="2">
		 <col width="60">
		<col width="60">
		<col width="160">
		<col width="100">
		<col width="100">
		<col width="120">

		<tr>

			<th>S.N.</th>
			<th>Qid</th>
			<th>Subject</th>
			<th>Price</th>
			<th>Deadline</th>
			<th>Details(Take task)</th>
			
	    </tr>
	<?php
	$i=1;
	$stmt = $conn->query("SELECT * FROM oneshopy_undolt.assignment where aStatus ='Approved';");
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		echo "<tr>";
		echo '<td>';
	echo $i;
	$i++;
	echo '</td>';
	echo '<td>';
	echo $row['qid'];
	echo '</td>';
	echo '<td>';
	echo $row['subject'];
	echo '</td>';
	echo '<td>';
	echo $row['tPrice'];
	echo '</td>';
	echo '<td>';
	echo $row['deadline'];
	echo '</td>';
	echo '<td>';
	echo "<form method='post' action='tutorAssignmentDetails.php'>";
	echo "<input type='hidden' name='qid' value=";
	echo $row['qid'];
	echo ">";
	echo "<input type='submit' value='click me' name='tSubmit'>";
    echo "</form>";
	echo '</td>';
		echo "</tr>";
	}
	?>
</table>
</div>



</body>
</html>