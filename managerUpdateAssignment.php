<?php
	require_once 'connect.php';
	header('Cache-Control: no cache');
	session_cache_limiter('private_no_expire');

	session_start();

	$mid = $_SESSION['navMid'];
	if (isset($_POST['uSubmit'])) {
		$qid= $_POST['qid'];
		$stmt = $conn->query("SELECT * FROM oneshopy_undolt.assignment where qid = $qid;");
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		$stmts = $conn->query("SELECT * FROM oneshopy_undolt.student where sid = '".$row['sid']."';");
		$rows=$stmts->fetch(PDO::FETCH_ASSOC);
		$stmtt = $conn->query("SELECT * FROM oneshopy_undolt.sreferral where sid = '".$row['sid']."';");
		$rowt=$stmtt->fetch(PDO::FETCH_ASSOC);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Assignment</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>

	<button onclick="location.href='managerDash.php';" style="margin-left: 92%;">To Dashboard</button>

	<h3>Sid : <?php echo $row['sid'];  ?></h3>
	<h3>Name : <?php echo $rows['sName'];  ?></h3>
	<h3>Contact : <?php echo $rows['sContact'];  ?></h3>
	<h3>Qid : <?php echo $qid;  ?></h3>
	<h3>Files :</h3>

	<?php
		$sid=$row['sid'];
		$dir='uploads/'.$sid."/";
		$i=1;
		$name='file'.$i;
		while ($row[$name]) {
			echo "<a style='margin-left:2.5em' target='_blank' href='$dir$row[$name]'>File $i</a>";
			$i++;
			$name='file'.$i;
			if($i==5) break;
		}
		

		
	  ?>
	  <h3>Status : <?php echo $row['aStatus'];  ?></h3>
	  
	  <?php  
	  		if($row['assignTid']!=-999){
	  			$stmt2 = $conn->query("SELECT tName,rating FROM oneshopy_undolt.tutor where tid = '".$row['assignTid']."';");
				$row2 =$stmt2->fetch(PDO::FETCH_ASSOC);
	  			echo "<p>";
	  			echo "Tid - ".$row['assignTid']." : ".$row2['tName']." (rating - ".$row2['rating'].")";
	  			echo "</p>";
	  		}
	  ?>
	   <h3>Referral : <?php echo $rowt['applicable_ref'];  ?></h3>

	<h1 style="text-align: center;">Update Assignment</h1>
	<form action="managerUpdateAssignmentBack.php" method="post" enctype="multipart/form-data" style="text-align: center;" >
				
			<input type="hidden" name="qid" value="<?php echo $row['qid']; ?>">
			<input type="hidden" name="sid" value="<?php echo $row['sid']; ?>">
			<input type='hidden' name = 'header' value ="<?php echo $_POST['header'];  ?>" >

			<input type="text" name="subject" value="<?php echo $row['subject']; ?>">

			<input type="text" name="topic" value="<?php echo $row['topic']; ?>" >

			<input type="text" name="info" value="<?php echo $row['info']; ?>" >

			<br><br>

			student price:<input type="number" name="price" value="<?php echo $row['price']; ?>" required='required' >
			tutor price:<input type="number" name="tPrice" value="<?php echo $row['tPrice']; ?>" required='required' >

			<p> Deadline : 
			<input type="date" name="date" value="<?php echo $row['deadline']; ?>" >
			</p>

			
			<input type="submit" name="assignSubmit" value="Approve and Update"  >
			<input type="submit" name="assignDelete" value="Delete"  >
		
	</form>

</body>
</html>




