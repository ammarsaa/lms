<?php

/************************************
* File Name: issuedbooks_list.php 	*
* Author: Ammar S.A.A 				*
* Output: List of issued books 		*
************************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');
//Delete Query
if(isset($_GET['action']) && isset($_GET['id']))
{
	$id = $_GET['id'];
	$sql = "DELETE FROM tblissuedbooksdetail WHERE id={$id}";
	$result = $conn->query($sql);
	if($result)
	{
		$msg = "<div class='alert alert-success text-capitalize'>";
			$msg .= " <b><u>Record Deleted Successfully</u></b>,";
			$msg .= " To view <b>Total Books Returned</b> click/tap <a href='issuedbooks_list.php?action=returned'>HERE</a>," ;
			$msg .= " if you want To view <b>Total Books Requested</b> click/tap <a href='issuedbooks_list.php?action=requested'>HERE</a>,";
			$msg .= " if you want To view <b>Total Books Issued</b> click/tap <a href='issuedbooks_list.php?action=issued'>HERE</a> or" ;
			$msg .= " if you want To view <b>Total Books Issued & Returned</b> click/tap <a href='issuedbooks_list.php'>HERE</a>.";
			$msg .= "</div>";	
	}
	else{
		$msg = "<div class='alert alert-danger'>Record Not Deleted Successfully.</div>";
	}

}
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

if (isset($_GET['action'])) {
		$action = $_GET['action'];
	}else{
		$action='';
	}
switch ($action) {
	//If get $action with value issued
	case 'issued':
	if (IfIsUser($conn)){
		$sql = "SELECT
		    tblissuedbooksdetail.id,
		    tblbooks.book_name,
		    tblusers.full_name,
		    tblissuedbooksdetail.issue_date,
		    tblissuedbooksdetail.due_date,
		    tblissuedbooksdetail.return_date,
		    tblissuedbooksdetail.return_status,
		    tblissuedbooksdetail.fine,
		    tblissuedbooksdetail.comments
		FROM
		    tblissuedbooksdetail
		INNER JOIN tblbooks ON tblissuedbooksdetail.book_id = tblbooks.id
		INNER JOIN tblusers ON tblissuedbooksdetail.user_id = tblusers.id
		WHERE return_status = 0 AND user_id ={$user_id}
		ORDER BY id DESC";
	}else{
	$sql = "SELECT
		    tblissuedbooksdetail.id,
		    tblbooks.book_name,
		    tblusers.full_name,
		    tblissuedbooksdetail.issue_date,
		    tblissuedbooksdetail.due_date,
		    tblissuedbooksdetail.return_date,
		    tblissuedbooksdetail.return_status,
		    tblissuedbooksdetail.fine,
		    tblissuedbooksdetail.comments
		FROM
		    tblissuedbooksdetail
		INNER JOIN tblbooks ON tblissuedbooksdetail.book_id = tblbooks.id
		INNER JOIN tblusers ON tblissuedbooksdetail.user_id = tblusers.id
		WHERE return_status = 0
		ORDER BY id DESC";
	}
	break;
	//If get $action with value returned
	case 'returned':
	if (IfIsUser($conn)){
	$sql = "SELECT
		    tblissuedbooksdetail.id,
		    tblbooks.book_name,
		    tblusers.full_name,
		    tblissuedbooksdetail.issue_date,
		    tblissuedbooksdetail.due_date,
		    tblissuedbooksdetail.return_date,
		    tblissuedbooksdetail.return_status,
		    tblissuedbooksdetail.fine,
		    tblissuedbooksdetail.comments
		FROM
		    tblissuedbooksdetail
		INNER JOIN tblbooks ON tblissuedbooksdetail.book_id = tblbooks.id
		INNER JOIN tblusers ON tblissuedbooksdetail.user_id = tblusers.id
		WHERE return_status = 1 AND user_id ={$user_id}
		ORDER BY id DESC";
	}else{
		$sql = "SELECT
		    tblissuedbooksdetail.id,
		    tblbooks.book_name,
		    tblusers.full_name,
		    tblissuedbooksdetail.issue_date,
		    tblissuedbooksdetail.due_date,
		    tblissuedbooksdetail.return_date,
		    tblissuedbooksdetail.return_status,
		    tblissuedbooksdetail.fine,
		    tblissuedbooksdetail.comments
		FROM
		    tblissuedbooksdetail
		INNER JOIN tblbooks ON tblissuedbooksdetail.book_id = tblbooks.id
		INNER JOIN tblusers ON tblissuedbooksdetail.user_id = tblusers.id
		WHERE return_status = 1
		ORDER BY id DESC";
	}
	break;
	//If get $action with value requested
	case 'requested':
	if (IfIsUser($conn)){
	$sql = "SELECT
		    tblissuedbooksdetail.id,
		    tblbooks.book_name,
		    tblusers.full_name,
		    tblissuedbooksdetail.issue_date,
		    tblissuedbooksdetail.due_date,
		    tblissuedbooksdetail.return_date,
		    tblissuedbooksdetail.return_status,
		    tblissuedbooksdetail.fine,
		    tblissuedbooksdetail.comments
		FROM
		    tblissuedbooksdetail
		INNER JOIN tblbooks ON tblissuedbooksdetail.book_id = tblbooks.id
		INNER JOIN tblusers ON tblissuedbooksdetail.user_id = tblusers.id
		WHERE return_status = 3 AND user_id ={$user_id}
		ORDER BY id DESC";
	}else{
		$sql = "SELECT
		    tblissuedbooksdetail.id,
		    tblbooks.book_name,
		    tblusers.full_name,
		    tblissuedbooksdetail.issue_date,
		    tblissuedbooksdetail.due_date,
		    tblissuedbooksdetail.return_date,
		    tblissuedbooksdetail.return_status,
		    tblissuedbooksdetail.fine,
		    tblissuedbooksdetail.comments
		FROM
		    tblissuedbooksdetail
		INNER JOIN tblbooks ON tblissuedbooksdetail.book_id = tblbooks.id
		INNER JOIN tblusers ON tblissuedbooksdetail.user_id = tblusers.id
		WHERE return_status = 3
		ORDER BY id DESC";
	}
	break;
	//If get $action
	default:
	if (IfIsUser($conn)){
		$sql="SELECT
				    tblissuedbooksdetail.id,
				    tblbooks.book_name,
				    tblusers.full_name,
				    tblissuedbooksdetail.issue_date,
				    tblissuedbooksdetail.due_date,
				    tblissuedbooksdetail.return_date,
				    tblissuedbooksdetail.return_status,
				    tblissuedbooksdetail.fine,
				    tblissuedbooksdetail.comments
				FROM
				    tblissuedbooksdetail
				INNER JOIN tblbooks ON tblissuedbooksdetail.book_id = tblbooks.id
				INNER JOIN tblusers ON tblissuedbooksdetail.user_id = tblusers.id
				WHERE user_id ={$user_id}
				ORDER BY id DESC";
	}else{
		$sql = "SELECT
				    tblissuedbooksdetail.id,
				    tblbooks.book_name,
				    tblusers.full_name,
				    tblissuedbooksdetail.issue_date,
				    tblissuedbooksdetail.due_date,
				    tblissuedbooksdetail.return_date,
				    tblissuedbooksdetail.return_status,
				    tblissuedbooksdetail.fine,
				    tblissuedbooksdetail.comments
				FROM
				    tblissuedbooksdetail
				INNER JOIN tblbooks ON tblissuedbooksdetail.book_id = tblbooks.id
				INNER JOIN tblusers ON tblissuedbooksdetail.user_id = tblusers.id
				ORDER BY id DESC";
	}
}

if(isset($_POST['search']) && !empty($_POST['search'])){
	$search = trim($_POST['search']);
	$sql="SELECT
				tblissuedbooksdetail.id,
			    tblbooks.book_name,
			    tblusers.full_name,
			    tblissuedbooksdetail.issue_date,
			    tblissuedbooksdetail.due_date,
			    tblissuedbooksdetail.return_date,
				tblissuedbooksdetail.return_status,
			    tblissuedbooksdetail.fine,
			    tblissuedbooksdetail.comments
			FROM
			    tblissuedbooksdetail
			INNER JOIN tblbooks ON tblissuedbooksdetail.book_id = tblbooks.id
			INNER JOIN tblusers ON tblissuedbooksdetail.user_id = tblusers.id
			WHERE 	book_name 		LIKE '%{$search}%' 
			OR 		full_name 		LIKE '%{$search}%'
			OR 		return_status 	LIKE '%{$search}%'
			ORDER BY id DESC";
}

$result = $conn->query($sql);

if (isset($msg))
{
	echo $msg;
}
?>     							
      							
			<section id="content">
				<div class="page-wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col md-8 lg-10 sm-6">
								<!--Search Nav Start-->
								<nav class="navbar navbar-light default-color bg-transparent nav justify-content-between">
  									
  									<?php if ($action == 'returned') { ?>
  										<a class="navbar-brand" href="issuedbooks_list.php?action=returned">Returned Books</a>
  									<?php } elseif ($action == 'issued') { ?>
  										<a class="navbar-brand" href="issuedbooks_list.php?action=issued">Issued Books</a>
									<?php } elseif ($action == 'requested') { ?>
										<a class="navbar-brand" href="issuedbooks_list.php?action=requested">Requested Books</a>
  									<?php }else{ ?>
  										<a class="navbar-brand" href="issuedbooks_list.php" title="Issued,Returned And Requested Books">IR&R Books</a>
  									<?php } ?>
  									<!--Search Form Start-->
  									<form class="form-inline form-responsive my-0 form-inline bg-transparent" method="POST">
    									<div class="md-form form-sm my-0">
      										<input type="text" class="form-control" name="search" placeholder="Search..." />
    										<button class="btn btn-sm my-0 btn-transparent" type="submit">
   												<i class="material-icons">search</i>
  											</button>
  										</div>
  									</form>
									<!--Search Form End-->
									<?php if (IfIsUser($conn)) {}else{ ?>
										<a class="btn btn-outline-primary" href="issuebook.php" role="button">Issue Book</a>
									<?php } ?>
								</nav>
								<!--Search Nav End-->
							</div>
						</div>
						<div class="row">
							<div class="table-responsive">
								<table class="table table-hover table-condensed table-striped">
									<thead class="thead thead-light">
										<tr>
											<?php if (!IfIsUser($conn)) { ?>
												<th></th>
											<?php } ?>
											<th>ID</th>
											<th>Book Name</th>
											<th>Full Name</th>
											<th>Issue Date</th>
											<th>Due Date</th>
											<th>Return Date</th>
											<th>Status</th>
											<th>Fine</th>
											<th>Comments</th>
											<?php if (IfIsUser($conn)) { if ($action == 'requested') {?>
												<th>Action</th>
											<?php }}else{ ?>
											<th colspan="2">Action</th> <?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php
										if ($result){
											foreach ($result as $row) {
										?>
										<tr>
											<?php if (!IfIsUser($conn)) { ?>
												<td>
													<?php 
													if (isset($row['return_date'])) {
														//If return date is greater then due date and fine == 0 echo warning  
														if ($row['return_date']>$row['due_date'] && $row['fine']==0) {
															echo "<span class='text-danger spinner-border'></span>";
														}//If return date is entered but status is issued echo warning
														elseif (isset($row['return_date']) && $row['return_status']=='issued') {
															echo "<span class='text-danger spinner-grow'></span>";
														}//If everything is ok echo glyphicon-ok
														else{
															echo "<span class='text-success glyphicon glyphicon-ok'></span>";
														}
													}elseif (isset($row['issue_date'])) {
														//If book is requested echo warning
														if (isset($row['issue_date']) && $row['return_status']=="3") {
															echo "<span class='text-warning spinner-border'></span>";
														}//If issue date is greater then due date echo warning 
														elseif ($row['issue_date']>$row['due_date']) {
															echo "<span class='text-warning spinner-grow'></span>";
														}//If Due Date is less then issue date echo warning
														elseif ($row['due_date']<$row['issue_date']) {
															echo "<span class='text-warning spinner-grow'></span>";
														}//If everything is ok echo glyphicon-ok
														else{
															echo "<span class='text-success glyphicon glyphicon-ok'></span>";
														}
													}
													?>
												</td>
											<?php } ?>
											<td><?php echo $row['id']; ?></td>
											<td><?php echo $row['book_name']; ?></td>
											<td><?php echo $row['full_name']; ?></td>
											<td><?php echo $row['issue_date']; ?></td>
											<td><?php echo $row['due_date']; ?></td>
											<td><?php echo $row['return_date']; ?></td>
											<td><?php GetReturnStatus($row['return_status']); ?></td>
											<td><?php echo $row['fine']; ?></td>
											<td><?php echo $row['comments']; ?></td>
											<?php if (IfIsUser($conn)) { if ($action == 'requested') {?>
												<td>
													<button class="btn btn-danger btn-sm" onclick="delete_confirm(<?php echo $row["id"]; ?>)"><a><i class="display-5 glyphicon glyphicon-trash"></i></a></button>
												</td>
											<?php }}else{ ?>
												<td>
													<button class="btn btn-warning btn-sm"><a href="<?php echo WEBSITE_URL. 'issuebook.php?id='.$row['id']; ?> "><i class="display-5 glyphicon glyphicon-edit"></i></a></button>
												</td>
												<td>
													<button class="btn btn-danger btn-sm" onclick="delete_confirm(<?php echo $row["id"]; ?>)"><a><i class="display-5 glyphicon glyphicon-trash"></i></a></button>
												</td>
											<?php } ?>
										</tr>
										<?php }
										}else{
											if (IfIsUser($conn)) {
												echo "<tr><td colspan='10'><p>No record found for <b>{$search}</b></p></td></tr>";
											}else{										
												echo "<tr><td colspan='12'><p>No record found for <b>{$search}</b></p></td></tr>";
											}
										}
										?>
									</tbody>
									<tfoot class="tfoot">
										<tr>
											<?php if (IfIsUser($conn)){ ?>
												<td colspan='10'>
											<?php }else{ ?>										
												<td colspan='12'> 
											<?php }
												
												if (isset($search)) {	
												
													GetTotalSearchResult($conn,$result,$search);
												
												}else{
													if ($action == 'returned' && IfIsUser($conn)) { 
				  										$total_returnedbooks = GetTotalWhereAnd($conn, TBLISSUEDBOOKS, 'user_id', $user_id, 'return_status', '1');
														echo "The total Book(s) Returned are <b>".$total_returnedbooks."</b>.";
				  									} elseif ($action == 'issued' && IfIsUser($conn)) {
			  											$total_issuedbooks = GetTotalWhereAnd($conn,TBLISSUEDBOOKS, 'user_id', $user_id, 'return_status', '0');
														echo "The total Book(s) Issued are <b>".$total_issuedbooks."</b>.";
													} elseif ($action == 'requested' && IfIsUser($conn)) {
			  											$total_requestedbooks = GetTotalWhereAnd($conn,TBLISSUEDBOOKS, 'user_id', $user_id, 'return_status', '3');
														echo "The total Book(s) Requested are <b>".$total_requestedbooks."</b>.";
													}//For Admin
													elseif ($action == 'returned' && !IfIsUser($conn)) { 
				  										$total_returnedbooks = GetTotalWhere($conn, TBLISSUEDBOOKS, 'return_status', '1');
														echo "The total Book(s) Returned are <b>".$total_returnedbooks."</b>.";
				  									} elseif ($action == 'issued' && !IfIsUser($conn)) {
			  											$total_issuedbooks = GetTotalWhere($conn,TBLISSUEDBOOKS, 'return_status', '0');
														echo "The total Book(s) Issued are <b>".$total_issuedbooks."</b>.";
													} elseif ($action == 'requested' && !IfIsUser($conn)) {
			  											$total_requestedbooks = GetTotalWhere($conn,TBLISSUEDBOOKS, 'return_status', '3');
														echo "The total Book(s) Requested are <b>".$total_requestedbooks."</b>.";
													}else{
														$total_books = GetTotal($conn,TBLISSUEDBOOKS);
														echo "Showing Total <b>".$total_books."</b> of <b>".$total_books."</b> Row(s).";
													}
												}

											?>
											</td>
										</tr>
										<tr>
											<?php if (IfIsUser($conn)) { if ($action == 'requested') {?>
												<td colspan="10">
													<i><strong>Note:</strong>If You have requested multiple books, you can only be issued the one which is requested first.</i>
												</td>
											<?php }} ?>
										</tr>
									</tfoot>
								</table>
							</div>
							<div class="col-md-6">	
								<table class="table table-condensed table-hover table-dark">
									<thead class="thead thead-light">
										<tr>
											<td colspan="2" class="text-center"><strong>Key</strong></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><span class='text-success glyphicon glyphicon-ok'></span></td>
											<td class="text-capitalize">Everything is OK.</td>
										</tr>
										<tr>
											<td><span class='text-warning spinner-border'></span></td>
											<td class="text-capitalize">Book is Requested And waiting to be issued.</td>
										</tr>
										<tr>
											<td><span class='text-danger spinner-border'></span></td>
											<td class="text-capitalize">Fine needs to be calculated.</td>
										</tr>
										<tr>
											<td><span class='text-danger spinner-grow'></span></td>
											<td class="text-capitalize">Status needs to be corrected.</td>
										</tr>
										<tr>
											<td><span class='text-warning spinner-grow'></span></td>
											<td class="text-capitalize">Something is wrong with dates( issue date or due date).</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<br />
					</div>
				</div>
			</section>
		</div>
	</div>
<?php
include(WEBSITE_PATH.'./includes/footer.php');
?>

<script>
function delete_confirm(id) {
  var txt;
  if (confirm("Are you sure? you want to delete this record.")) {
   window.location.href = "<?php echo WEBSITE_URL. 'issuedbooks_list.php?action=delete&id=' ?>"+id;
  }
}
</script>