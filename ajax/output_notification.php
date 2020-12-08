<?php 
include 'dbcon.php';
$ic = $_SESSION['ic'];
$i = substr($ic,-1);

if($i % 2 == 1){//male
	$sql3 = "SELECT request FROM husband WHERE ic = '$ic'";
}else{//female
	$sql3 = "SELECT request FROM wife WHERE ic = '$ic'";
}

$result3 = $conn->query($sql3);
$row3 = $result3->fetch_assoc();
if($row3['request'] != ""){

	$target = $row3['request'];

	if($i % 2 == 1){//male
		$sql3 = "SELECT * FROM wife WHERE user_id = '$target'";
	}else{//female
		$sql3 = "SELECT * FROM husband WHERE user_id = '$target'";
	}
	$result3 = $conn->query($sql3);
	$row3 = $result3->fetch_assoc();

	echo '<div class="popup">
			<h6 align="center">Notification</h6>
			<p id="out">('.$row3['name'].') has request you as spouse.
			<br/><br/>Please make sure the name before accept the request</p>
			<div id="btn"><button value='.$target.' id="accept">Accept</button><button value='.$target.' id="reject">Reject</button></div>
		</div>';

	echo '<style>.popup { text-align:center;position: fixed; left: 50%; top: 50px; transform: translate(-50%, 0%); width: 40%; background: #ccc;padding: 10px; border-radius: 3px;z-index:1 } button {margin-right:5px;}</style>';
	echo '<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
		<script>
			function remove(){
				$(".popup").remove();
			}

			$("#accept").click(function(){
				$("#btn").remove();
				var n_id = $(this).attr("value");
				$.post("ajax/notify.php",
				{
					type : "link",
                    value : n_id

					},function(data){
						if(data == true){
                                $("#out").text("Relation establish Successful");
                                setTimeout(remove, 2500);

                            }else{
                            	$("#out").text("Relation establish unsuccessful, please try again later");
                                setTimeout(remove, 2500);                         
                            }

						},"html");
				});

			$("#reject").click(function(){
				$("#btn").remove();
				var n_id = $(this).attr("value");
				$.post("ajax/notify.php",
				{
					type : "reject",
                    value : n_id

					},function(data){
						if(data == true){
                                $("#out").text("Relation cancel Successful");
                                setTimeout(remove, 2500);

                            }else{
                            	$("#out").text("Relation cancel unsuccessful, please try again later");
                                setTimeout(remove, 2500);                         
                            }

						},"html");
				});

		</script>';
}

?>