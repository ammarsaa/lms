<?php

/****************************
* File Name: admin.php 		*
* Author: Ammar S.A.A 		*
* Output: List of Admins 	*
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
	$sql = "DELETE FROM admin WHERE id={$id}";
	$result = $conn->query($sql);
	if($result)
	{
		$msg = "<div class='alert alert-success'>Record Deleted Seccessfully.</div>";
	}
	else{
		$msg = "<div class='alert alert-danger'>Record Not Deleted Seccessfully.</div>";
	}

}
$sql = "SELECT * FROM admin
			ORDER BY id DESC";
if(isset($_POST['search']) && !empty($_POST['search'])){
	$search = trim($_POST['search']);
	$sql="SELECT * FROM admin 
		WHERE full_name LIKE '%{$search}%'
		OR admin_email 	LIKE '%{$search}%'
		OR user_name 	LIKE '%{$search}%'
		OR status 		LIKE '%{$search}%'
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
  									<a class="navbar-brand" href="admin.php">Admins' List</a>
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
									<a class="btn btn-primary" href="user-signup.php" role="button">Add New User</a>
									<a class="btn btn-primary" href="admin-signup.php" role="button">Add New Admin</a>
								</nav>
								<!--Search Nav End-->
							</div>
						</div>
						<div class="row">
							<div class="table-responsive">
								<table class="table table-hover table-striped">
									<thead class="thead thead-light">
										<tr>
											<th>ID</th>
											<th>Full Name</th>
											<th>E-Mail</th>
											<th>Admin Name</th>
											<th>Password</th>
											<th>Reg. Date</th>
											<th>Updt. Date</th>
											<th>Status</th>
											<th>Profile Picture</th>
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
											<td><?php echo $row['admin_email']; ?></td>
											<td><?php echo $row['user_name']; ?></td>
											<td><?php echo $row['password']; ?></td>
											<td><?php echo $row['reg_date']; ?></td>
											<td><?php echo $row['updation_date']; ?></td>
											<td><?php echo $row['status']; ?></td>
											<td><img class="img-responsive img-circle f-img" src="<?php echo WEBSITE_URL.; ?>images/profile_pictures/<?php echo $row['profile_picture']; ?>" height="150em" width="150em" /></td>
											<td>
												<button class="btn btn-warning btn-sm">
													<a href="<?php echo WEBSITE_URL. 'admin-signup.php?id='.$row['id']; ?> ">
														<i class="material-icons">edit</i>
													</a>
												</button>
											</td>
											<td>
												<button class="btn btn-danger btn-sm" onclick="delete_confirm(<?php echo $row["id"]; ?>)">
													<a>
														<i class="material-icons">delete</i>
													</a>
												</button>
											</td>
										</tr>
										<?php }

										?>
									</tbody>
								</table>
								<br />
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

<script>
function delete_confirm(id) {
  var txt;
  if (confirm("Are you sure? you want to delete this record.")) {
   window.location.href = "<?php echo WEBSITE_URL. 'admin.php?action=delete&id=' ?>"+id;
  }
}
</script>