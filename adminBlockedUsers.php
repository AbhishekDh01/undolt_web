<?php
	require_once 'connect.php';
	session_start();
	$aid = $_SESSION['navAid'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Blocked Users</title>
</head>
<body>

	<button onclick="location.href='adminDash.php';" style="margin-left: 92%;">To Dashboard</button>

	<h2>Managers</h2>

	 <div style="overflow-x: auto;">
	  <table class="center" border="2">
	  <col width="60">
	<col width="80">
	<col width="160">
	<col width="120">
	<col width="160">
	<col width="160">
	<tr>
		<th>S.N.</th>
		<th>Mid</th>
		<th>Name</th>
		<th>Contact</th>
		<th>Email</th>
		<th>Unblock</th>
		
	</tr>
	<?php
	$i=1;
	$stmt = $conn->query("SELECT * FROM oneshopy_undolt.manager WHERE banned=1;");
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
		echo "<form method='post' action='adminBlockedUsersBack.php'>";
		echo "<input type='hidden' name='mid' value=";
		echo $row['mid'];
		echo ">";
		echo "<input type='submit' value='Unblock' name='unblockManager'>";
	    echo "</form>";

		echo '</td>';
		echo "</tr>";
	}
	?>
</table>
</div>

<h2>Tutors</h2>

	 <div style="overflow-x: auto;">
	  <table class="center" border="2">
	  <col width="60">
	<col width="80">
	<col width="160">
	<col width="120">
	<col width="160">
	<col width="160">
	<tr>
		<th>S.N.</th>
		<th>Tid</th>
		<th>Name</th>
		<th>Contact</th>
		<th>Email</th>
		<th>Unblock</th>
		
	</tr>
	<?php
	$i=1;
	$stmt1 = $conn->query("SELECT * FROM oneshopy_undolt.tutor WHERE banned=1;");
	while ($row1=$stmt1->fetch(PDO::FETCH_ASSOC)){
		$tid=$row1['tid'];
		echo "<tr>";
		echo '<td>';
		echo $i;
		$i++;
		echo '</td>';
		echo '<td>';
		echo $row1['tid'];
		echo '</td>';
		echo '<td>';
		echo $row1['tName'];
		echo '</td>';
		echo '<td>';
		echo $row1['tContact'];
		echo '</td>';
		echo '<td>';
		echo $row1['tEmail'];
		echo '</td>';
		echo '<td>';
		echo "<form method='post' action='adminBlockedUsersBack.php'>";
		echo "<input type='hidden' name='tid' value=";
		echo $row1['tid'];
		echo ">";
		echo "<input type='submit' value='Unblock' name='unblockTutor'>";
	    echo "</form>";

		echo '</td>';
		echo "</tr>";
	}
	?>
</table>
</div>

<h2>Students</h2>

	 <div style="overflow-x: auto;">
	  <table class="center" border="2">
	  <col width="60">
	<col width="80">
	<col width="160">
	<col width="120">
	<col width="160">
	<col width="160">
	<tr>
		<th>S.N.</th>
		<th>Sid</th>
		<th>Name</th>
		<th>Contact</th>
		<th>Email</th>
		<th>Unblock</th>
		
	</tr>
	<?php
	$i=1;
	$stmt3 = $conn->query("SELECT * FROM oneshopy_undolt.student WHERE banned=1;");
	while ($row3=$stmt3->fetch(PDO::FETCH_ASSOC)){
		$sid=$row3['sid'];
		echo "<tr>";
		echo '<td>';
		echo $i;
		$i++;
		echo '</td>';
		echo '<td>';
		echo $row3['sid'];
		echo '</td>';
		echo '<td>';
		echo $row3['sName'];
		echo '</td>';
		echo '<td>';
		echo $row3['sContact'];
		echo '</td>';
		echo '<td>';
		echo $row3['sEmail'];
		echo '</td>';
		echo '<td>';
		echo "<form method='post' action='adminBlockedUsersBack.php'>";
		echo "<input type='hidden' name='sid' value=";
		echo $row3['sid'];
		echo ">";
		echo "<input type='submit' value='Unblock' name='unblockStudent'>";
	    echo "</form>";

		echo '</td>';
		echo "</tr>";
	}
	?>
</table>
</div>

</body>
</html>