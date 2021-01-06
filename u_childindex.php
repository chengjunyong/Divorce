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

<style>
table,th,td {
  border:1px solid black;
}

th {
  height: 50px;
}

td{
  height: 50px;
  padding: 1 40px;
}

.fa-pen-square {
  color:#F6F819   ;
  padding-right: 0.5em ;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php'; ?>
    <script src="https://kit.fontawesome.com/55790beaee.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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

                                        ?>

                                      
                                       
 <table id="example" class="display" style="border:1px solid black;margin-left:auto;margin-right:auto;">
  

        <thead>
            <tr>
                <th>No </th>
                <th>Children ID</th>
                <th>Children Name</th>
                <th>Action</th>     
            </tr>
        </thead>

        <?php
          $a = 1;

                                       echo "<tr>"
            . "<td>".$a."</td>"
                       . "<td>".$row['children_id']."</td>"
                       . "<td>".$row['name']."</td>";
                                        
                                



                                        ?>


                                         <td><form action="" method="POST">
                    <i class="fas fa-pen-square fa-2x"  onclick="location.href='u_children.php?name=<?=$row['name']?>'"></i>
              

                                        </form></td>

                                           <?php
                     ;$a++;} $a--; echo'<input name="quantity" value="'.$a.'" hidden>'; 
             echo "</tr>";
             
            
            ?>
        </table>
           
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
