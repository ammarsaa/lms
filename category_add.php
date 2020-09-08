<?php

/************************************
* File Name: category_add.php 		*
* Author: Ammar S.A.A 				*
* Output: Form to add new category 	*
************************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');

// perform user signup
if (isset($_POST['category']))
{
	
	$category_name 	= trim($_POST['category-name']);
	$status 		= ($_POST['status']);

	if (!empty($category_name) && !empty($status)){
		//Update Query
		if (isset($_GET['id'])){
			$sql = "UPDATE `tblcategory` SET 
			`category_name` = '{$category_name}',
			`status` 		= '{$status}' 
			WHERE id={$_POST['id']}";
		}
		else{
			if (IfExist(TBLCATEGORIES, 'category_name', $category_name)) {
				$msg = "<div class='alert alert-info'>Duplicate Entry for <strong>".$category_name."</strong> To View Category List Click/Tap <a href='".WEBSITE_URL."/category_list.php'>HERE</a>.</div>";
			}else{
			//Insert Query
			$sql = "INSERT INTO `tblcategory`
				(`category_name`, `status`) 
				VALUES 
				('{$category_name}','{$status}')";
				
				$result = $conn->query($sql);
				
				if ($result)
				{ 
					$msg = "<div class='alert alert-success'>Entry Successful To View Category Click/Tap <a href='".WEBSITE_URL."/category_list.php'>HERE</a>😀.</div>";	
				}else{
					$msg = "<div class='alert alert-danger'>Errors Occured!</div>";	
				}
			}
		}
		
	}else{
		$msg = "<div class='alert alert-danger'>Category Or Status Cannot Be Empty.</div>";		
	}
}

$category_name 	= '';
$status			= '';

if (isset($_GET['id'])){

$select = "SELECT * FROM `tblcategory` WHERE id={$_GET['id']}";
$result = $conn->query($select);

	if ($result && $result->num_rows > 0){
	
		$row = $result->fetch_assoc();
		
		$id 			= $row['id'];
		$category_name 	= $row['category_name'];
		$status 		= $row['status'];
	
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
								<h2>Add Category <hr/></h2>
							</div>
						</div>
						<div class="col">
							<!--Category Adding Form-->
							<form class="form" name="category" method="post" action="#">
								<br />
								<input type="hidden" name="category" value="category" />
								<input type="hidden" name="id" value="<?php echo $id;?>" />
								<span class="f-img fa fa-file-zip-o fa-5x"></span>
								<h5>Category Info</h5>
								<p class="labelenglish"><b>Category Name:</b></p>
								<input type="text" name="category-name" class="blank form-control-lg" value="<?php echo $category_name ?>" />  
								<p class="labelenglish"><b>Status:</b></p><br />
								<div class="form-check form-check-inline" name="status">
									<input class="form-check-input" type="radio" name="status" value="Active" checked />
									<label class="form-check-label" for="status">
										Active
									</label>
								</div>
								<div class="form-check form-check-inline" name="status">
									<input class="form-check-input" type="radio" name="status" value="Inactive" />
									<label class="form-check-label" for="status"> 
										Inactive
									</label>
								</div>
								<div>
									<input type="reset" name="reset" value="Reset"  class="btn btn-success" />
									<?php 

									if (isset($_GET['id'])) {
										echo "<input type='submit' name='submit' value='Update'  class='btn btn-success' />";
									}
									else{
										echo "<input type='submit' name='submit' value='Add'  class='btn btn-success' />";
									}

									?>
								</div>
								<br />
							</form>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
<?php
	include(WEBSITE_PATH.'./includes/footer.php');
?>