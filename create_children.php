<?php
session_start();
include 'ajax/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'header.php'; ?>
  <link rel="stylesheet" href="ui/jquery-ui.min.css"/>
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
                                    <h4 class="card-title">Children Information</h4>
                                </div>
                                <div class="card-body">
                                    <form id="form" action="update_children_profile.php" method="post">
                                        <select id="quantity" name="quantity">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                        <div id="main">
                                            

                                        </div>
                                        <input type="submit" class="btn btn-info btn-fill pull-right" value="Add Children">
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
<script src="ui/jquery-ui.min.js"></script>
<script>
$(document).ready(function(){

    $("#quantity").change(function(){
        $("#main").html("");
        var quantity = $("#quantity").val();
        var string = "";
        var a = 1;
        for(var i=0;i<quantity;i++){
        string += "<br/>";
        string += "<h5 class='card-title'>Children "+a+"</h5>";
        string += "<div class=row>";
        string += "<div class=col-md-6>";
        string += "<div class=form-group>";
        string += "<label>Full Name (same as ic)</label>";
        string += "<input name='name"+a+"' type='text' class='form-control' required>";
        string += '</div></div><div class="col-md-6"><div class="form-group"><label>IC Number</label>';
        string += "<input type='number' name='ic"+a+"' class='form-control ic' required onfocusout='testingfunction(this)' >";
        string += '</div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label>School Location</label><br/>';
        string += "<select class='state' id='state"+a+"' required style='padding: 8px 12px;height: 40px;border: 1px solid #E3E3E3;border-radius: 4px;'>";
        string += "<option disabled selected>Select State</option><option value='PERAK'>PERAK</option><option value='SELANGOR'>SELANGOR</option><option value='PAHANG'>PAHANG</option><option value='KELANTAN'>KELANTAN</option><option value='JOHOR'>JOHOR</option><option value='KEDAH'>KEDAH</option><option value='MELAKA'>MELAKA</option><option value='NEGERI SEMBILAN'>NEGERI SEMBILAN</option><option value='PULAU PINANG'>PULAU PINANG</option><option value='PERLIS'>PERLIS</option><option value='TERENGGANU'>TERENGGANU</option><option value='WILAYAH PERSEKUTUAN KUALA LUMPUR'>KUALA LUMPUR</option><option value='WILAYAH PERSEKUTUAN LABUAN'>LABUAN</option><option value='WILAYAH PERSEKUTUAN PUTRAJAYA'>PUTRAJAYA</option><option value='SABAH'>SABAH</option><option value='SARAWAK'>SARAWAK</option></select>";
        string += "</div></div><div class='col-md-6 pl-1'><div class='form-group'><label>School</label><input id='school' type='text' name='school"+a+"' class='form-control school' required disabled='false'>";
        string += "</div></div></div>";
        string += "<div class=row><div id=oku class=col-md-6><div class=form-group><label>OKU</label><br/>";
        string += "<input type='radio' class='r_y' name='oku"+a+"' value='Yes'>Yes <input class='n_y' type='radio' name='oku"+a+"' value='No' checked>No";
        string += "</div></div>";
        string += "<div class=col-md-6><div class=form-group><label>OKU Number</label><br/>";
        string += "<input type='text' name='oku_number"+a+"' class='form-control oku_number' required disabled='false'>";
        string += "</div></div></div>";
        a++;
        }


        $("#main").append(string);

        $(".r_y").click(function(){
             $(this).parent().parent().next().children().children().eq(2).attr("disabled",false);
        });

        $(".n_y").click(function(){
             $(this).parent().parent().next().children().children().eq(2).attr("disabled",true);
        });

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


    }); 
});

function testingfunction(_this)
{
    var ic = _this;
    var len = $(_this).val().length;
    if(len != 12){
       ic.setCustomValidity("Ic number musts in 12 digit");
    }else{
        ic.setCustomValidity("");
    }
}

</script>
                                    
