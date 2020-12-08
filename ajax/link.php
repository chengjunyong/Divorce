<?php 
include 'dbcon.php';
session_start();
$request = $_SESSION['id'];
$ic = $_SESSION['ic'];
$i = substr($ic,-1);
$target = $_POST['target'];

if($i % 2 == 1){//male
	$sql = "UPDATE wife SET request = '$request' WHERE ic = '$target'";
}else{//female
	$sql = "UPDATE husband SET request = '$request' WHERE ic = '$target'";
}

if($result = $conn->query($sql)){
	echo true;
}else{
	echo false;
}
?>