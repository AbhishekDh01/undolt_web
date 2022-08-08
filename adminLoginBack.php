<?php
  require_once 'connect.php';
  if(isset($_POST['aLogin'])){
  		$sql = "SELECT * from oneshopy_undolt.admin where aEmail = :e";
		$pass = $_POST['aPass'];
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':e',$_POST['aEmail']);
		$stmt->execute();

		if($stmt->rowCount()>0){
			$getRow = $stmt->fetch(PDO::FETCH_ASSOC);
					if($getRow['aPass']==$pass)
					{
						
						myAlert("Login Successfully");
						$aEmail = $_POST['aEmail'];
						$stmt = $conn->query("SELECT aid FROM oneshopy_undolt.admin where aEmail='$aEmail';");
						$row=$stmt->fetch(PDO::FETCH_ASSOC);
		
						session_start();

						$_SESSION['navAid'] = $row['aid'];
						header("refresh:0; url= adminDash.php");
						
					}
					else
					{
						myAlert("Password is incorrect");
						header("refresh:0; url= adminLogin.php");
					}
		}
		else{
		myAlert("User does not exists");
		header("refresh:0; url= adminLogin.php");
		}	
}
?>
<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>