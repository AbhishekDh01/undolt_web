<?php
	require_once 'connect.php';
	session_start();
		$mid = $_SESSION['navMid'];
		

	if (isset($_POST['assignSubmit'])) {
		$qid = $_POST['qid'];
		$adrs = $_POST['header'];

		$stmt = $conn->query("SELECT * FROM oneshopy_undolt.assignment where qid = $qid;");
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			$tid=$row['assignTid'];
			$dir='solutions/T'.$tid."/";

			$i=1;
				$name='sol'.$i;
				while ($row[$name]) {
					if( !unlink($dir.$row[$name]) ){
						myAlert("file$i Not deleted from Database");
					}else{
						 myAlert("file$i deleted from Database");
					}
					$i++;
					$name='sol'.$i;
					if($i==6) break;
				}

		$sql6 = "update oneshopy_undolt.assignment set aStatus = 'Approved' where qid = $qid;";
		$sql7 = "update oneshopy_undolt.assignment set approvedByMid ='".$mid."' where qid = $qid;";
		$sql8 = "update oneshopy_undolt.assignment set assignTid ='-999' where qid = $qid;";
		$sql9 = "update oneshopy_undolt.assignment set sol1 = '' where qid = $qid;";
		$sql10 = "update oneshopy_undolt.assignment set sol2 = '' where qid = $qid;";
		$sql11 = "update oneshopy_undolt.assignment set sol3 = '' where qid = $qid;";
		$sql12 = "update oneshopy_undolt.assignment set sol4 = '' where qid = $qid;";
		$sql13 = "update oneshopy_undolt.assignment set sol5 = '' where qid = $qid;";
		$sql14 = "update oneshopy_undolt.assignment set solInfo = '' where qid = $qid;";

		$stmt6 = $conn->prepare($sql6);
		$stmt7 = $conn->prepare($sql7);
		$stmt8 = $conn->prepare($sql8);
		$stmt9 = $conn->prepare($sql9);
		$stmt10 = $conn->prepare($sql10);
		$stmt11 = $conn->prepare($sql11);
		$stmt12 = $conn->prepare($sql12);
		$stmt13 = $conn->prepare($sql13);
		$stmt14 = $conn->prepare($sql14);
		
		try{
			$stmt6->execute();
			$stmt7->execute();
			$stmt8->execute();
			$stmt9->execute();
			$stmt10->execute();
			$stmt11->execute();
			$stmt12->execute();
			$stmt13->execute();
			$stmt14->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= $adrs");
		}

			
				myAlert("Tutor Unassigned Successfully Updated");
				header("refresh:0; url= $adrs");
		    	exit();
		

	}

	if(isset($_POST['assignDelete'])){
		$qid = $_POST['qid'];
		$adrs = $_POST['header'];

		$stmt = $conn->query("SELECT * FROM oneshopy_undolt.assignment where qid = $qid;");
		$row=$stmt->fetch(PDO::FETCH_ASSOC);

		$sid=$row['sid'];

		$stmtss = $conn->query("SELECT sEmail FROM oneshopy_undolt.student where sid = $sid;");
		$rowss=$stmtss->fetch(PDO::FETCH_ASSOC);

		$fdir='uploads/'.$sid."/";

		$tid=$row['assignTid'];
		$sdir='solutions/T'.$tid."/";	

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
			header("refresh:0; url= $adrs");
			exit();
			}else{
				$i=1;
				$name='file'.$i;
				while ($row[$name]) {
					if( !unlink($fdir.$row[$name]) ){
						myAlert("file$i Not deleted from Database");
					}else{
						 myAlert("file$i deleted from Database");
					}
					$i++;
					$name='file'.$i;
					if($i==5) break;
			}

			$i=1;
				$name='sol'.$i;
				while ($row[$name]) {
					if( !unlink($sdir.$row[$name]) ){
						myAlert("file$i Not deleted from Database");
					}else{
						 myAlert("file$i deleted from Database");
					}
					$i++;
					$name='sol'.$i;
					if($i==6) break;
				}

				$to = $rowss['sEmail'];
				$from = "no_reply@undolt.in";

				ini_set( 'display_errors', 1 );
				error_reporting( E_ALL );

	         $subject = "Assignment Details";
	         
	         $message = "
						<html>
						<head>
						<title>Assignment - $qid</title>
						</head>
						<body>
						<h2>Sorry your assignment - $qid could not be solved</h2>

						<p>dash dash...</p>

						<p>Policy:</p>
						</body>
						</html>
						";

			$headers = "From:" . $from. "\r\n";
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'Cc: abhiclass01@gmail.com' . "\r\n";

			if(mail($to,$subject,$message, $headers)) {
			    // myAlert("Approval Email sent");
			} else {
			    myAlert("Error in sending email");
			}

			myAlert("Assignment Deleted Successfully");
			header("refresh:0; url= $adrs");
			exit();
		}
	}

	if (isset($_POST['assignApprove'])) {
		$qid = $_POST['qid'];
		$adrs = $_POST['header'];

		$stmt = $conn->query("SELECT * FROM oneshopy_undolt.assignment where qid = $qid;");
		$row=$stmt->fetch(PDO::FETCH_ASSOC);

		$sid=$row['sid'];

		$stmtss = $conn->query("SELECT sEmail FROM oneshopy_undolt.student where sid = $sid;");
		$rowss=$stmtss->fetch(PDO::FETCH_ASSOC);

		$sql15 = "update oneshopy_undolt.assignment set aStatus = 'Completed' where qid = $qid;";
		$stmt15 = $conn->prepare($sql15);
		try{
			$stmt15->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= $adrs");
		}

				$to = $rowss['sEmail'];
				$from = "no_reply@undolt.in";

				ini_set( 'display_errors', 1 );
				error_reporting( E_ALL );

	         $subject = "Assignment Details";
	         
	         $message = "
						<html>
						<head>
						<title>Assignment - $qid</title>
						</head>
						<body>
						<h2>Your assignment $qid has been solved please login into your account to see solution</h2>

						<p>dash dash...</p>
						<a href='https://abhi.oneshopy.in/studentLogin.php' style=''>Click me</a>
						<p>Policy:</p>
						</body>
						</html>
						";

			$headers = "From:" . $from. "\r\n";
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'Cc: abhiclass01@gmail.com' . "\r\n";

			if(mail($to,$subject,$message, $headers)) {
			    // myAlert("Approval Email sent");
			} else {
			    myAlert("Error in sending email");
			}

		myAlert("Solution Approved");
		header("refresh:0; url= $adrs");
	}

	if (isset($_POST['assignImprove'])) {
		$qid = $_POST['qid'];
		$adrs = $_POST['header'];
		$stmt = $conn->query("SELECT * FROM oneshopy_undolt.assignment where qid = $qid;");
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			$tid=$row['assignTid'];
			$dir='solutions/T'.$tid."/";

			$i=1;
				$name='sol'.$i;
				while ($row[$name]) {
					if( !unlink($dir.$row[$name]) ){
						myAlert("file$i Not deleted from Database");
					}else{
						 myAlert("file$i deleted from Database");
					}
					$i++;
					$name='sol'.$i;
					if($i==6) break;
				}

		$sql6 = "update oneshopy_undolt.assignment set aStatus = 'Accepted by Tutor' where qid = $qid;";
		$sql7 = "update oneshopy_undolt.assignment set approvedByMid ='".$mid."' where qid = $qid;";
		$sql9 = "update oneshopy_undolt.assignment set sol1 = '' where qid = $qid;";
		$sql10 = "update oneshopy_undolt.assignment set sol2 = '' where qid = $qid;";
		$sql11 = "update oneshopy_undolt.assignment set sol3 = '' where qid = $qid;";
		$sql12 = "update oneshopy_undolt.assignment set sol4 = '' where qid = $qid;";
		$sql13 = "update oneshopy_undolt.assignment set sol5 = '' where qid = $qid;";
		$sql14 = "update oneshopy_undolt.assignment set solInfo = '' where qid = $qid;";

		$stmt6 = $conn->prepare($sql6);
		$stmt7 = $conn->prepare($sql7);
		$stmt9 = $conn->prepare($sql9);
		$stmt10 = $conn->prepare($sql10);
		$stmt11 = $conn->prepare($sql11);
		$stmt12 = $conn->prepare($sql12);
		$stmt13 = $conn->prepare($sql13);
		$stmt14 = $conn->prepare($sql14);
		
		try{
			$stmt6->execute();
			$stmt7->execute();
			$stmt9->execute();
			$stmt10->execute();
			$stmt11->execute();
			$stmt12->execute();
			$stmt13->execute();
			$stmt14->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= $adrs");
		}

			
		myAlert("Solution gone for improvment");
		header("refresh:0; url= $adrs");
    	exit();
		
	}

?>

<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>