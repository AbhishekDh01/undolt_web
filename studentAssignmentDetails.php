<?php
	require_once 'connect.php';
	header('Cache-Control: no cache');
	session_cache_limiter('private_no_expire');

	session_start();

	$tid = $_SESSION['navSid'];
	if (isset($_POST['qid'])) {
		$qid= $_POST['qid'];
		$stmt = $conn->query("SELECT * FROM oneshopy_undolt.assignment where qid = $qid;");
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Assignment Details</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
	<button onclick="location.href='studentDash.php';" style="margin-left: 92%;">To Dashboard</button>
	<h3>Subject : <?php echo $row['subject'];  ?></h3>
	<h3>Topic : <?php echo $row['topic'];  ?></h3>
	<h3>info : <?php echo $row['info'];  ?></h3>
	<h3>price : <?php echo $row['price'];  ?></h3>
	<h3>deadline : <?php echo $row['deadline'];  ?></h3>
	<h3>Assignment files : </h3>
	

	<?php
		if($row['approvedByMid']!=-999){
			$stmt2 = $conn->query("SELECT mContact FROM oneshopy_undolt.manager where mid = '".$row['approvedByMid']."';");
			$row2=$stmt2->fetch(PDO::FETCH_ASSOC);
			echo "<h3>Assigned Manager whatsapp :";
			echo $row2['mContact'];
			echo "</h3>";
		}
		$sid=$row['sid'];
		$tid = $row['assignTid'];

		if(isset($_POST['rSubmit']) && $row['aStatus']!='Reviewed'){
			$stmt0 = $conn->query("SELECT count(*) as comAssign FROM oneshopy_undolt.assignment where assignTid=$tid and (aStatus = 'Completed' or aStatus = 'Reviewed' ); ");
			$row0=$stmt0->fetch(PDO::FETCH_ASSOC);
			$no = $row0['comAssign'];
			
			$rating = $_POST['rating'];
			$sql1 = "update oneshopy_undolt.assignment set aStatus = 'Reviewed' where qid = $qid;";
			

			$sql2 = "update oneshopy_undolt.tutor set rating = ceil((rating*($no-1)+$rating)/$no) where tid = $tid;";
			$stmt1 = $conn->prepare($sql1);
			$stmt2 = $conn->prepare($sql2);

			try{
				$stmt1->execute();
				$stmt2->execute();

			}catch(PDOException $e){
				myAlert("Internal Error");
				header("refresh:0; url= studentDash.php");
				exit();
			}
			
			myAlert("Task rated");
			header("refresh:0; url= studentDash.php");
			exit();
		}

		
		$dir='uploads/'.$sid."/";
		$i=1;
		$name='file'.$i;
		while ($row[$name]) {
			echo "<a style='margin-left:2.5em' target='_blank' href='$dir$row[$name]'>File $i</a>";
			$i++;
			$name='file'.$i;
			if($i==5) break;
		}


		if($row['aStatus']=='Completed' || $row['aStatus']=='Reviewed'){

			echo "<h3>sol Info : ".$row['solInfo']." </h3>";

			echo "<h3>sol files:</h3>";
			$tid=$row['assignTid'];
			$solDir='solutions/T'.$tid."/";
			  $i=1;
			  $name='sol'.$i;
			  while ($row[$name]) {
					echo "<a style='margin-left:2.5em' target='_blank' href='$solDir$row[$name]'>File $i</a>";
					$i++;
					$name='sol'.$i;
					if($i==6) break;
			  }


		}
		if($row['aStatus']=='Completed' && $row['aStatus']!='Reviewed' && !isset($_POST['rSubmit'])){
			echo "<br><h2>Please rate this assignment</h2>";
			echo "<form method='post' action='studentAssignmentDetails.php'>";
			echo "<input type='hidden' name='qid' value=";
			echo $row['qid'];
			echo ">";
			echo "<input type='number' name = 'rating' max=10 min=0 required='required'>";
			echo "<input type='submit' value='Submit' name='rSubmit'>";
		    echo "</form>";
		}

		
	  ?>


<footer>
	<h3>for any kind of problem/delay contact : --</h3>
</footer>



</body>
</html>			

<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>



