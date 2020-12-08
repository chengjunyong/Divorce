<?php 
error_reporting(1);
session_start();
$id = $_SESSION['id'];
include 'ajax/dbcon.php';

$sql = "SELECT * FROM account WHERE user_id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_array();
$password = $row['secret'];

$cypherMethod = 'AES-256-CBC';
$key = "divorce";
$decryptedData = openssl_decrypt($password, $cypherMethod, $key, $options=0);

?>
<body hidden>
<form id="test" action="https://mdivorce.myekufu.net/login/index.php" method="post">
<input type="text" name="username" value="<?php echo $row['ic']; ?>">
<input type="password" name="password" value="<?php echo $decryptedData; ?>">
<input type="submit" value="submit">
</form>
</body>
<script>
	document.getElementById("test").submit();
</script>