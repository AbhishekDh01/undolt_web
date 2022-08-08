<?php
	require_once 'connect.php';
	session_start();
	$sid = $_SESSION['navSid'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Assignment Dashboard</title>
</head>
<body>

	 <div style="overflow-x: auto;">
	  <table class="center" border="2">
	  	<col width="60">
	<col width="200">
	<!-- <col width="160"> -->
	<col width="80">
	<col width="80">
	<col width="180">
	<col width="180">
	<col width="140">
	<tr>
		<th>S.N.</th>
		<th>Subject</th>
		<th>Topic</th>
		<th>Status</th>
		<th>Price</th>
		<th>Deadline</th>
		<th>Details</th>
		
	</tr>
	<?php
	$i=1;
	$stmt = $conn->query("SELECT * FROM oneshopy_undolt.assignment where sid = $sid and (aStatus='Completed' ||  aStatus='Reviewed');");
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		echo "<tr>";
		echo '<td>';
	echo $i;
	$i++;
	echo '</td>';
		echo '<td>';
	echo $row['subject'];
	echo '</td>';
	echo '<td>';
	echo $row['topic'];
	echo '</td>';
	echo '<td>';
	echo $row['aStatus'];
	echo '</td>';
	echo '<td>';
	echo $row['price'];
	echo '</td>';
	echo '<td>';
	echo $row['deadline'];
	echo '</td>';
	echo '<td>';
	echo "<form method='post' action='studentAssignmentDetails.php'>";
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