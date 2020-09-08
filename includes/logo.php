<?php 

/********************************************
* File Name: logo.php 						*
* Author: Ammar S.A.A 						*
* Output: Library Logo & Log-Out Button 	*
********************************************/

?>

<body>
	<div class="wrapper">
		<div class="container">
			<section id="header">
				<div class="row">
					<div class="col">
						<div class="logo">
							<!--Library Logo-->
							<img class="logo" src="images/logo_museebat_transparent.png" alt="Library Logo"/>
						</div>
					</div>
					<div class="col-sm-12 col-md-3">
						<div class="logout-btn pt-4 py-4 pull-right">
							<!--Log Me Out Button-->
							<?php if(isset($_SESSION['user_name'])){?>
							<button class="btn btn-danger text-light" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="glyphicon glyphicon-log-out"></span> Log Out</button>
							<!--Logout Confirmation-->
							<div class="modal in bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
   								 <div class="modal-dialog modal-sm">
       								 <div class="modal-content">
           								 <div class="modal-header">
                							<h4><i class="glyphicon glyphicon-lock"></i> Logout</h4>
            							</div>
            						<div class="modal-body"><i class="glyphicon glyphicon-question-sign"></i> Are you sure you want to log-out?</div>
           							<div class="modal-footer">
           								<div class="btn-block btn-group-justified">
	           								<a href="javascript:window.location.href = '<?php echo WEBSITE_URL.'logout.php' ?>'" class="btn btn-outline-dark">Logout</a>
           								</div>
           							</div>
        							</div>
    							</div>
							</div>
						<?php }?>
						</div>
					</div>
				</div>