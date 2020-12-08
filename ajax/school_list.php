<?php 
include 'dbcon.php';
$state = $_POST['state'];
$sql = "SELECT * FROM school WHERE state = '$state'";
$result=$conn->query($sql);
$list = array();
while($row = $result->fetch_assoc()){
	$list [] = array(
		'school' => $row['name'],
		'code'	=>$row['code']
	);

}

echo json_encode($list);
?>