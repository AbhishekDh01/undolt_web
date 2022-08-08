<?php
	require_once 'connect.php';
	session_start();
	$aid = $_SESSION['navAid'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>New Managers</title>
</head>
<body>

	<button onclick="location.href='adminDash.php';" style="margin-left: 92%;">To Dashboard</button>

	 <div style="overflow-x: auto;">
	  <table class="center" border="2">
	  <col width="60">
	<col width="60">
	<col width="160">
	<col width="100">
	<col width="100">
	<col width="160">
	<tr>
		<th>S.N.</th>
		<th>Mid</th>
		<th>Name</th>
		<th>Contact</th>
		<th>Email</th>
		<th>Approve/Disapprove</th>
		
	</tr>
	<?php
	$i=1;
	$stmt = $conn->query("SELECT * FROM oneshopy_undolt.manager WHERE approved='No';");
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		$mid=$row['mid'];
		echo "<tr>";
		echo '<td>';
		echo $i;
		$i++;
		echo '</td>';
		echo '<td>';
		echo $row['mid'];
		echo '</td>';
		echo '<td>';
		echo $row['mName'];
		echo '</td>';
		echo '<td>';
		echo $row['mContact'];
		echo '</td>';
		echo '<td>';
		echo $row['mEmail'];
		echo '</td>';
		echo '<td>';
		echo "<form method='post' action='adminApproveManagerBack.php'>";
		echo "<input type='hidden' name='mid' value=";
		echo $row['mid'];
		echo ">";
		echo "<input type='hidden' name='mEmail' value=";
		echo $row['mEmail'];
		echo ">";
		echo "<input type='hidden' name='mName' value=";
		echo $row['mName'];
		echo ">";
		echo "<input type='submit' value='Approve' name='mApprove'>";
		echo "<input type='submit' value='Disapprove' name='mDisapprove'>";
	    echo "</form>";

		echo '</td>';
		echo "</tr>";
	}
	?>
</table>
</div>



</body>
</html>