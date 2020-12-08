<?php
error_reporting(0);
include 'dbcon.php';
session_start();
include 'session.php';

$error = "";

$quan = count($_FILES['police_document']['name']);
$police = $quan;

if($quan != 0){
	if($quan <= 3){
		for($i = 0;$i<$quan;$i++){
			$ext = end(explode('.',$_FILES['police_document']['name'][$i]));
			if($ext == "pdf" || $ext == "jpg" || $ext == "png" || $ext == "jpeg"){
				$error .= "";
			}else{
				$error .="<p>The file your upload is not PDF or Images (Police Report)</p>";
			}
		}
	}else{
		$error .="<p>Exceed maximum files upload 3 (Police Report)</p>";
	}
}else{
	$error .= "";
}

$quan = count($_FILES['medical_document']['name']);
$medical = $quan;
if($quan != 0){
	if($quan <= 3){
		for($i = 0;$i<$quan;$i++){
			$ext = end(explode('.',$_FILES['medical_document']['name'][$i]));
			if($ext == "pdf" || $ext == "jpg" || $ext == "png" || $ext == "jpeg"){
				$error .= "";
			}else{
				$error .="<p>The file your upload is not PDF or Images (Medical Report)</p>";
			}
		}
	}else{
		$error .="<p>Exceed maximum files upload 3 (Medical Report)</p>";
	}
}else{
	$error .= "";
}

$quan = count($_FILES['other_document']['name']);
$other = $quan;
if($quan != 0){
	if($quan <= 3){
		for($i = 0;$i<$quan;$i++){
			$ext = end(explode('.',$_FILES['other_document']['name'][$i]));
			if($ext == "pdf" || $ext == "jpg" || $ext == "png" || $ext == "jpeg"){
				$error .= "";
			}else{
				$error .="<p>The file your upload is not PDF or Images (Other Supporting Document)</p>";
			}
		}
	}else{
		$error .="<p>Exceed maximum files upload 3 (Other Supporting Document)</p>";
	}
}else{
	$error .= "";
}

if($error == ""){

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

	if($police == 0){
		$path1 = "";
	}else{
		for($i=0;$i<$police;$i++){
			$a = $i+1;
			$ext = end(explode('.',$_FILES['police_document']['name'][$i]));
			$name = $id.'('.$a.').'.$ext;
			$target_dir = "../evidence/police/".$name;
			var_dump($target_dir);
			move_uploaded_file($_FILES["police_document"]["tmp_name"][$i], $target_dir);
			$path1 .= $target_dir."/";
		}
	}

	if($medical == 0){
		$path2 = "";
	}else{
		for($i=0;$i<$medical;$i++){
			$a = $i+1;
			$ext = end(explode('.',$_FILES['medical_document']['name'][$i]));
			$name = $id.'('.$a.').'.$ext;
			$target_dir = "../evidence/medical/".$name;
			var_dump($target_dir);
			move_uploaded_file($_FILES["medical_document"]["tmp_name"][$i], $target_dir);
			$path2 .= $target_dir."/";
		}
	}

	if($other == 0){
		$path3 = "";		
	}else{
		for($i=0;$i<$other;$i++){
			$a = $i+1;
			$ext = end(explode('.',$_FILES['other_document']['name'][$i]));
			$name = $id.'('.$a.').'.$ext;
			$target_dir = "../evidence/other/".$name;
			move_uploaded_file($_FILES["other_document"]["tmp_name"][$i], $target_dir);
			$path3 .= $target_dir."/";
		}
	}

	$reason = $_POST['answer'];
	$time = date("Y-m-d");
	$sql = "INSERT INTO application (id,husband_id,wife_id,reason,police,medical,other,time_apply) VALUES ('$code','$husband','$wife','$reason','$path1','$path2','$path3','$time')"; 
	$result = $conn->query($sql);

}else{

}

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
	</div>
	<div>
		<p id="timer"></p>
	</div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
	var a = "<?php echo $error ?>";
	if(a == ""){
		$("#text2").text("Upload Successful");
	}else{
		a += "<p>Please Upload Again</p>"
		$("#text2").html(a);
	}
});

var count = 3;
function countDown() {
    if (count > 0) {
      count--;
      $("#timer").text("This page will redirect in " + count + " seconds."); // Timer Message
      setTimeout("countDown()", 1000);
    } else {
      window.location.href = "../apply.php";
    }
}

countDown();


</script>