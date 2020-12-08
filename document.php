<?php 
include 'ajax/dbcon.php';
error_reporting(0);
session_start();
$ic = $_SESSION['ic'];
$i = substr($ic,-1);
if($i % 2 == 1){
    $sql = "SELECT file FROM husband WHERE ic = '$ic'";
}else if($i % 2 == 0){
    $sql = "SELECT file FROM wife WHERE ic = '$ic'";
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
                    <a class="navbar-brand"> Document Management </a>
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
                                    <h4 class="card-title">Upload Document</h4>
                                </div>
                                <div class="card-body">
                                    <form id="form" action="ajax/upload.php" method="post" enctype="multipart/form-data">
                                        <div id="main">
                                            <h5>Your IC Photo</h5>
                                            <div>
                                                <input type="file" name="ic_photo"><br/><br/>
                                                <?php
                                                    if(!empty($row['file'])){
                                                        $name = explode("/",$row['file']);
                                                        $str = '<a href='.$row['file'].'>'.$name[1].'</a>';

                                                        echo $str;
                                                    }else{
                                                        echo "No Yet Upload";
                                                    }
                                                ?>
                                            </div>
                                        </div>
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
    </div>
</body>
</html>