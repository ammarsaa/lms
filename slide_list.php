<?php

/********************************
* File Name: slide_list.php 	*
* Author: Ammar S.A.A       	*
* Output: List of slides 		*
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
	$sql = "DELETE FROM tblslider WHERE id={$id}";
	$result = $conn->query($sql);
	if($result)
	{
		$msg = "<div class='alert alert-success'>Record Deleted Seccessfully.</div>";
	}
	else{
		$msg = "<div class='alert alert-danger'>Record Not Deleted Seccessfully.</div>";
	}

}

$sql= "SELECT * FROM tblslider
		ORDER BY id DESC";

if(isset($_POST['search']) && !empty($_POST['search'])){
	$search = trim($_POST['search']);
	$sql="SELECT * FROM tblslider 
		WHERE title LIKE '%{$search}%'
		OR  content LIKE '%{$search}%'
		OR 	status 	LIKE '%{$search}%'
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
  									<a class="navbar-brand" href="slide_list.php">Slides List</a>
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
										<a class="btn btn-outline-primary" href="slide_add.php" role="button">Add New</a>
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
											<th>ID</th>
											<th>Topic</th>
											<th>Image</th>
											<th>Content</th>
											<th>Status</th>
											<th>Create Date</th>
											<th>Updt. Date</th>
											<th colspan="2">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										
										if ($result){
										foreach ($result as $row) {
										
										?>
										<tr>
											<td><?php echo $row['id']; ?></td>
											<td><?php echo $row['title']; ?></td>
											<td><img width='55in' class='img-responsive' src="./images/slider/<?php echo $row['slider_img'] ?>"></td>
											<td><?php echo $row['content']; ?></td>
											<td><?php echo $row['status']; ?></td>
											<td><?php echo $row['creation_date']; ?></td>
											<td><?php echo $row['updation_date']; ?></td>
											<td>
												<button role="button" class="btn btn-warning btn-sm">
													<a href="<?php echo WEBSITE_URL. 'slide_add.php?id='.$row['id']; ?> ">
														<i class="display-5 glyphicon glyphicon-edit"></i>
													</a>
												</button>
											</td>
											<td>
												<button class="btn btn-danger btn-sm" onclick="delete_confirm(<?php echo $row["id"]; ?>)" >
													<i class="display-5 glyphicon glyphicon-trash"></i>
												</button>
											</td>									
										</tr>
										<?php }
											}else{
												echo "<tr><td colspan='9'><p>No record found for <b>{$search}</b></p></td></tr>";
											} 
										?>
									</tbody>
									<tfoot class="tfoot tfoot-light">
										<td colspan="9">
											<?php
												if (isset($search)) {	
													GetTotalSearchResult($conn,$result,$search);
												}else{
													$slides = GetTotal($conn, TBLSLIDER);
													echo "Showing total <b>".$slides."</b> of <b>".$slides."</b> result(s).";
												}	
											?>
										</td>
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
<?php
include(WEBSITE_PATH.'./includes/footer.php');
?>

<script>
function delete_confirm(id) {
  var txt;
  if (confirm("Are you sure? you want to delete this record.")) {
   window.location.href = "<?php echo WEBSITE_URL. 'slide_list.php?action=delete&id=' ?>"+id;
  }
}
</script>