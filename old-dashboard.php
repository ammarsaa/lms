<?php

/********************************
* File Name: old-dashboard.php 		*
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
						<div class="row card-group center-block">
							<div class="col-sm-12 col-md-3">
								<div>
									<div class="card text-white text-center bg-success mb-3" style="max-width: 25rem;">
										<a href="<?php echo WEBSITE_URL. './book_list.php'; ?>"><img class="card-img-top" src="images/total-books.png" height="200px" /></a>
										<div class="card-body">
											<h4 class="card-title text-capitalize">Total Books</h4>
											<p class="card-text">
												<?php 

													$books = GetTotal($conn, TBLBOOKS);

													echo $books;

												?>
											</p>
										</div>
										<div class="card-footer text-left">
											<a class="card-link text-capitalize text-light" href="book_list.php">view details</a>
											<a class="card-link text-light pull-right glyphicon glyphicon-circle-arrow-right" href="book_list.php"></a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-3 ">
								<div class="view-overlay">
									<div class="card text-white text-center bg-primary mb-4" style="max-width: 25rem;">
										<a href="issuedbooks_list.php?action=issued"><img class="card-img-top" src="images/book-list1.png" height="200px"/></a>
										<div class="card-body">
											<h4 class="card-title text-nowrap"><a>Total Books Issued</a></h4>
											<p class="card-text">
												<?php 
													
													if (IfIsUser($conn)) {
														$issued_books = GetTotalWhereAnd($conn, TBLISSUEDBOOKS, 'return_status', '0', 'user_id', $user_id);
													}else{
														$issued_books = GetTotalWhere($conn, TBLISSUEDBOOKS, 'return_status', '0');
													}

													echo "$issued_books";

												?>
											</p>
										</div>
										<div class="card-footer text-left">
											<a class="card-link text-capitalize text-light" href="issuedbooks_list.php?action=issued">view details</a>
											<a class="card-link text-light pull-right glyphicon glyphicon-circle-arrow-right" href="issuedbooks_list.php?action=issued"></a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-3 ">
								<div class="view-overlay">
									<div class="card text-white text-center bg-warning mb-4" style="max-width: 25rem;">
										<a href="<?php echo WEBSITE_URL."./issuedbooks_list.php?action=returned"?>"><img class="card-img-top" src="images/book-return.png" height="200px"/></a>
										<div class="card-body">
											<h4 class="card-title text-nowrap"><a>Total Books Returned</a></h4>
											<p class="card-text">
												<?php 
													
													if (IfIsUser($conn)) {
														$returned_books = GetTotalWhereAnd($conn, TBLISSUEDBOOKS, 'return_status', '1', 'user_id', $user_id);
													}else{
														$returned_books = GetTotalWhere($conn, TBLISSUEDBOOKS, 'return_status', '1');
													}

													echo "$returned_books";

												?>
											</p>
										</div>
										<div class="card-footer text-left">
											<a class="card-link text-capitalize text-light" href="issuedbooks_list.php?action=returned">view details</a>
											<a class="card-link text-light pull-right glyphicon glyphicon-circle-arrow-right" href="issuedbooks_list.php?action=returned"></a>
										</div>
									</div>
								</div>
							</div>
							<?php if (!IfIsUser($conn)) { ?>
							<div class="col-sm-12 col-md-3 ">
								<div class="view-overlay">
									<div class="card text-white text-center bg-danger mb-4" style="max-width: 25rem;">
										<a href="users.php"><img class="card-img-top" src="images/users.png" height="200px"/></a>
										<div class="card-body">
											<h4 class="card-title text-nowrap"><a>Total Users</a></h4>
											<p class="card-text">
												<?php 

													$users = GetTotal($conn, TBLUSERS);

													echo  "$users";

												?>
											</p>
										</div>
										<div class="card-footer text-left">
											<a class="card-link text-capitalize text-light" href="users.php">view details</a>
											<a class="card-link text-light pull-right glyphicon glyphicon-circle-arrow-right" href="users.php"></a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="col-sm-12 col-md-3 ">
								<div class="view-overlay">
									<div class="card text-white text-center bg-success mb-4" style="max-width: 25rem;">
										<a href="author_list.php"><img class="card-img-top" src="images/authors.png" height="200px"/></a>
										<div class="card-body">
											<h4 class="card-title text-nowrap"><a>Total Authors</a></h4>
											<p class="card-text">
												<?php 

													$authors = GetTotal($conn, TBLAUTHORS);

													echo  "$authors";

												?>
											</p>
										</div>
										<div class="card-footer text-left">
											<a class="card-link text-capitalize text-light" href="author_list.php">view details</a>
											<a class="card-link text-light pull-right glyphicon glyphicon-circle-arrow-right" href="author_list.php"></a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-3 ">
								<div class="view-overlay">
									<div class="card text-white text-center bg-primary mb-4" style="max-width: 25rem;">
										<a href="category_list.php"><img class="card-img-top" src="images/categories.png" height="200px"/></a>
										<div class="card-body">
											<h4 class="card-title text-nowrap"><a>Total Categories</a></h4>
											<p class="card-text">
												<?php 

													$categories = GetTotal($conn, TBLCATEGORIES);

													echo  "$categories";
													
												?>
											</p>
										</div>
										<div class="card-footer text-left">
											<a class="card-link text-capitalize text-light" href="category_list.php">view details</a>
											<a class="card-link text-light pull-right glyphicon glyphicon-circle-arrow-right" href="category_list.php"></a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-3 ">
								<div>
									<div class="card text-white text-center bg-warning mb-3" style="max-width: 25rem;">
										<a href="rule_list.php"><img class="card-img-top" src="images/rule-list.png" height="200px"/></a>
										<div class="card-body">
											<h4 class="card-title text-capitalize text-nowrap text-truncate"><a>Total Rules & Regulations</a></h4>
											<p class="card-text">
												<?php 

													$rules = GetTotal($conn, TBLRULESANDREGULATIONS);

													echo "$rules";

												?>
											</p>
										</div>
										<div class="card-footer text-left">
											<a class="card-link text-capitalize text-light" href="rule_list.php">view details</a>
											<a class="card-link text-light pull-right glyphicon glyphicon-circle-arrow-right" href="rule_list.php"></a>
										</div>
									</div>
								</div>
							</div>
							<?php if (!IfIsUser($conn)) { ?>
							<div class="col-sm-12 col-md-3 ">
								<div>
									<div class="card text-white text-center bg-danger mb-3" style="max-width: 25rem;">
										<a href="feedback_list.php"><img class="card-img-top" src="images/feedback-list.png" height="200px"/></a>
										<div class="card-body">
											<h4 class="card-title text-capitalize text-nowrap text-truncate"><a>Total Feedbacks</a></h4>
											<p class="card-text">
												<?php 

													$feedbacks = GetTotal($conn, TBLFEEDBACK);

													echo "$feedbacks";

												?>
											</p>
										</div>
										<div class="card-footer text-left">
											<a class="card-link text-capitalize text-light" href="feedback_list.php">view details</a>
											<a class="card-link text-light pull-right glyphicon glyphicon-circle-arrow-right" href="feedback_list.php"></a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="col-sm-12 col-md-3 ">
								<div class="view-overlay">
									<div class="card text-white text-center bg-danger mb-4" style="max-width: 25rem;">
										<a href="issuedbooks_list.php?action=requested"><img class="card-img-top" src="images/book-return.png" height="200px"/></a>
										<div class="card-body">
											<h4 class="card-title text-nowrap"><a>Total Books Requested</a></h4>
											<p class="card-text">
												<?php 
													
													if (IfIsUser($conn)) {
														$requested_books = GetTotalWhereAnd($conn, TBLISSUEDBOOKS, 'return_status', '3', 'user_id', $user_id);
													}else{
														$requested_books = GetTotalWhere($conn, TBLISSUEDBOOKS, 'return_status', '3');
													}

													echo "$requested_books";

												?>
											</p>
										</div>
										<div class="card-footer text-left">
											<a class="card-link text-capitalize text-light" href="issuedbooks_list.php?action=requested">view details</a>
											<a class="card-link text-light pull-right glyphicon glyphicon-circle-arrow-right" href="issuedbooks_list.php?action=requested"></a>
										</div>
									</div>
								</div>
							</div>
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