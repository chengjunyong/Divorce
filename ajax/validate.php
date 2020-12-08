<?php
include 'dbcon.php';
$ic = $_POST['ic'];
$sql = "SELECT * FROM account WHERE ic = '$ic'";
$result = $conn->query($sql);

echo $result->num_rows;

?>