<?php
	require_once 'connect.php';
	header('Cache-Control: no cache');
	session_cache_limiter('private_no_expire');

	session_start();

	$tid = $_SESSION['navTid'];
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

	<button onclick="location.href='tutorDash.php';" style="margin-left: 92%;">To Dashboard</button>

	<h3>Subject : <?php echo $row['subject'];  ?></h3>
	<h3>Topic : <?php echo $row['topic'];  ?></h3>
	<h3>info : <?php echo $row['info'];  ?></h3>
	<h3>price : <?php echo $row['tPrice'];  ?></h3>
	<h3>deadline : <?php echo $row['deadline'];  ?></h3>
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

	<?php  
	if(isset($_POST['takeAssign'])){
		$sql1 = "update oneshopy_undolt.assignment set assignTid ='".$_POST['tid']."' where qid = '".$_POST['qid']."';";
		$sql2 = "update oneshopy_undolt.assignment set aStatus = 'Accepted by Tutor' where qid = '".$_POST['qid']."';";
	
		$stmt1 = $conn->prepare($sql1);
		$stmt2 = $conn->prepare($sql2);

		try{
			$stmt1->execute();
			$stmt2->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			exit();
		}
		myAlert("Assignment Taken");
}
?>  

	  <br>
	  <br>
	<?php  

		if(!isset($_POST['takeAssign'])){
			echo "<form action='tutorAssignmentDetails.php' method='POST'>
		<input type='hidden' name='qid' value=";
		echo $qid;
		echo  ">";
		echo "<input type='hidden' name='tid' value=";
		echo $tid;
		echo ">";
		echo "<input type='submit' name='takeAssign' value='Take Task'>
		</form>";
		}
	
	?>
	<?php  
		if(isset($_POST['takeAssign'])){
		echo "<form action='solsubmit.php' method='POST' enctype='multipart/form-data' class='upload-form' >
		<input type='hidden' name='qid' value='$qid'>
		Sol info/comment:<input type='text' name='solInfo'><br>
		Upload sol : <input type='file' name='files[]' class='upload-file' data-max-size='8388608' multiple >

		<br>
		<input type='submit' name='solSubmit'>
		</form>";
	    }

	?>


</body>
</html>			

<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>

<script>
$(function(){
    var fileInput = $('.upload-file');
    var maxSize = fileInput.data('max-size');
    $('.upload-form').submit(function(e){
        if(fileInput.get(0).files.length<6){
            var fileSize = fileInput.get(0).files[0].size; // in bytes
            if(fileSize>maxSize){
                alert('Error : file size is more then 8MB ');
                return false;
            }else{
                
            }
        }else{
            alert('Files are more than 5');
            return false;
        }

    });
});
    </script>	



