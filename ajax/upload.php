<?php
error_reporting(0);
$dat = getrusage();
$time_start = microtime(true); 
include 'dbcon.php';
session_start();
include 'session.php';

//----------------------------------------------------------
$id = $_SESSION['id'];
$ic = $_SESSION['ic'];
$i = substr($ic,-1);

if($i % 2 == 1){
    $sql = "SELECT * FROM wife WHERE root_id = '$id'";
    $result = $conn->query($sql);
		$row = $result->fetch_assoc();

    $husband = $id;
    $wife = $row['user_id'];
}else if($i % 2 == 0){
    $sql = "SELECT * FROM wife WHERE user_id = '$id'";
    $result = $conn->query($sql);
		$row = $result->fetch_assoc();

    $wife = $id;
    $husband = $row['root_id'];
}

$code = "AP";
	$code .= mt_rand(10000000,99999999);
	$sql = "SELECT * FROM application WHERE id = '$code'";
	$result = $conn->query($sql);

	while($result->num_rows != 0){
		$code = "AP";
		$code .= mt_rand(10000000,99999999);
		$sql = "SELECT * FROM account WHERE id = '$code'";
		$result = $conn->query($sql);
	}
//-------------------------------------------------------------------

$path1 = "";
$path2 = "";
$path3 = "";

if(isset($_FILES['police_document'])){
	for($i=0;$i<count($_FILES['police_document']['name']);$i++){
		$a = $i+1;
		$ext = end(explode('.',$_FILES['police_document']['name'][$i]));
		$name = $id.'('.$a.').'.$ext;
		$target_dir = "../evidence/police/".$name;
		move_uploaded_file($_FILES["police_document"]["tmp_name"][$i], $target_dir);
		$path1 .= $target_dir."*";
	}
}
	
if(isset($_FILES['medical_document'])){
	for($i=0;$i<$medical;$i++){
		$a = $i+1;
		$ext = end(explode('.',$_FILES['medical_document']['name'][$i]));
		$name = $id.'('.$a.').'.$ext;
		$target_dir = "../evidence/medical/".$name;
		move_uploaded_file($_FILES["medical_document"]["tmp_name"][$i], $target_dir);
		$path2 .= $target_dir."*";
	}
}

if(isset($_FILES['other_document'])){
	for($i=0;$i<$other;$i++){
		$a = $i+1;
		$ext = end(explode('.',$_FILES['other_document']['name'][$i]));
		$name = $id.'('.$a.').'.$ext;
		$target_dir = "../evidence/other/".$name;
		move_uploaded_file($_FILES["other_document"]["tmp_name"][$i], $target_dir);
		$path3 .= $target_dir."*";
	}
}

$reason = $_POST['answer'];
$time = date("Y-m-d");
$sql = "INSERT INTO application (id,husband_id,wife_id,reason,police,medical,other,time_apply) VALUES ('$code','$husband','$wife','$reason','$path1','$path2','$path3','$time')"; 
$result = $conn->query($sql);

$time_end = microtime(true);
$execution_time = ($time_end - $time_start)/60;
// echo '<b>Total Execution Time:</b> '.number_format((float) $execution_time, 10).' Mins';

?>
<html>
<head>
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<script src="../assets/js/plugins/chartist.min.js"></script>
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<script src="../assets/js/demo.js"></script>
<script src="../js/notify.js"></script>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
<link href="../assets/css/demo.css" rel="stylesheet" />
</head>
<body>
<div align="center">
	<h4>Message</h4>
	<div id="text2">
		Upload Successful
	</div>
	<div>
		<p id="timer">This page will redirect in 2 seconds.</p>
	</div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
	setTimeout(function(){window.location.href = "../apply.php";},2000);
});

</script>