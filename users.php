<?php

/****************************
* File Name: users.php 		*
* Author: Ammar S.A.A  		*
* Output: List of users 	*
****************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');

if(isset($_GET['action']) && isset($_GET['id']))
{
	$id = $_GET['id'];
	$sql = "DELETE FROM tblusers WHERE id={$id}";
	$result = $conn->query($sql);
	if($result)
	{
		$msg = "<div class='alert alert-success'>Record Deleted Successfully.</div>";
	}
	else{
		$msg = "<div class='alert alert-danger'>Record Not Deleted Successfully.</div>";
	}

}
$sql = "SELECT * FROM tblusers
			ORDER BY id DESC";
if(isset($_POST['search']) && !empty($_POST['search'])){
	$search = trim($_POST['search']);
	$sql="SELECT * FROM tblusers 
		WHERE 	full_name 		LIKE '%{$search}%'
		OR 		email_id 		LIKE '%{$search}%'
		OR 		mobile_no 		LIKE '%{$search}%'
		OR 		status 			LIKE '%{$search}%'
		";
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
  									<a class="navbar-brand">Users' List</a>
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
									<div class="btn-group">
										<a class="btn btn-outline-primary" href="user-signup.php" role="button">Add User</a>
										<a class="btn btn-outline-primary" href="admin-signup.php" role="button">Add Admin</a>
									</div>
								</nav>
								<!--Search Nav End-->
							</div>
						</div>
						<div class="row">
							<div class="table-responsive">
								<table class="table table-hover table-striped">
									<thead class="thead thead-light">
										<tr>
											<th class="text-nowrap">ID</th>
											<th class="text-nowrap">Full Name</th>
											<th class="text-nowrap">E-Mail</th>
											<th class="text-nowrap">Mobile No.</th>
											<th class="text-nowrap">Password</th>
											<th class="text-nowrap">Status</th>
											<th class="text-nowrap">Profile Picture</th>
											<th class="text-nowrap">Reg. Date</th>
											<th class="text-nowrap">Updt. Date</th>
											<th colspan="2">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										foreach ($result as $row) {
										?>
										<tr>
											<td><?php echo $row['id']; ?></td>
											<td><?php echo $row['full_name']; ?></td>
											<td><?php echo $row['email_id']; ?></td>
											<td><?php echo $row['mobile_no']; ?></td>
											<td><?php echo $row['password']; ?></td>
											<td><?php echo $row['status']; ?></td>
											<td class="img">
												<?php 
												if(empty($row['profile_picture']))
												{												
													echo "<p class='initialism text-center'>No Profile<br/>Picture</p>"; 
												}
												else{
													echo "<img width='55in' class='img-responsive img-circle' src='".WEBSITE_URL."./images/profile_pictures/".$row['profile_picture']."'/>"; 
												}
												?>
											</td>
											<td><?php echo $row['reg_date']; ?></td>
											<td><?php echo $row['updation_date']; ?></td>
											<td>
												<button class="btn btn-warning btn-sm"><a href="<?php echo WEBSITE_URL. 'user-signup.php?id='.$row['id']; ?> "><i class="display-5 glyphicon glyphicon-edit"></i></a></button>
											</td>
											<td>
												<button class="btn btn-danger btn-sm" onclick="delete_confirm(<?php echo $row["id"]; ?>)"><a><i class="display-5 glyphicon glyphicon-trash"></i></a></button>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<div>
									<p>
										<?php
											
											if (isset($search)) {	
											
												GetTotalSearchResult($conn,$result,$search);
											
											}else{
											
												$total_users = GetTotal($conn, TBLUSERS);
												echo "Showing total <b>".$total_users."</b> of <b>".$total_users."</b> result(s).";
											
											}

										?>
									</p>
								</div>
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
   window.location.href = "<?php echo WEBSITE_URL. 'users.php?action=delete&id=' ?>"+id;
  }
}
</script>