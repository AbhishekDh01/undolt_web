<?php
	require_once 'connect.php';
	session_start();
	$sid = $_SESSION['navSid'];
	$fileArr = array();
	
	// echo $sid;
	// echo $_POST['date'];
	// exit();
 ?>

<?php

if(isset($_POST['AssignSubmit'])) {

	@mkdir("uploads/$sid");
	$upload_dir = "uploads/$sid".DIRECTORY_SEPARATOR;
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
						header("refresh:0; url= assignmentPost.html");	
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
						header("refresh:0; url= assignmentPost.html");	
						exit();				
						//echo "Error uploading {$file_name} <br />";
					}
				}
			}
			else {
				
				// If file extension not valid
			//	echo "Error uploading {$file_name} ";
				myAlert("{$file_ext} file type is not allowed");
				header("refresh:0; url= assignmentPost.html");
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

	if(isset($_POST['AssignSubmit'])){

	if(!isset($fileArr[0])){
		$fileArr[0] = "";
	}		
	if(!isset($fileArr[1])){
		$fileArr[1] = "";
	}	
	if(!isset($fileArr[2])){
		$fileArr[2] = "";
	}
	if(!isset($fileArr[3])){
		$fileArr[3] = "";
	}
	

	$sql = "INSERT INTO oneshopy_undolt.assignment(subject,topic,info,file1,file2,file3,file4,aStatus,sid,deadline) VALUES(:s,:t,:i,:f1,:f2,:f3,:f4,:ss,:sid,:d)";
	$stmt = $conn->prepare($sql);
	try{

		
		$stmt->execute(
			array(
				':s' => $_POST['subject'],
				':t' => $_POST['topic'],
				':i' => $_POST['info'],
				':f1' => $fileArr[0],
				':f2' => $fileArr[1],
				':f3' => $fileArr[2],
				':f4' => $fileArr[3],
				':ss' => "Pending",
				':sid' => $sid,
				':d'   => $_POST['date'],
		)
	);
	myAlert("Assignment Added Successfully");
	header("refresh:0; url= studentDash.php");
    exit();
}catch(PDOException $e){
	myAlert("Some Internal Error Occured");
	header("refresh:5; url= assignmentPost.html");
}
}
?>

<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>