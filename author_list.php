<?php

/********************************
* File Name: author_list.php 	*
* Author: Ammar S.A.A       	*
* Output: List of authors 		*
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
	$sql = "DELETE FROM tblauthors WHERE id={$id}";
	$result = $conn->query($sql);
	if($result)
	{
		$msg = "<div class='alert alert-success'>Record Deleted Seccessfully.</div>";
	}
	else{
		$msg = "<div class='alert alert-danger'>Record Not Deleted Seccessfully.</div>";
	}

}

$sql= "SELECT * FROM tblauthors
		ORDER BY id DESC";

if(isset($_POST['search']) && !empty($_POST['search'])){
	$search = trim($_POST['search']);
	$sql="SELECT * FROM tblauthors 
		WHERE author_name LIKE '%{$search}%'
		OR  author_name_urdu LIKE '%{$search}%'
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
  									<a class="navbar-brand" href="author_list.php">Author List</a>
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
										<a class="btn btn-outline-primary" href="author_add.php" role="button">Add New</a>
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
											<th>Author Name</th>
											<th class="urdu">مصنف کا نام</th>
											<?php if (IfIsUser($conn)) {
											} else { ?>
												<th>Reg. Date</th>
												<th>Updt. Date</th>
												<th colspan="2">Action</th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php 
										
										if ($result){
										foreach ($result as $row) {
										
										?>
										<tr>
											<td><?php echo $row['id']; ?></td>
											<td><a class="link" href="<?php echo WEBSITE_URL.'book_list.php?author_id='.$row['id'] ?>"><?php echo $row['author_name']; ?></a></td>
											<td class="urdu"><a class="link" href="<?php echo WEBSITE_URL.'book_list.php?author_id_urdu='.$row['id'] ?>"><?php echo $row['author_name_urdu'] ?></a></td>
											<?php if (IfIsUser($conn)) {
											} else { ?>
												<td><?php echo $row['creation_date']; ?></td>
												<td><?php echo $row['updation_date']; ?></td>
												<td>
													<button role="button" class="btn btn-warning btn-sm">
														<a href="<?php echo WEBSITE_URL. 'author_add.php?id='.$row['id']; ?> ">
															<i class="display-5 glyphicon glyphicon-edit"></i>
														</a>
													</button>
												</td>
												<td>
													<button class="btn btn-danger btn-sm" onclick="delete_confirm(<?php echo $row["id"]; ?>)" >
														<i class="display-5 glyphicon glyphicon-trash"></i>
													</button>
												</td>
											<?php } ?>										
										</tr>
										<?php }
											}else{
												echo "<tr><td colspan='11'><p>No record found for <b>{$search}</b></p></td></tr>";
											}
										?>
									</tbody>
								</table>
								<div>
									<p>
										<?php
											
											if (isset($search)) {	
											
												GetTotalSearchResult($conn,$result,$search);
											
											}else{
											
												$total_authors = GetTotal($conn, TBLAUTHORS);
												echo "Showing total <b>".$total_authors."</b> of <b>".$total_authors."</b> result(s).";
											
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
   window.location.href = "<?php echo WEBSITE_URL. 'author_list.php?action=delete&id=' ?>"+id;
  }
}
</script>