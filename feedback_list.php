<?php

/********************************
* File Name: feedback_list.php 		*
* Author: Ammar S.A.A 			*
* Output: feedbacks & Regulations 	*
********************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');

if(isset($_GET['action']) && isset($_GET['id']))
{
	$id = $_GET['id'];
	$sql = "DELETE FROM tblfeedback WHERE id={$id}";
	$result = $conn->query($sql);
	if($result)
	{
		$msg = "<div class='alert alert-success'>Record Deleted Successfully.</div>";
	}
	else{
		$msg = "<div class='alert alert-danger'>Record Not Deleted Successfully.</div>";
	}

}
$sql= "SELECT
		    tblfeedback.id,
		    tblfeedback.feedback,
		    tblfeedback.feedback_urdu,
		    tblusers.full_name,
		    tblusers.email_id,
		    tblfeedback.creation_date
		FROM
		    tblfeedback
		INNER JOIN tblusers ON tblfeedback.user_id = tblusers.id
		ORDER BY id DESC";
if(isset($_POST['search']) && !empty($_POST['search'])){
	$search = trim($_POST['search']);
	$sql= "SELECT
		    tblfeedback.id,
		    tblfeedback.feedback,
		    tblfeedback.feedback_urdu,
		    tblusers.full_name,
		    tblusers.email_id,
		    tblfeedback.creation_date
		FROM
		    tblfeedback
		INNER JOIN tblusers ON tblfeedback.user_id = tblusers.id
		#ORDER BY id DESC
		WHERE 	feedback  		LIKE  	'%{$search}%'
		OR 		feedback_urdu 	LIKE 	'%{$search}%'
		OR 		full_name 		LIKE 	'%{$search}%'
		OR 		tblusers.email_id 		LIKE 	'%{$search}%'
		OR 		creation_date 	LIKE 	'%{$search}%'
		";
}

$result = $conn->query($sql);

if (isset($msg))
{
	echo $msg;
}

$row='';
$read_more = '';

if (isset($_GET['read_more'])) {
	$id = $_GET['read_more'];
	$sql= "SELECT
		    tblfeedback.id,
		    tblfeedback.feedback,
		    tblfeedback.feedback_urdu,
		    tblusers.full_name,
		    tblusers.email_id,
		    tblfeedback.creation_date
		FROM
		    tblfeedback
		INNER JOIN tblusers ON tblfeedback.user_id = tblusers.id
		#ORDER BY id DESC
		WHERE tblfeedback.id={$id}";
	$result = $conn->query($sql);
	if ($result && $result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$id 			= $row['id'];
		$feedback 		= $row['feedback'];
		$feedback_urdu 	= $row['feedback_urdu'];
		$user_name 		= $row['full_name'];
		$user_email 	= $row['email_id'];
		$creation_date 	= $row['creation_date'];
	}
}

?>

			    <section id="content">
					<div class="page-wrapper">
						<div class="container-fluid">
							<div class="row">
								<div class="col-12">
									<!--Search Nav Start-->
									<nav class="navbar navbar-light default-color bg-transparent nav justify-content-between">
  										<a class="navbar-brand" href="feedback_list.php">Feedbacks' List</a>
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
									</nav>
									<!--Search Nav End-->
								</div>
							</div>
							<div class="row">
								<div class="table-responsive">
									<table class="table table-borderless table-condensed table-hover table-striped">
										<thead class="thead thead-light">
											<tr>
												<th>ID</th>
												<th>Feedback</th>
												<th class="urdu">رائے</th>
												<th>Full Name</th>
												<th>Email ID</th>
												<th>Creation Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											
											if ($result){
											foreach ($result as $row) {
											
											?>
											<tr>
												<td><?php echo $row['id']; ?></td>
												<td class="text-truncate">
												<?php
													if (isset($_GET['read_more'])) {
														echo $row['feedback'];
													}else{
														echo substr($row['feedback'],0,50);
												?>
													<a href="<?php if(!empty($row['feedback'])){ echo WEBSITE_URL.'feedback_list.php?read_more='.$row['id'] ?>">Read More</a>
												<?php }} ?>	
												</td>
												<td class="urdu text-truncate">
												<?php 
													if (isset($_GET['read_more'])) {
														echo $row['feedback_urdu'];
													}else{
														echo substr($row['feedback_urdu'],0,10);
														if(!empty($row['feedback_urdu'])){
												?>
													<a href="<?php echo WEBSITE_URL.'feedback_list.php?read_more='.$row['id'] ?>">مزید پڑھیں</a>
												<?php }} ?>
												</td>
												<td><?php echo $row['full_name'] ?></td>
												<td><?php echo $row['email_id'] ?></td>
												<td><?php echo $row['creation_date'] ?></td>
												<td>
													<button class="btn btn-danger btn-sm" onclick="delete_confirm(<?php echo $row["id"]; ?>)" >
														<i class="display-5 glyphicon glyphicon-trash"></i>
													</button>
												</td>
											</tr>
											<?php }
												}else{
													echo "<tr><td colspan='7'><p>No record found for <b>{$search}</b></p></td></tr>";
												}
											?>
										</tbody>
										<tfoot class="tfoot tfoot-light">
											<tr>
												<td colspan="7">
													<?php
														if (isset($search)) {	
															GetTotalSearchResult($conn,$result,$search);
														}else{
															$total_feedbacks = GetTotal($conn, TBLFEEDBACK);
															echo "Showing total <b>".$total_feedbacks."</b> of <b>".$total_feedbacks."</b> result(s).";
														}	
													?>
												</td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<br />
						</div>
					</div>
				</section>
			</div>
		</div>
		<br />
<?php 
	include(WEBSITE_PATH.'./includes/footer.php');
?>

<script>
function delete_confirm(id) 
{
	var txt;
		if (confirm("Are you sure? you want to delete this record.")) {
			window.location.href = "<?php echo WEBSITE_URL. 'feedback_list.php?action=delete&id=' ?>"+id;
		}
}
</script>