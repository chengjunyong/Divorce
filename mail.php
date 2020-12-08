<?php

$to = "junyong1213@hotmail.com";
$subject = "Testing";
$txt = "Success Register!";
$headers = "From: testing@myekufu.net";

if(mail($to,$subject,$txt,$headers)){
    echo "Success";
}else{
    echo "Fail";
}

?>