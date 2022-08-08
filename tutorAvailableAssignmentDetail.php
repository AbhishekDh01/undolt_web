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
	<h3>Assignment files</h3>

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

	  
	 	<?php  

	 	if($row['aStatus']=='Solved and in Review'){

			if(!isset($_POST['uploadNew'])){

				echo "<h3>sol Info : ".$row['solInfo']." </h3>";
				  echo "<h3>sol files:</h3>";
				  $solDir='solutions/T'.$tid."/";
				  $i=1;
				  $name='sol'.$i;
				  while ($row[$name]) {
						echo "<a style='margin-left:2.5em' target='_blank' href='$solDir$row[$name]'>File $i</a>";
						$i++;
						$name='sol'.$i;
						if($i==6) break;
					 
					}
				echo '<br><br>';

				echo "<form action='' method='POST'>
				<input type='hidden' name='qid' value=";
				echo $qid;
				echo  ">";
				echo "<input type='submit' name='uploadNew' value='Upload new solution'>
				</form>";
			}

		}

	?>

	<br>
	<br>

	<?php  
 
		if($row['aStatus']=='Accepted by Tutor' && !isset($_POST['uploadNew'])){
			echo "<form action='solsubmit.php' method='POST' enctype='multipart/form-data' class='upload-form' >
			<input type='hidden' name='qid' value='$qid'>
			Sol info/comment:<input type='text' name='solInfo'><br>
			Upload sol : <input type='file' name='files[]' class='upload-file' data-max-size='8388608' multiple >

			<br>
			<input type='submit' name='solSubmit'>
			</form>";
		}

		if(isset($_POST['uploadNew'])){

			$sdir='solutions/T'.$tid."/";

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

				$sql8 = "update oneshopy_undolt.assignment set aStatus = 'Accepted by Tutor' where qid = $qid;";
				$sql9 = "update oneshopy_undolt.assignment set sol1 = '' where qid = $qid;";
				$sql10 = "update oneshopy_undolt.assignment set sol2 = '' where qid = $qid;";
				$sql11 = "update oneshopy_undolt.assignment set sol3 = '' where qid = $qid;";
				$sql12 = "update oneshopy_undolt.assignment set sol4 = '' where qid = $qid;";
				$sql13 = "update oneshopy_undolt.assignment set sol5 = '' where qid = $qid;";
				$sql14 = "update oneshopy_undolt.assignment set solInfo = '' where qid = $qid;";

				$stmt8 = $conn->prepare($sql8);
				$stmt9 = $conn->prepare($sql9);
				$stmt10 = $conn->prepare($sql10);
				$stmt11 = $conn->prepare($sql11);
				$stmt12 = $conn->prepare($sql12);
				$stmt13 = $conn->prepare($sql13);
				$stmt14 = $conn->prepare($sql14);
				
				try{
					$stmt8->execute();
					$stmt9->execute();
					$stmt10->execute();
					$stmt11->execute();
					$stmt12->execute();
					$stmt13->execute();
					$stmt14->execute();

				}catch(PDOException $e){
					myAlert("Internal Error, Contact Manager");
				}



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

