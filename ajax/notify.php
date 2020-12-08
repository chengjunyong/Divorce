<?php 
include 'dbcon.php';
session_start();
$id = $_SESSION['id'];
$type = $_POST['type'];
$ic = $_SESSION['ic'];
$i = substr($ic,-1);
$value = $_POST['value'];

if($type == "reject"){
	if($i % 2 == 1){//male
		$sql = "UPDATE husband SET request = '' WHERE user_id = '$id'";
	}else{//female
		$sql = "UPDATE wife SET request = '' WHERE user_id = '$id'";
	}

	if($result = $conn->query($sql)){
		echo true;
	}else{
		echo false;
	}





}else if($type="link"){
	if($i % 2 == 1){//male
		$sql = "UPDATE husband SET link=1, request='' WHERE ic = '$ic'";
		$sql2 = "UPDATE wife SET root_id = '$id',link=1,request='' WHERE user_id = '$value'";

		if($conn->query($sql) && $conn->query($sql2)){
			echo true;
		}

	}else{//female
		$sql = "UPDATE wife SET link=1, request='',root_id= '$value' WHERE ic = '$ic'";
		$sql2 = "UPDATE husband SET link=1,request='' WHERE user_id = '$value'";
		

		if($conn->query($sql) && $conn->query($sql2)){
			echo true;
		}
		
	}
}

?>