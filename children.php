<?php
error_reporting(0);
include 'ajax/dbcon.php';
include 'header.php';
session_start();
$ic = $_SESSION['ic'];
$i = substr($ic,-1);
if($i % 2 == 1){
    $sql = "SELECT children,link FROM husband WHERE ic = '$ic'";
}else if($i % 2 == 0){
    $sql = "SELECT children,link FROM wife WHERE ic = '$ic'";
}
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if($row['children'] != 1 || $row['link'] != 1){
    // echo "<script>

    // if(confirm('Please make sure your profile is complete ( approvement from your spouse ) before update your children information')){
    //     window.location.assign('user.php');
    // }else{
    //     window.location.assign('user.php');
    // }
    // </script>";

    echo "
    <body>
    <div align='center'>
        <h4>Message</h4>
        <div id='text2'>
            Please make sure your profile is complete ( approvement from your spouse ) before update your children information
        </div>
        <div>
            <p id='timer'></p>
        </div>
    </div>
    </body>
    ";

}else{
    header('Location: create_children.php');
}

?>
<script>
var count = 5;
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