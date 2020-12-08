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

<?php 
error_reporting(0);
include 'dbcon.php';
$quantity = $_POST['quantity'];
$children_id = [];
$name = [];
$ic = [];
$school = [];
$oku = [];
$oku_number = [];
$a = 1;
$str = array('name','ic','school','oku','oku_number','children_id');



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
	$b = $str[5]."$a";
	$children_id[] = $_POST[$b];
	$a++;

	if($oku[$i] == 'Yes')
		$ok = 1;
	else
		$ok = 0;

	$sql = "UPDATE children SET name='$name[$i]',school='$school[$i]',oku='$ok',oku_number='$oku_number[$i]',ic='$ic[$i]' WHERE children_id='$children_id[$i]'";
	$success = 0;
	if($result = $conn->query($sql)){
		
	}else{
		$success++;
	}
}
	if($success == 0)
		$answer = true;
	else
		$answer = false;
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
		$("#text2").text("Update Successful");
	}else{
		$("#text2").text("Update Failure");
	}

});

var count = 3;
function countDown() {
    if (count > 0) {
      count--;
      $("#timer").text("This page will redirect in " + count + " seconds."); // Timer Message
      setTimeout("countDown()", 1000);
    } else {
      window.location.href = "../u_children.php";
    }
}

countDown();

</script>