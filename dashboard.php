<?php

/********************************
* File Name: dashboard.php 		*
* Author: Ammar S.A.A 			*
* Output: User/Admin dashboard 	*
********************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');

//Getting things out from session query
$sql_select = "SELECT * FROM tblusers WHERE user_name = '{$_SESSION['user_name']}' ";
    
	$sql = $conn->query($sql_select);

	while($row = mysqli_fetch_array($sql)) {
    
		$user_id 				= $row['id'];
		$full_name 				= $row['full_name'];
		$email_id 				= $row['email_id'];
		$user_name 				= $row['user_name'];
		$password 				= $row['password'];
		$mobile_no 				= $row['mobile_no'];
		$status 				= $row['status'];
		$profile_picture 		= $row['profile_picture'];
		$reg_date 				= $row['reg_date'];
		$updation_date 			= $row['updation_date'];
    }
?>

			<section id="content">
				<div class="page-wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col">
								<h4><?php echo "<span class=text-capitalize>".$_SESSION['user_name']."</span>" ?>'s Dashboard<hr/></h4>
							</div>
						</div>
						<?php if (IfIsUser($conn)) { ?>
							<div class="row">
								<div class="col col-sm-12 center-block">
									<div class="container-fluid p-3 my-3 text-white">
									<!--Slider Start-->
									<?php   include WEBSITE_PATH. './includes/slider.php'; ?>    
									<!--Slider End-->
									</div>
								</div>
							</div>
						<?php } ?>
						<div class="row card-group">
							<div class="col-sm-12 col-md-3">
								<div class="panel bg-success">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<span class="display-1 glyphicon glyphicon-book"></span>
											</div>
											<div class="col-xs-9 text-right">
	                    						<h4 class="h4 text-truncate text-nowrap">Books</h4>
												<h5 class='h5'>
													<?php 

														$books = GetTotal($conn, TBLBOOKS);

														echo $books;

													?>
												</h5>
	                    					</div>
										</div>
									</div>
									<a class="text-success" href="<?php echo WEBSITE_URL; ?>./book_list.php">
							            <div class="panel-footer">
							                <span class="pull-left">View Details</span>
							                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                <div class="clearfix"></div>
							            </div>
							        </a>
								</div>
							</div>
							<div class="col-sm-12 col-md-3">
								<div class="panel bg-info">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<span class="display-1 glyphicon glyphicon-list-alt"></span>
											</div>
											<div class="col-xs-9 text-right">
	                    						<h4 class="h4 text-truncate text-nowrap">Books Issued</h4>
												<h5 class='h5'>
													<?php 
													
														if (IfIsUser($conn)) {
															$issued_books = GetTotalWhereAnd($conn, TBLISSUEDBOOKS, 'return_status', '0', 'user_id', $user_id);
														}else{
															$issued_books = GetTotalWhere($conn, TBLISSUEDBOOKS, 'return_status', '0');
														}

														echo "$issued_books";

													?>
												</h5>
	                    					</div>
										</div>
									</div>
									<a class="text-info" href="<?php echo WEBSITE_URL; ?>./issuedbooks_list.php?action=issued">
							            <div class="panel-footer">
							                <span class="pull-left">View Details</span>
							                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                <div class="clearfix"></div>
							            </div>
							        </a>
								</div>
							</div>
							<div class="col-sm-12 col-md-3">
								<div class="panel bg-warning">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<span class="fa fa-recycle fa-4x"></span>
											</div>
											<div class="col-xs-9 text-right">
	                    						<h4 class="h4 text-truncate text-nowrap">Books Returned</h4>
												<h5 class='h5'>
													<?php 
													
														if (IfIsUser($conn)) {
															$returned_books = GetTotalWhereAnd($conn, TBLISSUEDBOOKS, 'return_status', '1', 'user_id', $user_id);
														}else{
															$returned_books = GetTotalWhere($conn, TBLISSUEDBOOKS, 'return_status', '1');
														}

														echo "$returned_books";

													?>
												</h5>
	                    					</div>
										</div>
									</div>
									<a class="text-warning" href="<?php echo WEBSITE_URL; ?>./issuedbooks_list.php?action=returned">
							            <div class="panel-footer">
							                <span class="pull-left">View Details</span>
							                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                <div class="clearfix"></div>
							            </div>
							        </a>
								</div>
							</div>						
							<?php if (!IfIsUser($conn)) { ?>
							<div class="col-sm-12 col-md-3">
								<div class="panel bg-danger">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<span class="fa fa-users fa-4x"></span>
											</div>
											<div class="col-xs-9 text-right">
	                    						<h4 class="h4 text-truncate text-nowrap">Users</h4>
												<h5 class='h5'>
													<?php 

														$users = GetTotal($conn, TBLUSERS);

														echo  "$users";

													?>
												</h5>
	                    					</div>
										</div>
									</div>
									<a class="text-danger" href="<?php echo WEBSITE_URL; ?>./users.php">
							            <div class="panel-footer">
							                <span class="pull-left">View Details</span>
							                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                <div class="clearfix"></div>
							            </div>
							        </a>
								</div>
							</div>
							<?php } ?>
							<div class="col-sm-12 col-md-3">
								<div class="panel bg-success">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<span class="fa fa-users fa-4x"></span>
											</div>
											<div class="col-xs-9 text-right">
	                    						<h4 class="h4 text-truncate text-nowrap">Authors</h4>
												<h5 class='h5'>
													<?php 

														$authors = GetTotal($conn, TBLAUTHORS);

														echo  "$authors";

													?>
												</h5>
	                    					</div>
										</div>
									</div>
									<a class="text-success" href="<?php echo WEBSITE_URL; ?>./author_list.php">
							            <div class="panel-footer">
							                <span class="pull-left">View Details</span>
							                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                <div class="clearfix"></div>
							            </div>
							        </a>
								</div>
							</div>
							<div class="col-sm-12 col-md-3">
								<div class="panel bg-info">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<span class="fa fa-file-zip-o fa-4x"></span>
											</div>
											<div class="col-xs-9 text-right">
	                    						<h4 class="h4 text-truncate text-nowrap">Categories</h4>
												<h5 class='h5'>
													<?php 

														$categories = GetTotal($conn, TBLCATEGORIES);

														echo  "$categories";
														
													?>
												</h5>
	                    					</div>
										</div>
									</div>
									<a class="text-info" href="<?php echo WEBSITE_URL; ?>./category_list.php">
							            <div class="panel-footer">
							                <span class="pull-left">View Details</span>
							                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                <div class="clearfix"></div>
							            </div>
							        </a>
								</div>
							</div>
							<div class="col-sm-12 col-md-3">
								<div class="panel bg-warning">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<span class="fa fa-list fa-4x"></span>
											</div>
											<div class="col-xs-9 text-right">
	                    						<h4 class="h4 text-truncate text-nowrap">Rules & Regulations</h4>
												<h5 class='h5'>
													<?php 

														$rules = GetTotal($conn, TBLRULESANDREGULATIONS);

														echo "$rules";

													?>
												</h5>
	                    					</div>
										</div>
									</div>
									<a class="text-warning" href="<?php echo WEBSITE_URL; ?>./rule_list.php">
							            <div class="panel-footer">
							                <span class="pull-left">View Details</span>
							                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                <div class="clearfix"></div>
							            </div>
							        </a>
								</div>
							</div>
							<?php if (!IfIsUser($conn)) { ?>
							<div class="col-sm-12 col-md-3">
								<div class="panel bg-danger">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<span class="display-1 glyphicon glyphicon-comment"></span>
											</div>
											<div class="col-xs-9 text-right">
	                    						<h4 class="h4 text-truncate text-nowrap">Feedbacks</h4>
												<h5 class='h5'>
													<?php 

														$feedbacks = GetTotal($conn, TBLFEEDBACK);

														echo "$feedbacks";

													?>
												</h5>
	                    					</div>
										</div>
									</div>
									<a class="text-danger" href="<?php echo WEBSITE_URL; ?>./feedback_list.php">
							            <div class="panel-footer">
							                <span class="pull-left">View Details</span>
							                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                <div class="clearfix"></div>
							            </div>
							        </a>
								</div>
							</div>
							<?php } ?>
							<div class="col-sm-12 col-md-3">
								<div class="panel bg-success">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<span class="fa fa-share fa-4x"></span>
											</div>
											<div class="col-xs-9 text-right">
	                    						<h4 class="h4 text-truncate text-nowrap">Books Requested</h4>
												<h5 class='h5'>
													<?php 
														
														if (IfIsUser($conn)) {
															$requested_books = GetTotalWhereAnd($conn, TBLISSUEDBOOKS, 'return_status', '3', 'user_id', $user_id);
														}else{
															$requested_books = GetTotalWhere($conn, TBLISSUEDBOOKS, 'return_status', '3');
														}

														echo "$requested_books";

													?>
												</h5>
	                    					</div>
										</div>
									</div>
									<a class="text-success" href="<?php echo WEBSITE_URL; ?>./issuedbooks_list.php?action=requested">
							            <div class="panel-footer">
							                <span class="pull-left">View Details</span>
							                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                <div class="clearfix"></div>
							            </div>
							        </a>
								</div>
							</div>
							<!--<?php //if (!IfIsUser($conn)) { ?>
							<div class="col-sm-12 col-md-3">
								<div class="panel bg-info">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<span class="fa fa-slideshare fa-4x"></span>
											</div>
											<div class="col-xs-9 text-right">
	                    						<h4 class="h4 text-truncate text-nowrap">Slides</h4>
												<h5 class='h5'>
													<?php 

														$slides// = GetTotal($conn, TBLSLIDER);

														//echo "$slides";

													?>
												</h5>
	                    					</div>
										</div>
									</div>
									<a class="text-info" href="<?php// echo WEBSITE_URL; ?>./slide_list.php">
							            <div class="panel-footer">
							                <span class="pull-left">View Details</span>
							                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                <div class="clearfix"></div>
							            </div>
							        </a>
								</div>
							</div>
							<?php// } ?>-->
						</div>
						<?php if (!IfIsUser($conn)) { ?>
						<div class="row">
							<div class="col col-sm-12 center-block">
								<div class="container-fluid p-3 my-3 text-white">
								<!--Slider Start-->
								<?php   include WEBSITE_PATH. './includes/slider.php'; ?>    
								<!--Slider End-->
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				</section>
				<br />
			</div>
		</div>
	 	<br />
<?php
	include(WEBSITE_PATH.'./includes/footer.php');
?>