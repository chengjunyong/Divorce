<?php
error_reporting(0);
include 'ajax/dbcon.php';
//mooodle DB
$servername2 = "220.158.200.140";
$username2 = "myekufun_divorce";
$password2 = "IDOD7sgJaj@7";
$dbname2 = "myekufun_mdiv";
$conn2 = new mysqli($servername2, $username2, $password2, $dbname2);

$name = $_POST['name'];
$name = strtoupper($name);
$ic = $_POST['ic'];
$password = $_POST['pass'];
$p_hash = $_POST['pass'];

$password = md5($password);
$email = $_POST['email'];
$phone = $_POST['phone'];

$generatedhash = password_hash($p_hash, PASSWORD_DEFAULT, ['cost' => 4]);
var_dump($p_hash);
var_dump($generatedhash);
//SSO 
$dataToEncrypt = $_POST['pass'];
$cypherMethod = 'AES-256-CBC';
$key = "divorce";
$encryptedData = openssl_encrypt($dataToEncrypt, $cypherMethod, $key, $options=0);

$id = "MY";
	$id .= mt_rand(100000,999999);
	$sql = "SELECT * FROM account WHERE user_id = '$id'";
	$result = $conn->query($sql);

	while($result->num_rows != 0){
		$id = "MY";
		$id .= mt_rand(100000,999999);
		$sql = "SELECT * FROM account WHERE user_id = '$id'";
		$result = $conn->query($sql);
	}

$sql = "INSERT INTO account (user_id,ic,password,secret) VALUES ('$id','$ic','$password','$encryptedData')";
$conn->query($sql);

$flname = explode(' ',$name,2);

$sqlMoodle = "INSERT INTO mdlqd_user (auth,username,password,firstname,lastname,email,confirmed,mnethostid) VALUES ('manual','$ic','$generatedhash','$flname[0]','$flname[1]','$email',1,1)";
$result = $conn2->query($sqlMoodle);

$identity = substr($ic,-1);

if($identity % 2 == 1){
	$gender = "Male";
	$sql = "INSERT INTO husband (user_id,email,phone,validate,gender,name,ic,link) VALUES ('$id','$email','$phone',0,'$gender','$name','$ic',0)";
}else{
	$gender = "Female";
	$sql = "INSERT INTO wife (user_id,email,phone,validate,gender,name,ic,link) VALUES ('$id','$email','$phone',0,'$gender','$name','$ic',0)";
}

$conn->query($sql);

//Email Notification

$to = $email;
$subject = "Register Successful";
$message = "
<html>
<body>
<h1>Thank you for register our website</h1>
<p>Your can login as your IC number, You member id is (".$id.") Kindly write down your member Id</p>
</body>
</html>

";

$headers .= "Reply-To: Divorce Myekufu <info@myekufu.com>\r\n";
$headers .= "Return-Path: Divorce Myekufu <info@myekufu.com>\r\n";
$headers .= "From: Divorce Myekufu <info@myekufu.com>\r\n";
$headers .= "Organization: Myekufu\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n";

mail($to,$subject,$message,$headers);



header('Location: successful.html');

?>