<?php 
require_once 'connect.php';
session_start();
$mid = $_SESSION['navMid'];
?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
</head>
<body>

	<button onclick="location.href='ManagerDash.php';" style="margin-left: 92%;">To Dashboard</button>

	<h1 style="text-align: center;">Search (student, assign, tutor)</h1>

	<form action="" method="POST" style="text-align: center;">
	<select name="sid">
		<option value="none"> Select Student id</option>
		<?php
						
			$stmt = $conn->query("SELECT DISTINCT sid FROM oneshopy_undolt.assignment where approvedByMid=$mid and (aStatus='Approved' or aStatus='Accepted by Tutor' or aStatus='Completed' or aStatus='Solved and in Review');");
			while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
					$sid = $row['sid'];
					echo "<option value=$sid>";
					// echo $row['sName'];
					// echo " - ";
					echo $sid;
					echo'</option>';
			}
	
		 ?>

	</select>
	<select name="qid">
		<option value="none"> Select Assignment id</option>
		<?php
						
			$stmt = $conn->query("SELECT qid,subject,sid FROM oneshopy_undolt.assignment where approvedByMid=$mid");
			while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
					$qid = $row['qid'];
					echo "<option value=$qid>";
					echo $qid;
					echo " - ";
					echo $row['subject'];
					echo " (sid - ";
					echo $row['sid'].')';
					echo'</option>';
			}
	
		 ?>
	</select>

	<select name="tid">
		<option value="none" selected="selected"> Select Tutor id</option>
		<?php
						
			$stmt = $conn->query("SELECT DISTINCT assignTid FROM oneshopy_undolt.assignment where approvedByMid=$mid and assignTid<>-999;");
			while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
					$tid = $row['assignTid'];
					echo "<option value=$tid>";
					// echo $row['tName'];
					// echo " - ";
					echo $tid;
					echo'</option>';
			}
	
		 ?>
	</select>

	<input type="submit" name="sSubmit" value="Search">
</form>

<?php 
		if (isset($_POST['sid']) && $_POST['sid']!='none') {
			$sid = $_POST['sid'];

			$stmt = $conn->query("SELECT sName,sEmail,sContact FROM oneshopy_undolt.student WHERE sid=$sid;");
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			$stmtr = $conn->query("SELECT ref_code FROM oneshopy_undolt.sreferral WHERE sid=$sid;");
			$rowr=$stmtr->fetch(PDO::FETCH_ASSOC);

			$stmt2 = $conn->query("SELECT count(*) as totalAgn FROM oneshopy_undolt.assignment where sid = $sid and aStatus<>'Pending';");
			$row2=$stmt2->fetch(PDO::FETCH_ASSOC);

			echo "<h3>Sid : ".$sid." </h3>
				  <h3>Name : ".$row['sName']." </h3>
				  <h3>Email : ".$row['sEmail']." </h3>
				  <h3>Contact no : ".$row['sContact']." </h3>
				  <h3>Ref code : ".$rowr['ref_code']." </h3>
	 			  <h3>Total Assignment Posted : ".$row2['totalAgn']." </h3>";
	 		echo "<hr>";
			
		}

		if (isset($_POST['tid']) && $_POST['tid']!='none') {
			$tid = $_POST['tid'];
			$stmt3 = $conn->query("SELECT * FROM oneshopy_undolt.tutor WHERE tid=$tid;");
			$row3=$stmt3->fetch(PDO::FETCH_ASSOC);

			$stmta = $conn->query("SELECT count(*) as currAssign FROM oneshopy_undolt.assignment where assignTid=$tid and aStatus = 'Accepted by Tutor'; ");
			$stmtc = $conn->query("SELECT count(*) as comAssign FROM oneshopy_undolt.assignment where assignTid=$tid and (aStatus = 'Completed' or aStatus = 'Reviewed' ); ");

			$rowa=$stmta->fetch(PDO::FETCH_ASSOC);
			$rowc=$stmtc->fetch(PDO::FETCH_ASSOC);

			echo "<h3>tid : ".$tid." </h3>
				  <h3>Name : ".$row3['tName']." </h3>
				  <h3>Email : ".$row3['tEmail']." </h3>
				  <h3>Contact no : ".$row3['tContact']." </h3>
				  <h3>Subjects : ".$row3['tsubject']." </h3>
				  <h3>Rating : ".$row3['rating']." </h3>
				  <h3>Upi : ".$row3['upi']." </h3>
				  <h3>A/C no : ".$row3['bank']." | ifsc : ".$row3['ifsc']." | ifsc : ".$row3['bankName']." </h3>
	 			  <h3>Total Assignment Solved : ".$rowc['comAssign']." </h3>
	 			  <h3>Assignments Pending : ".$rowa['currAssign']." </h3>";

	 	// 	echo 	"<form action='managerSearchOthersBack.php' method='post'>
	 	// 			<input type='hidden' name='tid' value=";
	 	// 	echo	$tid;
	 	// 	echo    ">";
			// echo	"<input type='submit' name='removeTutor' value='Remove Tutor'>
			// 		</form>";


			
		}
		if (isset($_POST['qid']) && $_POST['qid']!='none') {
			$qid = $_POST['qid'];
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

	 		// to approve assignment
	 		
	 			echo "<form method='post' action='managerUpdateAssignment.php'>";
				echo "<input type='hidden' name='qid' value=";
				echo $qid;
				echo ">";
				echo "<input type='hidden' name = 'header' value = 'managerSearchOthers.php' >";
				if ($row4['aStatus']=='Pending' || $row4['aStatus']=='Approved') {
					echo "<input type='submit' value='Edit Assignment' name='uSubmit'>";
				}
				echo "</form>";	  

			// if tutor takes assigment then --


	  		if($row4['assignTid']!=-999){

	  			$stmt5 = $conn->query("SELECT tName,rating FROM oneshopy_undolt.tutor where tid = '".$row4['assignTid']."';");
				$row5 =$stmt5->fetch(PDO::FETCH_ASSOC);

	  			echo "<h3>";
	  			echo "Tid - ".$row4['assignTid']."  (rating - ".$row5['rating'].")";
	  			echo "</h3>";

		  			
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
		 			 

	  			echo '<br><br>';

	  			echo "<form method='post' action='managerSearchOthersBack.php'>";
				echo "<input type='hidden' name='qid' value=";
				echo $qid;
				echo ">";
				echo "<input type='hidden' name = 'header' value = 'managerSearchOthers.php' >";
				if ($row4['aStatus']!='Completed' && $row4['aStatus']!='Reviewed') {
					echo "<input type='submit' value='Unassign' name='assignSubmit'>";
				}
				if ($row4['aStatus']=='Completed' || $row4['aStatus']=='Solved and in Review' ) {
					echo "<input type='submit' value='Improve Solution' name='assignImprove'>";
				}
				
				if ($row4['aStatus']=='Solved and in Review') {
				echo "<input type='submit' value='Approve Solution' name='assignApprove'>";	
				}
				echo "<input type='submit' value='Could not be solved' name='assignDelete'>";
	  		}
	  		echo "<hr>";
	  				  	}
	 ?>


</body>
</html>

