<?php
	require_once 'connect.php';
	session_start();
		$qid = $_POST['qid'];
		$head = $_POST['header'];
		$sid = $_POST['sid'];

	if (isset($_POST['assignSubmit'])) {
		
		$stmtt = $conn->query("SELECT * FROM oneshopy_undolt.sreferral where sid = $sid;");
		$rowt=$stmtt->fetch(PDO::FETCH_ASSOC);

		$sql1 = "update oneshopy_undolt.assignment set subject ='".$_POST['subject']."' where qid = $qid;";
		$sql2 = "update oneshopy_undolt.assignment set topic ='".$_POST['topic']."' where qid = $qid;";
		$sql3 = "update oneshopy_undolt.assignment set info ='".$_POST['info']."' where qid = $qid;";
		$sql4 = "update oneshopy_undolt.assignment set price ='".$_POST['price']."' where qid = $qid;";
		$sql5 = "update oneshopy_undolt.assignment set deadline ='".$_POST['date']."' where qid = $qid;";
		$sql6 = "update oneshopy_undolt.assignment set aStatus = 'Approved' where qid = $qid;";
		$sql8 = "update oneshopy_undolt.assignment set assignTid ='-999' where qid = $qid;";
		$sql9 = "update oneshopy_undolt.assignment set tPrice ='".$_POST['tPrice']."' where qid = $qid;";
		$sql10 = "update oneshopy_undolt.sreferral set applicable_ref = applicable_ref+1 where sid = '".$rowt['referral_sid']."';";
		$sql11 = "update oneshopy_undolt.sreferral set first_order ='done' where sid = $sid;";
		$sql12 = "update oneshopy_undolt.sreferral set used_ref =used_ref+1 where sid = $sid;";
		$sql13 = "update oneshopy_undolt.sreferral set applicable_ref =applicable_ref-1 where sid = $sid;";
		$sql14 = "update oneshopy_undolt.assignment set ref_used = 1 where qid = $qid;";

		$stmt1 = $conn->prepare($sql1);
		$stmt2 = $conn->prepare($sql2);
		$stmt3 = $conn->prepare($sql3);
		$stmt4 = $conn->prepare($sql4);
		$stmt5 = $conn->prepare($sql5);
		$stmt6 = $conn->prepare($sql6);
		
		$stmt8 = $conn->prepare($sql8);
		$stmt9 = $conn->prepare($sql9);
		$stmt10 = $conn->prepare($sql10);
		$stmt11 = $conn->prepare($sql11);
		$stmt12 = $conn->prepare($sql12);
		$stmt13 = $conn->prepare($sql13);
		$stmt14 = $conn->prepare($sql14);
		
		try{
			if($_POST['subject'])	$stmt1->execute();
			
			if($_POST['topic'])	$stmt2->execute();
			
			if($_POST['info'])	$stmt3->execute();

			if($_POST['date'])	$stmt5->execute();

			$stmt4->execute();
			$stmt6->execute();
			$stmt8->execute();
			$stmt9->execute();
			if ($rowt['first_order']=='pending') {
				if ($rowt['referral_sid']!=-999) {
					$stmt10->execute();
				}
				$stmt11->execute();
			}
			if ($rowt['applicable_ref']!=0) {
				$stmt12->execute();
				$stmt13->execute();
				$stmt14->execute();
			}


		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= $head");
			exit();
		}
		myAlert("Details Successfully Updated");
			header("refresh:0; url= $head");
		    exit();

	}

	if(isset($_POST['assignDelete'])){
		$stmt = $conn->query("SELECT * FROM oneshopy_undolt.assignment where qid = $qid;");
		$row=$stmt->fetch(PDO::FETCH_ASSOC);

		$sid=$row['sid'];
		$dir='uploads/'.$sid."/";

		$sql12 = "update oneshopy_undolt.sreferral set used_ref =used_ref-1 where sid = $sid;";
		$sql13 = "update oneshopy_undolt.sreferral set applicable_ref =applicable_ref+1 where sid = $sid;";

		$stmt12 = $conn->prepare($sql12);
		$stmt13 = $conn->prepare($sql13);

		if(($row['aStatus']!='Completed' && $row['aStatus']!='Reviewed') && $row['ref_used']==1 ){
			$stmt12->execute();
			$stmt13->execute();
		}


		$stmt2 = $conn->prepare("DELETE FROM oneshopy_undolt.assignment where qid=:q;");
		$stmt2->bindParam(':q',$qid);
		$stmt2->execute();

		if(!$stmt2->rowCount()){
			myAlert("Some Internal Error Occured");
			header("refresh:0; url= $head");
			exit();
			}else{
				$i=1;
				$name='file'.$i;
				while ($row[$name]) {
					if( !unlink($dir.$row[$name]) ){
						myAlert("img$i Not deleted from Database");
					}else{
						 myAlert("img$i deleted from Database");
					}
					$i++;
					$name='file'.$i;
					if($i==5) break;
			}
			myAlert("Assignment Deleted Successfully");
			//Mail Alert
			header("refresh:0; url= $head");
			exit();
		}
	}

?>

<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>