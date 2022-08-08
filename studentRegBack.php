<?php 
require_once 'connect.php';
require_once 'verificationEmail.php';
if(isset($_POST['sReg'])){
	$sRef = strtoupper($_POST['sRef']);
	$stmt0 = $conn->query("SELECT sid FROM oneshopy_undolt.sreferral where ref_code = '".$sRef."';");
	$row0=$stmt0->fetch(PDO::FETCH_ASSOC);
	if(!isset($row0['sid'])){
		$rSid=-999;
	}else{

		$rSid = $row0['sid'];
		$sql99 = "update oneshopy_undolt.sreferral set total_ref = total_ref+1 where sid = $rSid;";
		$stmt99 = $conn->prepare($sql99);
		try{
			$stmt99->execute();
		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= studentRegBack.php");
		}
			
	}
	
	$sql = "INSERT INTO oneshopy_undolt.student(sName,sEmail,sContact,sPass,vkey) VALUES(:n,:e,:c,:p,:v)";
	$pass = md5($_POST['sPass']);
	$stmt = $conn->prepare($sql);

	$sql2 = "INSERT INTO oneshopy_undolt.sreferral(sid,ref_code,referral_sid) VALUES(:s,:r,:rs)";
	$stmt2 = $conn->prepare($sql2);
	$vkey = md5(time());
	
	try{
		
	$stmt->execute(
		array(
			':n' => $_POST['sName'], 
			':e' => $_POST['sEmail'],
			':c' => $_POST['sContact'],
			':p' => $pass,
			':v' => $vkey,
		)
	);


	$sEmail = $_POST['sEmail'];

	$stmt = $conn->query("SELECT sid FROM oneshopy_undolt.student where sEmail='$sEmail';");
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

	$ref = getRandomString(3).$row['sid'];
    $stmt2->execute(
		array(
			':s' => $row['sid'], 
			':r' => $ref,
			':rs' => $rSid,
		)
	); 
	
	session_start();

	$_SESSION['Navsid'] = $row['sid'];

	verificationEmail('no_reply@undolt.com','sid',$sEmail,$vkey,'https://abhi.oneshopy.in/verifyAccount.php');

	}catch(PDOException $e){
	myAlert("Already registered user");
	header("refresh:0; url= studentLogin.php");
	exit();
	}

	myAlert("Successfully Submit, we have send you verification email");
	header("refresh:0; url= studentLogin.php");
    exit();
	
}

?>
<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

function getRandomString( $len){
	$char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$str = '';
	for($i=0; $i<$len; $i++){
		$index = rand(0,strlen($char)-1);
		$str .=$char[$index];
	}
	return $str;
}

?>