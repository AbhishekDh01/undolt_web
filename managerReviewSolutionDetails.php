<?php
	require_once 'connect.php';
	header('Cache-Control: no cache');
	session_cache_limiter('private_no_expire');

	session_start();

	$mid = $_SESSION['navMid'];
	if (isset($_POST['uSubmit'])) {
		$qid= $_POST['qid'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Review Solution</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>


	<?php
			$stmt4 = $conn->query("SELECT * FROM oneshopy_undolt.assignment where qid = $qid;");
			$row4=$stmt4->fetch(PDO::FETCH_ASSOC);


			echo "<h3>qid : ".$qid." </h3>
				  <h3>submitted sid : ".$row4['sid']." </h3>
				  <h3>Subject : ".$row4['subject']." </h3>
				  <h3>Topic : ".$row4['topic']." </h3>
				  <h3>Info : ".$row4['info']." </h3>
				  <h3>stu price : ".$row4['price']." </h3>
				  <h3>tut price : ".$row4['tPrice']." </h3>
				  <h3>deadline : ".$row4['deadline']." </h3>
				  <h3>file :  </h3>";
				  $sid4=$row4['sid'];
				  $dir='uploads/'.$sid4."/";
				  $i=1;
				  $name='file'.$i;
				  while ($row4[$name]) {
						echo "<a style='margin-left:2.5em' target='_blank' href='$dir$row4[$name]'>File $i</a>";
						$i++;
						$name='file'.$i;
						if($i==5) break;
				  }

	 			  echo "<h3>Status : ".$row4['aStatus']." </h3>";

			
	  		if($row4['assignTid']!=-999){
	  			
	  		if ($row4['aStatus']=='Solved and in Review' || $row4['aStatus']=='Completed' || $row4['aStatus']=='Reviewed') {	

				echo "<h3>sol Info : ".$row4['solInfo']." </h3>";

				echo "<h3>sol files:</h3>";
				$tid=$row4['assignTid'];
				$solDir='solutions/T'.$tid."/";
				  $i=1;
				  $name='sol'.$i;
				  while ($row4[$name]) {
						echo "<a style='margin-left:2.5em' target='_blank' href='$solDir$row4[$name]'>File $i</a>";
						$i++;
						$name='sol'.$i;
						if($i==6) break;
				  }
			}	  
	 			 


				$stmt5 = $conn->query("SELECT tName,rating FROM oneshopy_undolt.tutor where tid = '".$row4['assignTid']."';");
				$row5 =$stmt5->fetch(PDO::FETCH_ASSOC);
	  			echo "<h3>";
	  			echo "Tid - ".$row4['assignTid']." : ".$row5['tName']." (rating - ".$row5['rating'].")";
	  			echo "</h3>";


	  			echo "<form method='post' action='managerSearchOthersBack.php'>";
				echo "<input type='hidden' name='qid' value=";
				echo $qid;
				echo ">";
				echo "<input type='hidden' name = 'header' value = 'managerReviewSolution.php' >";
				if ($row4['aStatus']!='Completed' && $row4['aStatus']!='Reviewed') {
					echo "<input type='submit' value='Unassign' name='assignSubmit'>";
				}
				
				if ($row4['aStatus']=='Completed' || $row4['aStatus']=='Reviewed' || $row4['aStatus']=='Solved and in Review' ) {
					echo "<input type='submit' value='Improve Solution' name='assignImprove'>";
				}
				
				if ($row4['aStatus']=='Solved and in Review') {
				echo "<input type='submit' value='Approve Solution' name='assignApprove'>";	
				}
				echo "<input type='submit' value='Could not be Solved' name='assignDelete'>";
	  		}	  	
	 ?>
	  


</body>
</html>




