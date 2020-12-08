<?php 
include 'dbcon.php';
session_start();
$ic = $_SESSION['ic'];
$i = substr($ic,-1);
$target = $_POST['target'];

if($i % 2 == 1){//male
	$sql = "SELECT * FROM wife WHERE ic = '$target'";
}else{//female
	$sql = "SELECT * FROM husband WHERE ic = '$target'";
}

$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($result->num_rows > 0){
	$text1 = substr($row['name'],-5);
	$text2 =  substr($row['name'],0,5);
	echo $text2." xxxxxxxxx ".$text1;

}else{
	echo false;
}

?>