<?php
include 'ajax/dbcon.php';
session_start();
include 'ajax/session.php';

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

section .section-title {
    text-align: center;
    color: #007b5e;
    margin-bottom: 50px;
    text-transform: uppercase;
}
#tabs h6.section-title{
    color: #eee;
}

#tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 4px solid !important;
    font-size: 20px;
    font-weight: bold;
}
#tabs .nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #eee;
    font-size: 20px;
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
                            <?php include 'ajax/output_notification.php'; ?>
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
                                    <h4 class="card-title">Application Forms</h4>
                                </div>
                                <div class="card-body">
                                    <form action="ajax/upload.php" method="post" enctype="multipart/form-data"> 
										<nav>
											<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
												<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#reason" role="tab" aria-controls="nav-home" aria-selected="true">Reason</a>
												<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#police" role="tab" aria-controls="nav-profile" aria-selected="false">Police Report</a>
												<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#medical" role="tab" aria-controls="nav-contact" aria-selected="false">Medical Report</a>
												<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#other" role="tab" aria-controls="nav-about" aria-selected="false">Other Supporting Document</a>
											</div>
										</nav>
										<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
											<div class="tab-pane fade show active" id="reason" role="tabpanel" aria-labelledby="nav-home-tab">
												<div class="form-group">
											  	<label>Please describle the reason why you apply divorce:</label>
											  	<textarea name="answer" style="height:100%" class="form-control" rows="15" required></textarea>
											</div>
											</div>
											<div class="tab-pane fade" id="police" role="tabpanel" aria-labelledby="nav-profile-tab">
												<label>Please upload your police report (PDF or Images)</label>
												<br/><div><input type="checkbox" id="check_police">I have evidence upload</div><br/>
												<div><input name="police_document[]" id="police_document" type="file" multiple accept="image/*,application/pdf" disabled></div>
											</div>
											<div class="tab-pane fade" id="medical" role="tabpanel" aria-labelledby="nav-contact-tab">
												<label>Please upload your medical report (PDF or Images)</label>
												<br/><div><input type="checkbox" id="check_medical">I have evidence upload</div><br/>
												<div><input name="medical_document[]" id="medical_document" type="file" multiple accept="image/*,application/pdf" disabled></div>
											</div>
											<div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="nav-about-tab">
												<label>Please upload your other supporting document (PDF or Images)</label>
												<br/><div><input type="checkbox" id="check_other">I have evidence upload</div><br/>
												<div><input name="other_document[]" id="other_document" type="file" multiple accept="image/*,application/pdf" disabled></div>
											</div>
										</div>	
										<input class="btn btn-info btn-fill pull-right" type="submit" value="Apply">																											
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
<script src="js/notify.js"></script>
</html>
<script>
$(document).ready(function(){
	$("#check_police").change(function(){
		if(this.checked){
			$("#police_document").attr("disabled",false);
			$("#police_document").attr("required",true);
		}else{
			$("#police_document").attr("disabled",true);
			$("#police_document").attr("required",false);
		}
	});

	$("#check_medical").change(function(){
		if(this.checked){
			$("#medical_document").attr("disabled",false);
			$("#medical_document").attr("required",true);
		}else{
			$("#medical_document").attr("disabled",true);
			$("#medical_document").attr("required",false);
		}
	});

	$("#check_other").change(function(){
		if(this.checked){
			$("#other_document").attr("disabled",false);
			$("#other_document").attr("required",true);
		}else{
			$("#other_document").attr("disabled",true);
			$("#other_document").attr("required",false);


		}
	});
});

</script>