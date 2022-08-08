<?php
	require_once 'connect.php';
	session_start();
	$tid = $_SESSION['navTid'];
	$fileArr = array();
	
	// echo $sid;
	// echo $_POST['date'];
	// exit();
 ?>

<?php

if(isset($_POST['solSubmit'])) {

	@mkdir("solutions/T$tid");
	$upload_dir = "solutions/T$tid".DIRECTORY_SEPARATOR;
	$allowed_types = array('jpg', 'png', 'jpeg', 'pdf','docx','xlsx','txt','doc');
	
	$maxsize = 8 * 1024 * 1024;   // max size 8mb

	
	if(!empty(array_filter($_FILES['files']['name']))) {
		// echo "here";
	
		foreach ($_FILES['files']['tmp_name'] as $key => $value) {
			
			$file_tmpname = $_FILES['files']['tmp_name'][$key];
			$file_name = $_FILES['files']['name'][$key];
			$file_size = $_FILES['files']['size'][$key];
			$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
			// Set upload file path
			$filepath = $upload_dir.$file_name;

		
			if(in_array(strtolower($file_ext), $allowed_types)) {

				// Verify file size - 8MB max
				if ($file_size > $maxsize)		
					echo "Error: File size is larger than the allowed limit 2MB.";

				// If file with name already exist then append time in
				// front of name of the file to avoid overwriting of file
				if(file_exists($filepath)) {
					$name_used = time().$file_name;
					$filepath = $upload_dir.$name_used;
					
					if( move_uploaded_file($file_tmpname, $filepath)) {
						
					
						$file_name = $name_used;
						array_push($fileArr, $file_name);
					//	header("refresh:1; url= addshopimage.html");
					}
					else {
						myAlert("Error uploading {$file_name}");
						header("refresh:0; url= tutorDash.php");	
						exit();				
						//echo "Error uploading {$file_name} <br />";
					}
				}
				else {
				
					if( move_uploaded_file($file_tmpname, $filepath)) {
						// myAlert("$file_name Successfully uploaded");
						array_push($fileArr, $file_name);
					//	header("refresh:1; url= addshopimage.html");
					}
					else {					
						myAlert("Error uploading {$file_name}");
						header("refresh:0; url= tutorDash.php");	
						exit();				
						//echo "Error uploading {$file_name} <br />";
					}
				}
			}
			else {
				
				// If file extension not valid
			//	echo "Error uploading {$file_name} ";
				myAlert("{$file_ext} file type is not allowed");
				header("refresh:0; url= tutorDash.php");
				exit();
				// echo "({$file_ext} file type is not allowed)<br / >";
			}
		}
	}
	else {
		
		// If no files selected
		// myAlert("No files selected");
		// header("refresh:0; url= assignmentPost.html");
		// exit();
		// echo "No files selected.";
	}
	
}


?>

<?php

	if(isset($_POST['solSubmit'])){

	$i=0;
	while($i<5){	
		if(!isset($fileArr[$i])){
			$fileArr[$i] = "";
		}
		$i++;
	}

	$qid = $_POST['qid'];
	
	
		$sql1 = "update oneshopy_undolt.assignment set solInfo ='".$_POST['solInfo']."' where qid = $qid;";
		$sql2 = "update oneshopy_undolt.assignment set aStatus = 'Solved and in Review' where qid = $qid;";
		$sql3 = "update oneshopy_undolt.assignment set sol1 = '".$fileArr[0]."' where qid = $qid;";
		$sql4 = "update oneshopy_undolt.assignment set sol2 = '".$fileArr[1]."' where qid = $qid;";
		$sql5 = "update oneshopy_undolt.assignment set sol3 = '".$fileArr[2]."' where qid = $qid;";
		$sql6 = "update oneshopy_undolt.assignment set sol4 = '".$fileArr[3]."' where qid = $qid;";
		$sql7 = "update oneshopy_undolt.assignment set sol5 = '".$fileArr[4]."' where qid = $qid;";

		$stmt1 = $conn->prepare($sql1);
		$stmt2 = $conn->prepare($sql2);
		$stmt3 = $conn->prepare($sql3);
		$stmt4 = $conn->prepare($sql4);
		$stmt5 = $conn->prepare($sql5);
		$stmt6 = $conn->prepare($sql6);
		$stmt7 = $conn->prepare($sql7);

	try{
			$stmt1->execute();
			$stmt2->execute();
			$stmt3->execute();
			$stmt4->execute();
			$stmt5->execute();
			$stmt6->execute();
			$stmt7->execute();
		
		myAlert("Solution Submit, In review");
		header("refresh:0; url= tutorDash.php");
	    exit();
}catch(PDOException $e){
	myAlert("Some Internal Error Occured");
	header("refresh:5; url= tutorDash.php");
}
}
?>

<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>