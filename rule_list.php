<?php

/********************************
* File Name: rule_list.php 		*
* Author: Ammar S.A.A 			*
* Output: Rules & Regulations 	*
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
	$sql = "DELETE FROM tblrulesandregulations WHERE id={$id}";
	$result = $conn->query($sql);
	if($result)
	{
		$msg = "<div class='alert alert-success'>Record Deleted Successfully.</div>";
	}
	else{
		$msg = "<div class='alert alert-danger'>Record Not Deleted Successfully.</div>";
	}

}
$sql= "SELECT * FROM tblrulesandregulations
		#ORDER BY id DESC";
if(isset($_POST['search']) && !empty($_POST['search'])){
	$search = trim($_POST['search']);
	$sql="SELECT * FROM tblrulesandregulations 
		WHERE 	rule  			LIKE  	'%{$search}%'
		OR  	rule_urdu 		LIKE 	'%{$search}%'
		OR 		creation_date 	LIKE 	'%{$search}%'
		OR  	updation_date 	LIKE 	'%{$search}%'
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
	$read_more = $_GET['read_more'];
	$id= $_GET['read_more'];
	$sql= "SELECT * FROM tblrulesandregulations WHERE id={$id}";
	$result = $conn->query($sql);
	if ($result && $result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$id 			= $row['id'];
		$rule 			= $row['rule'];
		$rule_urdu 		= $row['rule_urdu'];
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
  										<a class="navbar-brand" href="rule_list.php">Rules & Regulations</a>
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
										<?php if (IfIsUser($conn)) {} else { ?>
											<a class="btn btn-outline-primary" href="rule_add.php" role="button"> Add New </a>
										<?php } ?>
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
												<th>Rule</th>
												<th class="urdu">اصول</th>
												<th>Creation Date</th>
												<th>Updation Date</th>
												<?php 
												if (IfIsUser($conn)) {
													echo "";
												}else{
													echo "<th colspan='2'>Action</th>";
												}
												?>
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
														echo $row['rule'];
													}else{
														echo substr($row['rule'],0,50)."...";
												?>
													<a href="<?php echo WEBSITE_URL.'rule_list.php?read_more='.$row['id'] ?>">Read More</a>
												<?php } ?>	
												</td>
												<td class="urdu text-truncate">
												<?php 
													if (isset($_GET['read_more'])) {
														echo $row['rule_urdu'];
													}else{
														echo substr($row['rule_urdu'],0,100)."......";
												?>
													<a href="<?php echo WEBSITE_URL.'rule_list.php?read_more='.$row['id'] ?>">مزید پڑھیں</a>
												<?php } ?>
												</td>
												<td><?php echo $row['creation_date'] ?></td>
												<td><?php echo $row['updation_date'] ?></td>
												<?php 
												if (IfIsUser($conn)) {
													echo "";
												}else{
												?>
												<td>
													<button role="button" class="btn btn-warning btn-sm">
														<a href="<?php echo WEBSITE_URL. 'rule_add.php?id='.$row['id']; ?> ">
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
											<?php }}
												}else{
													echo "<tr><td colspan='11'><p>No record found for <b>{$search}</b></p></td></tr>";
												}
											?>
										</tbody>
										<tfoot class="tfoot tfoot-light">
											<td colspan="11">
												<?php
													if (isset($search)) {	
														GetTotalSearchResult($conn,$result,$search);
													}else{
														$total_rules = GetTotal($conn, TBLRULESANDREGULATIONS);
														echo "Showing total <b>".$total_rules."</b> of <b>".$total_rules."</b> result(s).";
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
		<br />
<?php 
	include(WEBSITE_PATH.'./includes/footer.php');
?>

<script>
function delete_confirm(id) 
{
	var txt;
		if (confirm("Are you sure? you want to delete this record.")) {
			window.location.href = "<?php echo WEBSITE_URL. 'rule_list.php?action=delete&id=' ?>"+id;
		}
}
</script>