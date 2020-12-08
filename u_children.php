<?php
include 'ajax/dbcon.php';
session_start();
$ic = $_SESSION['ic'];
$i = substr($ic,-1);
$a = 1;
if($i % 2 == 1){
    $sql = "SELECT user_id FROM husband WHERE ic = '$ic'";
    $result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$id = $row['user_id'];

}else if($i % 2 == 0){
    $sql = "SELECT * FROM wife WHERE ic = '$ic'";
    $result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$id = $row['root_id'];
}

$sql = "SELECT * FROM children WHERE root_id = '$id'";
$result = $conn->query($sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php'; ?>
</head>
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
                            <?php include 'ajax/output_notification.php';?>
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
                                    <h4 class="card-title">Update Children Information</h4>
                                </div>
                                <div class="card-body">
                                    <form id="children" name="children" action="ajax/update_children.php" method="post">
                                     	<?php while($row = $result->fetch_assoc()){
                                        if($row['oku'] == 1){
                                            $p1 = "checked";
                                            $p2 = "";
                                            $d = "" ;
                                        }else{
                                            $p1 = "";
                                            $p2 = "checked";
                                            $d = "disabled";
                                        }

                                        echo'
                                     	<h5 class="card-title">Children '.$a.'</h5><br/>
                                        <input name="children_id'.$a.'" type="text" value="'.$row['children_id'].'" hidden>
                                     	<div class="row">                                   		
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Full Name (same as ic)</label>
                                                    <input id="name" name="name'.$a.'" type="text" class="form-control" value="'.$row['name'].'" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>IC Number</label>
                                                    <input type="text" id="ic" name="ic'.$a.'" class="form-control" value="'.$row['ic'].'">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>School Location</label><br/>
                                                    <select class="state" id="state"'.$a.'" required style="padding: 8px 12px;height: 40px;border: 1px solid #E3E3E3;border-radius: 4px">;
	                                                    <option disabled selected>Select State</option>
	                                                    <option value="PERAK">PERAK</option>
	                                                    <option value="SELANGOR">SELANGOR</option>
	                                                    <option value="PAHANG">PAHANG</option>
	                                                    <option value="KELANTAN">KELANTAN</option>
	                                                    <option value="JOHOR">JOHOR</option>
	                                                    <option value="KEDAH">KEDAH</option>
	                                                    <option value="MELAKA">MELAKA</option>
	                                                    <option value="NEGERI SEMBILAN">NEGERI SEMBILAN</option>
	                                                    <option value="PULAU PINANG">PULAU PINANG</option>
	                                                    <option value="PERLIS">PERLIS</option>
	                                                    <option value="TERENGGANU">TERENGGANU</option>
	                                                    <option value="WILAYAH PERSEKUTUAN KUALA LUMPUR">KUALA LUMPUR</option>
	                                                    <option value="WILAYAH PERSEKUTUAN LABUAN">LABUAN</option>
	                                                    <option value="WILAYAH PERSEKUTUAN PUTRAJAYA">PUTRAJAYA</option>
	                                                    <option value="SABAH">SABAH</option>
	                                                    <option value="SARAWAK">SARAWAK</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>School</label>
                                                    <input type="text" id="school" name="school'.$a.'" class="form-control school" value="'.$row['school'].'" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-3">
                                                <div class="form-group">
                                                    <label>OKU</label><br/>
                                                    <input type="radio" class="y_b" name="oku'.$a.'" value="Yes" '.$p1.'>Yes <input class="n_b" type="radio" name="oku'.$a.'" value="No" '.$p2.'>No
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>OKU Number</label><br/>
                                                    <input type="text" class="form-control" name="oku_number'.$a.'" value="'.$row['oku_number'].'" '.$d.'>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        ';$a++;} $a--; echo'<input name="quantity" value="'.$a.'" hidden>'; ?>
                                            

                                        
                                        <input type="submit" class="btn btn-info btn-fill pull-right" value="Update Children">
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
    </div>
</body>
</html>
<script>
$(document).ready(function(){
	$(".state").change(function(){
        var list = [];
        var state = $(this).val();
        $(this).parent().parent().next().children().children().eq(1).attr("disabled",false);
        $.post("ajax/school_list.php",
        {
            state : state

        },function(data){       
            for(var i in data){
                list.push(data[i].school);
            }       
        },"json");

         $(".school").autocomplete({
            source: list
        });
    });

    $(".y_b").click(function(){
        $(this).parent().parent().next().children().children().eq(2).attr("disabled",false);
    });

    $(".n_b").click(function(){
        $(this).parent().parent().next().children().children().eq(2).attr("disabled",true);
    });
});


</script>