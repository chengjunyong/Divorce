<?php
include 'ajax/dbcon.php';
$ic = $_POST['ic'];
$pass = $_POST['pass'];
$pass = md5($pass);

$sql = "SELECT * FROM account WHERE ic = '$ic' AND password = '$pass'";
$result = $conn->query($sql);
if($result->num_rows != 0){
	$row = $result->fetch_assoc();
	$ic = $row['ic'];
	$id = $row['user_id'];
	session_start();
	$_SESSION['ic'] = $ic;
	$_SESSION['id'] = $id;
	header('Location: main.php');

}else{
	header('Location: index.html');
}

?>