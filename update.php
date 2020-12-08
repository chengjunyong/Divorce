<html>
<head>
  <?php include 'header.php'; ?>
</head>

<?php
error_reporting(0);
include 'ajax/dbcon.php';
session_start();
$current = $_SESSION['ic'];
$user_id = $_SESSION['id'];
$i = substr($current,-1);
$name = $_POST['name'];
$name = strtoupper($name);
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$poscode = $_POST['poscode'];
$children = $_POST['children'];

if($_FILES['profile']['name'] != ""){
  $ext = end(explode('.',$_FILES['profile']['name']));
  $path = $user_id.'.'.$ext;
  $target_dir = "photo/".$path;
  $path = $target_dir;
  move_uploaded_file($_FILES["profile"]["tmp_name"], $target_dir);
}else{
  $path = $_POST['profile_path'];
}

//Inside User Profile

if($i % 2 == 1){ //Male Profile
	$sql = "UPDATE husband SET name='$name',email='$email',phone='$phone',address='$address',city='$city',state='$state',poscode='$poscode',children='$children',profile_path='$path' WHERE ic='$current'";

}else{ //Female Profile
	$sql = "UPDATE wife SET name='$name',email='$email',phone='$phone',address='$address',city='$city',state='$state',poscode='$poscode',children='$children',profile_path='$path' WHERE ic='$current'";

}

if($result = $conn->query($sql)){
	$answer = true;
}else{
	$answer = false;
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
      window.location.href = "user.php";
    }
}
countDown();

</script>