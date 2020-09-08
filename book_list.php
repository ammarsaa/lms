<?php

/****************************
* File Name: book_list.php 	*
* Author: Ammar S.A.A 		*
* Output: List of books 	*
****************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');
//Get things out from session if user
if (IfIsUser($conn)) {
$sql_select = "SELECT * FROM tblusers WHERE user_name = '{$_SESSION['user_name']}' ";

	$result = $conn->query($sql_select);

	if($result) {
		$row = $result->fetch_assoc(); 
	    $user_id = $row['id'];
	    $full_name = $row['full_name'];
	}
}
//Get things out from session if admin 
else{
	$sql_select = "SELECT * FROM admin WHERE user_name = '{$_SESSION['user_name']}' ";

	$result = $conn->query($sql_select);

	if($result) {
		$row = $result->fetch_assoc(); 
	    $user_id = $row['id'];
	}
}

$action='';
if(isset($_GET['action']) && isset($_GET['id']))
{
	$action 	= $_GET['action'];
	$id 		= $_GET['id'];

	$sql = "SELECT * FROM tblbooks WHERE id={$id}";
	$result = $conn->query($sql);
	if($result && $result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$id 			= $row['id'];
		$book_pic 		= $row['book_pic'];
		$book_name 		= $row['book_name'];
		$book_name_urdu = $row['book_name_urdu'];
		$cat_id 		= $row['cat_id'];
		$author_id 		= $row['author_id'];
		$isbn_no 		= $row['isbn_number'];
		$price 			= $row['book_price'];
		$reg_date 		= $row['reg_date'];
		$updation_date 	= $row['updation_date'];
		$status 		= $row['status'];
	}
}

switch ($action) {
	case 'request':
	$sql = "INSERT INTO `tblissuedbooksdetail`(
			    `book_id`,
			    `user_id`,
			    `return_status`
			)
			VALUES( 
				{$id}, 
				{$user_id}, 
				3
			)";
	$result = $conn->query($sql);
	if($result)
	{
		$msg = "<div class='alert alert-success'>Book named,<strong>".$book_name."</strong> is Requested Succcessfully for you(<b>".$full_name."</b>).</div>";
	}
	else{
		$msg = "<div class='alert alert-danger'>Opss!Book named,<b>".$book_name."</b> is Not Requested Successfully, Please Try Again.</div>";
	}

		break;
	case 'delete':
	$sql = "DELETE FROM tblbooks WHERE id={$id}";
	$result = $conn->query($sql);
	if($result)
	{
		$msg = "<div class='alert alert-success'>Record Deleted Successfully.</div>";
	}
	else{
		$msg = "<div class='alert alert-danger'>Record Not Deleted Successfully.</div>";
	}

		break;

}
//Get Author ID & will output the books from that author_id (ENGLISH)
if (isset($_GET['author_id'])){
	$author_id = $_GET['author_id'];
	$sql = "SELECT 
					tblbooks.id,
					tblbooks.book_pic,
					tblbooks.book_name,
					tblbooks.book_name_urdu,
					tblcategory.category_name,
					tblauthors.author_name,
					tblbooks.isbn_number,
					tblbooks.book_price,
					tblbooks.status,#tblissuedbooksdetail.return_status,
					tblbooks.reg_date,
					tblbooks.updation_date
					FROM
					tblbooks
					INNER JOIN tblcategory ON tblbooks.cat_id=tblcategory.id 
					INNER JOIN tblauthors ON tblbooks.author_id=tblauthors.id 
					#INNER JOIN tblissuedbooksdetail ON tblbooks.status=tblissuedbooksdetail.id
					WHERE author_id={$author_id}
					ORDER BY id DESC";
}//Get Author ID & will output the books from that author_id_urdu (URDU)
elseif (isset($_GET['author_id_urdu'])){
	$author_id = $_GET['author_id_urdu'];
	$sql = "SELECT 
					tblbooks.id,
					tblbooks.book_pic,
					tblbooks.book_name,
					tblbooks.book_name_urdu,
					tblcategory.category_name,
					tblauthors.author_name_urdu,
					tblbooks.isbn_number,
					tblbooks.book_price,
					tblbooks.status,#tblissuedbooksdetail.return_status,
					tblbooks.reg_date,
					tblbooks.updation_date
					FROM
					tblbooks
					INNER JOIN tblcategory ON tblbooks.cat_id=tblcategory.id 
					INNER JOIN tblauthors ON tblbooks.author_id=tblauthors.id 
					#INNER JOIN tblissuedbooksdetail ON tblbooks.status=tblissuedbooksdetail.id
					WHERE author_id={$author_id}
					ORDER BY id DESC";
}//Get Category ID & will output the books from that cat_id
elseif (isset($_GET['cat_id'])){
	$cat_id = $_GET['cat_id'];
	$sql = "SELECT 
					tblbooks.id,
					tblbooks.book_pic,
					tblbooks.book_name,
					tblbooks.book_name_urdu,
					tblcategory.category_name,
					tblauthors.author_name,
					tblbooks.isbn_number,
					tblbooks.book_price,
					tblbooks.status,#tblissuedbooksdetail.return_status,
					tblbooks.reg_date,
					tblbooks.updation_date
					FROM
					tblbooks
					INNER JOIN tblcategory ON tblbooks.cat_id=tblcategory.id 
					INNER JOIN tblauthors ON tblbooks.author_id=tblauthors.id 
					#INNER JOIN tblissuedbooksdetail ON tblbooks.status=tblissuedbooksdetail.id
					WHERE cat_id={$cat_id}
					ORDER BY id DESC";
}else{

	$sql = "SELECT 
					tblbooks.id,
					tblbooks.book_pic,
					tblbooks.book_name,
					tblbooks.book_name_urdu,
					tblcategory.category_name,
					tblauthors.author_name,
					tblbooks.isbn_number,
					tblbooks.book_price,
					tblbooks.status,#tblissuedbooksdetail.return_status,
					tblbooks.reg_date,
					tblbooks.updation_date
					FROM
					tblbooks
					INNER JOIN tblcategory ON tblbooks.cat_id=tblcategory.id 
					INNER JOIN tblauthors ON tblbooks.author_id=tblauthors.id 
					#INNER JOIN tblissuedbooksdetail ON tblbooks.status=tblissuedbooksdetail.id
					ORDER BY id DESC";
}
if(isset($_POST['search']) && !empty($_POST['search'])){
	$search = trim($_POST['search']);
	$sql="SELECT 
				tblbooks.id,
				tblbooks.book_pic,
				tblbooks.book_name,
				tblbooks.book_name_urdu,
				tblcategory.category_name,
				tblauthors.author_name,
				tblbooks.isbn_number,
				tblbooks.book_price,
				tblbooks.status,#tblissuedbooksdetail.return_status,
				tblbooks.reg_date,
				tblbooks.updation_date
				FROM
				tblbooks 
				INNER JOIN tblcategory ON tblbooks.cat_id=tblcategory.id 
				INNER JOIN tblauthors ON tblbooks.author_id=tblauthors.id 
				#INNER JOIN tblissuedbooksdetail ON tblbooks.status=tblissuedbooksdetail.id
		WHERE book_name 	LIKE '%{$search}%'
		OR book_name_urdu 	LIKE '%{$search}%'
		OR author_name 		LIKE '%{$search}%'
		OR category_name 	LIKE '%{$search}%'
		OR tblbooks.status 	LIKE '%{$search}%'
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
									<a class="navbar-brand" href="book_list.php">Book List</a>
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
									<?php if (IfIsUser($conn)) {?>
									<?php } else { ?>
										<a class="btn btn-outline-primary" href="<?php echo WEBSITE_URL. 'book_add.php' ?>" role="button">Add New</a>
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
											<th>Book Picture</th>
											<th>Book Name</th>
											<th class="urdu">کتاب کا نام</th>
											<th>Category</th>
											<th 
												<?php 
													if (isset($_GET['author_id_urdu'])) {
														$author_id_urdu = $_GET['author_id_urdu'];
													}else{
														$author_id_urdu = '';
													}
													if ($author_id_urdu) { echo "class=urdu"; }
												?>
											><?php if ($author_id_urdu) { echo "مصنف کا نام"; }else{ echo "Author"; } ?></th>
											<th>ISBN No.</th>
											<th>Price</th>
											<th>Status</th>
											<?php if (IfIsUser($conn)) { } else { ?>
												<th>Reg. Date</th>
												<th>Updt. Date</th>
											<?php } ?>
											<?php if (IfIsUser($conn)) { ?>
												<th>Request</th>
											<?php } else { ?>
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
											<td class="img">
												<?php 
												if(empty($row['book_pic']))
												{												
													echo "<p class='initialism text-center'>Picture <b>Not</b> <br />Available</p>"; 
												}
												else{
													echo "<img width='55in' class='img-responsive' src='".WEBSITE_URL."./images/book_pic/".$row['book_pic']."'/>"; 
												}
												?>
											</td>
											<td><?php echo $row['book_name']; ?></td>
											<td class="urdu"><?php echo $row['book_name_urdu']; ?></td>
											<td><?php echo $row['category_name']; ?></td>
											<td <?php if ($author_id_urdu) { echo "class='urdu'"; } ?>>
												<?php 
												if (!$author_id_urdu) {
													echo $row['author_name'];
												}else{
													echo $row['author_name_urdu'];
												}
												?>
											</td>
											<td><?php echo $row['isbn_number']; ?></td>
											<td><?php echo $row['book_price']; ?></td>
											<td><?php GetReturnStatus($row['status']); ?></td>
											<?php if (IfIsUser($conn)) { } else { ?>
												<td><?php echo $row['reg_date']; ?></td>
												<td><?php echo $row['updation_date']; ?></td>
											<?php } ?>
											<?php if (IfIsUser($conn)) {?>
												<td>
													<button role="button" class="btn btn-warning btn-sm">
														<a class="" href="<?php echo WEBSITE_URL.'book_list.php?action=request&id='.$row['id']; ?>">
															<i class="fa fa-envelope fa-2x"></i>
														</a>
													</button>
												</td>
											<?php } else { ?>
												<td>
													<button role="button" class="btn btn-warning btn-sm">
														<a href="<?php echo WEBSITE_URL. 'book_add.php?id='.$row['id']; ?> ">
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
											
											}elseif (isset($_GET['author_id'])) {
												$author_id = $_GET['author_id'];
												$total_books = GetTotalWhere($conn, TBLBOOKS, 'author_id', $author_id);
												echo "Showing total <b>".$total_books."</b> of <b>".$total_books."</b> result(s).";
											}elseif ($author_id_urdu) {
												$total_books = GetTotalWhere($conn, TBLBOOKS, 'author_id', $author_id_urdu);
												echo "Showing total <b>".$total_books."</b> of <b>".$total_books."</b> result(s).";
											}elseif (isset($_GET['cat_id'])) {
												$cat_id = $_GET['cat_id'];
												$total_books = GetTotalWhere($conn, TBLBOOKS, 'cat_id', $cat_id);
												echo "Showing total <b>".$total_books."</b> of <b>".$total_books."</b> result(s).";
											}else{
											
												$total_books = GetTotal($conn, TBLBOOKS);
												echo "Showing total <b>".$total_books."</b> of <b>".$total_books."</b> result(s).";
											
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
  if (confirm("Are you sure? you want to delete this record.Remember: It can't be recovered.")) {
   window.location.href = "<?php echo WEBSITE_URL. 'book_list.php?action=delete&id=' ?>"+id;
  }
  header("location:<?php echo WEBSITE_URL. 'book_list.php' ?>");
}
</script>