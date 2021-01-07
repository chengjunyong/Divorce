<html>
<head>
	<?php include 'header.php'; ?>
</head>

<?php 
error_reporting(0);
$answer = 0;
include 'ajax/dbcon.php';
session_start();
$ic = $_SESSION['ic'];
$i = substr($ic,-1);
if($i % 2 == 1){
    $sql = "SELECT * FROM husband WHERE ic = '$ic'";
    $result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$id = $row['user_id'];

}else if($i % 2 == 0){
    $sql = "SELECT * FROM wife WHERE ic = '$ic'";
    $result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$id = $row['root_id'];
}

$quantity = $_POST['quantity'];
$name = [];
$ic = [];
$school = [];
$oku = [];
$oku_number = [];
$a = 1;
$str = array('name','ic','school','oku','oku_number');



for($i=0;$i<$quantity;$i++){
	$b = $str[0]."$a";
	$name[] = $_POST[$b];
	$b = $str[1]."$a";
	$ic[] = $_POST[$b];
	$b = $str[2]."$a";
	$school[] = $_POST[$b];
	$b = $str[3]."$a";
	$oku[] = $_POST[$b];
	$b = $str[4]."$a";
	$oku_number[] = $_POST[$b];
	$a++;

	$children_id = "CHR";
	$children_id .= mt_rand(100000,999999);
	$sql = "SELECT * FROM children WHERE children_id = '$children_id'";
	$result = $conn->query($sql);

	while($result->num_rows != 0){
		$children_id = "CHR";
		$children_id .= mt_rand(100000,999999);
		$sql = "SELECT * FROM children WHERE children_id = '$children_id'";
		$result = $conn->query($sql);
	}

	$gender = substr($ic[$i],-1);
	if($gender % 2 == 1)
		$gender = "Male";
	else
		$gender = "Female";

	if($oku[$i] == 'Yes')
		$ok = 1;
	else
		$ok = 0;

	$sql = "INSERT INTO children (root_id,children_id,name,ic,school,oku,oku_number) VALUES ('$id','$children_id','$name[$i]','$ic[$i]','$school[$i]','$ok','$oku_number[$i]')";
	if($result = $conn->query($sql)){
		$answer = 1;
	}else{
		$answer = 0;
	}
}

?>
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
	var a = <?php echo $answer ?>;
	if(a){
		$("#text2").text("Create Successful");
	}else{
		$("#text2").text("Create Failure");
	}
});


var count = 3;
function countDown() {
    if (count > 0) {
      count--;
      $("#timer").text("This page will redirect in " + count + " seconds."); // Timer Message
      setTimeout("countDown()", 1000);
    } else {
      window.location.href = "u_childindex.php";
    }
}

countDown();
</script>
