<?php

/********************************
* File Name: issuebook.php  	*
* Author: Tariq M.T.H 			*
* Output: Form to issue book 	*
********************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');

// Issue Book
if (isset($_POST['book-issue-form']))
{


	$select = "SELECT * FROM `tblissuedbooksdetail` WHERE user_id={$_POST['user_name']} AND return_status=3;";
	$result = $conn->query($select);
	if ($result && $result->num_rows > 1){
		$row = $result->fetch_assoc();
		$id 			= $row['id'];
		$user_id		= $row['user_id'];
		$book_id 		= $row['book_id'];
		$issue_date 	= trim($_POST['issue_date']);
		$due_date 		= trim($_POST['due_date']);
	}else{
		$book_id 		= trim($_POST['book_name']);
		$user_id 		= trim($_POST['user_name']);
		$issue_date 	= trim($_POST['issue_date']);
		$due_date 		= trim($_POST['due_date']);
	}

	//Return Book
	if (isset($_POST['id']) && $_POST['id']!="")
	{
		$id 			= $_POST['id'];
		$return_date 	= trim($_POST['return_date']);
		$return_status 	= trim($_POST['return_status']);
		$fine 			= trim($_POST['fine']);
		$comments 		= trim($_POST['comments']);

		//Return Book Query
		$sql_update ="UPDATE `tblissuedbooksdetail` 
				SET `book_id` 	={$book_id},
				`user_id` 		={$user_id},
				`issue_date` 	='{$issue_date}',
				`due_date` 		='{$due_date}',
				`return_date` 	= now(),
				`return_status` ={$return_status},
				`fine` 			={$fine},
				`comments` 		='{$comments}'
				WHERE id 		={$id}";
	}

	//Issue Book Query
	$sql_insert = "INSERT INTO `tblissuedbooksdetail`(
			    `book_id`,
			    `user_id`,
			    `issue_date`,
			    `due_date`
			)
			VALUES( 
				{$book_id}, 
				{$user_id}, 
				now(),
				'{$due_date}'
			)";
	
	$result=false;
	$value = IsBookAvailable($conn, $book_id,$user_id); 
	$user = IsUserAvailable($conn,$user_id); 

	if (isset($_POST['id']) && !empty($_POST['id'])) {
		$result= $conn->query($sql_update);
	}
	if ($user && $value && empty($_POST['id'])) {
		$result= $conn->query($sql_insert);
	}

	if (isset($result) && !empty($sql_insert) && empty($sql_update) && !empty($value) && !empty($user))
	{
		$msg = "<div class='alert alert-success text-capitalize'>";
		$msg .= " <b><u>Book Issued Successfully</u></b>,";
		$msg .= " To view <b>Total Books Returned</b> click/tap <a href='issuedbooks_list.php?action=returned'>HERE</a>," ;
		$msg .= " if you want To view <b>Total Books Issued</b> click/tap <a href='issuedbooks_list.php?action=issued'>HERE</a> or" ;
		$msg .= " if you want To view <b>Total Books Issued & Returned</b> click/tap <a href='issuedbooks_list.php'>HERE</a>.";
		$msg .= "</div>";
	}elseif (isset($result) && isset($sql_update))
	{
		$msg = "<div class='alert alert-success text-capitalize'>";
		$msg .= " <b><u>Book returned Successfully</u></b>,";
		$msg .= " To view <b>Total Books Returned</b> click/tap <a href='issuedbooks_list.php?action=returned'>HERE</a>," ;
		$msg .= " if you want To view <b>Total Books Issued</b> click/tap <a href='issuedbooks_list.php?action=issued'>HERE</a> or" ;
		$msg .= " if you want To view <b>Total Books Issued & Returned</b> click/tap <a href='issuedbooks_list.php'>HERE</a>.";
		$msg .= "</div>";
	}else{
		$msg = "<div class='alert alert-danger text-capitalize'>Errors occured/Book not available/User not available.</div>";
	}
}

$id 			= '';
$book_name 		= '';
$user_id 		= '';
$issue_date 	= '';
$due_date 		= '';
$return_date	= '';
$return_status 	= '';
$fine 			= '';
$comments 		= '';

if (isset($_GET['id']))
{
$select = "SELECT * FROM `tblissuedbooksdetail` WHERE id={$_GET['id']}";
$result = $conn->query($select);
	if ($result && $result->num_rows > 0){
		$row = $result->fetch_assoc();
		$id 			= $row['id'];
		$user_id		= $row['user_id'];
		$book_id 		= $row['book_id'];
		$issue_date 	= $row['issue_date'];
		$due_date 		= $row['due_date'];
		$return_date 	= $row['return_date'];
		$return_status	= $row['return_status'];
		$fine 			= $row['fine'];
		$comments 		= $row['comments'];
	};		
}

if (isset($msg))
{
	echo $msg;
}
?>     							
      							
			<section id="content">
				<div class="page-wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col">
								<h4>
									<?php if (isset($_GET['id'])) { echo "Return Book"; }else{ echo "Issue Book" ; } ?><hr/>
								</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<!--Book Issue Form-->
								<form name="book-issue-form" method="post" class="form">
									<br />
									<input type="hidden" name="book-issue-form" value="book-issue-form" />
									<input type="hidden" name="id" value="<?php echo $id;?>" />
									<?php if (isset($_GET['id'])) { ?>
										<span class="f-img fa fa-recycle fa-5x"></span>
									<?php }else{ ?>
										<span class="f-img display-1 glyphicon glyphicon-list-alt"></span>
									<?php } ?>
									<h2>Book</h2>
									<small>
									<?php if ($_GET) { echo "Return Form"; }else{ echo "Issue Form"; } ?>
									</small>
									<p class="labelenglish"><b>Book Name:</b></p>
									<select id="book_name" name="book_name" class="blank form-control-lg" required>
										
										<?php 
										$book_name = GetBooks($conn);
										foreach ($book_name as $row) {
											$is_selected ="";
											if($row['id'] == $book_id)
											{
												$is_selected ="selected";

											}

										echo "<option {$is_selected} value='{$row['id']}'>{$row['book_name']}</option>";
										} 
										?>

							    	</select>
									<p class="labelenglish"><b>User Name:</b></p>
									<select id="user_name" name="user_name" class="blank form-control-lg" required>
										
										<?php 
										$user_name = GetUsers($conn);
										foreach ($user_name as $row) {
										$is_selected ="";
										if($row['id'] == $user_id)
										{
											$is_selected ="selected";

										}
										echo "<option {$is_selected} value='{$row['id']}'>{$row['full_name']}</option>";
										} 
										?>

							    	</select>
									<p class="labelenglish"><b>Issue Date:</b></p>
									
									<?php 
									if (empty($issue_date)){
										$issue_date = "";
									}else{
										$issue_date = date("Y-m-d",strtotime($issue_date));
									}
									?>

									<input type="date" value="<?php echo $issue_date; ?>" name="issue_date" class="blank" />
									
									<p class="labelenglish"><b>Due Date:</b></p>
									
									<?php 
									if (empty($due_date)){
										$due_date = "";
									}else{
										$due_date = date("Y-m-d",strtotime($due_date));
									}
									?>
									
									<input type="date" value="<?php echo $due_date; ?>" name="due_date" class="blank" required />

									<?php
									if (isset($_GET['id'])){ 
									?>
									
									<p class="labelenglish"><b>Return Date:</b></p>
									
									<?php 
									if (empty($return_date)){
										$return_date = "";
									}else{
										$return_date = date("Y-m-d",strtotime($return_date));
									}
									?>
									
									<input type="date" value="<?php echo $return_date; ?>" name="return_date" class="blank" />
									<p class="labelenglish"><b>Return Status:</b></p>
									<select id="return_status" name="return_status" class="blank form-control-lg" value="<?php echo $return_status; ?>" required>
										<option value="<?php echo 0; ?>">Issued</option>
										<option value="<?php echo 1; ?>">Returned</option>
										<option value="<?php echo 2; ?>">Right Off/Lost</option>
										<option value="<?php echo 3; ?>" hidden>Requested</option>
									</select>
									<p class="labelenglish"><b>Fine:</b></p>
									<input type="text" value="<?php echo $fine; ?>" name="fine" class="blank form-control-lg" />
									<p class="labelenglish"><b>Comments:</b></p>
									<textarea name="comments" class="blank" value="" rows="5"><?php echo $comments; ?></textarea>
									<br />
									<?php } ?>

									<div class="">
										<input type="reset" name="reset" value="Reset"  class="btn btn-success"/>
										<?php 
										if (isset($_GET['id'])) {
											echo "<input type='submit' name='submit' value='Return'  class='btn btn-success' />";
										}
										else{
											echo "<input type='submit' name='submit' value='Issue'  class='btn btn-success' />";
										}
										?>
									</div>
									<br />
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
<?php
include(WEBSITE_PATH.'./includes/footer.php');
?>

