<?php
include 'ajax/dbcon.php';
session_start();
include 'ajax/session.php';
$ic = $_SESSION['ic'];
$i = substr($ic,-1);
if($i % 2 == 1){
    $sql = "SELECT * FROM husband WHERE ic = '$ic'";
}else if($i % 2 == 0){
    $sql = "SELECT * FROM wife WHERE ic = '$ic'";
}
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php'; ?>
</head>
<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

</style>
<body>
    <div class="wrapper">
        <div class="sidebar" data-image="assets/img/1.jpg" data-color="blue">
            <div class="sidebar-wrapper">
                <div class="logo">
                    Menu
                </div>
                <?php include 'nav.php'; ?>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand"> User Profile </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav ml-auto">
                           
                             <li class="nav-item">
                                <a class="nav-link" href="logout.php">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <form action="update.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12 pr-1">
                                                <div class="form-group">
                                                    <div><?php if($row['profile_path'] != ""){
                                                        echo "<img src=".$row['profile_path']." height=20% width=20%>";
                                                    }
                                                    ?></div>
                                                    <input type="text" hidden name="profile_path" value="<?php echo $row['profile_path']; ?>">                                                  
                                                    <label>Upload Profile Picturer</label><br/>
                                                    <input name="profile" type="file" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Full Name (same as ic)</label>
                                                    <input id="name" name="name" type="text" class="form-control" value="<?php echo $row['name']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>IC Number</label>
                                                    <input type="text" id="ic" name="ic" class="form-control" value="<?php echo $row['ic']; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>E-mail</label>
                                                    <input type="text" id="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $row['phone']; ?>" required minlength="10" maxlength="11">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" name="city" class="form-control" value="<?php echo $row['city']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" name="state" class="form-control" value="<?php echo $row['state']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>Postal Code</label>
                                                    <input type="number" name="poscode" class="form-control" value="<?php echo $row['poscode']; ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div>Do you have any children ?</div>
                                        <div style="font-size: 16px"><input type="radio" name="children" value="0" <?php if($row['children'] == 0)echo 'checked '?>> No <input type="radio" id="yes" name="children" value="1" <?php if($row['children'] == 1)echo 'checked '?>> Yes 
                                        </div>

                                        <div class="card-header" style="padding:15px 0px 0;">
                                            <h4 class="card-title">Spouse Infomation</h4><br/>
                                        </div>                                                        
                                        <div id="check" class="row">
                                            <div class="col-md-11 pr-1">
                                                <input id="target_value" type="number" placeholder="e.g. 851011051123"> <input type="button" value="Search" id="search"><br/><br/>
                                                <label id="spouse_name">Is your spouse already registered ? Key in your spouse ic-number to find their information</label>
                                            </div>                                          
                                        </div>  
                                        <div id="box"></div>  
                                        <div id="button"></div>                                                          
                                        <input type="submit" class="btn btn-info btn-fill pull-right" value="Update Profile">
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="main.php">
                                    Home
                                </a>
                            </li>
                        </ul>
                        <?php include 'footer.php'; ?>
                    </nav>
                </div>
            </footer>
        </div>
         <?php include 'ajax/output_notification.php'; ?>
    </div>
</body>
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="text2">
        Testing
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</html>
<script>
$(document).ready(function(){

    $("#s_ic").change(function(){
        var s_ic = document.getElementById("s_ic");
        var value = s_ic.value;
        var len = $("#s_ic").val().length;
        if(len != 12){
            s_ic.setCustomValidity("Ic number musts in 12 digit");
        }else{
            s_ic.setCustomValidity("");
        }
    });

    $("#email,#s_email").change(function(){
        var email = document.getElementById("email");
        var s_email = document.getElementById("s_email");
        var e_value = email.value;
        var s_e_value = s_email.value;

        if(/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e_value)){
            email.setCustomValidity("");
        }else{
            email.setCustomValidity("Not Valid Email");
        }

        if(/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(s_e_value)){
            s_email.setCustomValidity("");
        }else{
            s_email.setCustomValidity("Not Valid Email");
        }
    });

    $("#phone,#s_phone").change(function(){
        var phone = document.getElementById("phone");
        var s_phone = document.getElementById("s_phone");
        var p_value = phone.value;
        var s_p_value = s_phone.value;
        if(/^\d*$/.test(p_value)){
            phone.setCustomValidity("");
        }else{
            phone.setCustomValidity("Not Valid Phone Number");
        }

        if(/^\d*$/.test(s_p_value)){
            s_phone.setCustomValidity("");
        }else{
            s_phone.setCustomValidity("Not Valid Phone Number");
        }
    });


    $("#search").click(function(){
        var target = $("#target_value").val();
        $.post("ajax/search.php",
        {
           target : target
        },
        function(data)
        {
            if(data != false){
                var text = 'This ic number is belong to ( ' + data + ' ). \nAre you sure this person is your spouse ?';
                $("#spouse_name").text(text);
                $("#box").html("");
                $("#button").html("");
                $("#box").append("<input type=checkbox id='s_con'> <label id=text1> Yes<label>");
                $("#button").append("<input type=button onclick=link() value=Confirm>");
            }else{
                $("#spouse_name").text("This ic number is not exists in our database");
                $("#box").html("");
                $("#button").html("");
            }
        },
        "html");

    });

});

function link(){
	var target = $("#target_value").val();
	if($("#s_con").prop("checked")){
		$.post("ajax/link.php",
		{
	        target : target
	    },
	    function(data)
	    {
	        if(data){
	            $("#text2").text("Notify successful, waiting for approve");
	            $("#modal1").modal("toggle");
	        }else{
	        	$("#text2").text("Notify unseccessful please try again later");
	        	$("#modal1").modal("toggle");
	        }
	    },"html");
	}else{
		$("#text1").text("Yes (Please check this before click confirm button)");
	}
}


</script>