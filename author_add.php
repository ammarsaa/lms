<?php

/****************************************
* File Name: author_add.php 			*
* Author: Ammar S.A.A 					*
* Output: Form to add/update author 	*
****************************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');

// perform user signup
if (isset($_POST['author-add']))
{
	
	$author_name 		= trim($_POST['author_name']);
	$author_name_urdu 	= trim($_POST['author_name_urdu']);

	if (isset($_GET['id']))
		{
			$sql = "UPDATE `tblauthors` SET 
			`author_name` 		= ?,
			`author_name_urdu` 	= ? 
			WHERE id={$_POST['id']}";

			// prepare and bind
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ss",$author_name,$author_name_urdu);
		}else{
			
			if (IfExist(TBLAUTHORS,'author_name',$author_name)) {
				$msg = "<div class='alert alert-info'>Duplicate Entry for <strong>".$author_name."</strong> To View Authors' List Click/Tap <a href='".WEBSITE_URL."/author_list.php'>HERE</a>.</div>";
			}elseif (IfExist(TBLAUTHORS,'author_name_urdu',$author_name_urdu)) {
				$msg = "<div class='alert alert-info urdu'><p><strong>".$author_name_urdu."</strong>کا اندراج پہلے ہی ہو چکا ہے۔ مکمل لسٹ دیکھنے کے لئے  <a class='' href='".WEBSITE_URL."/author_list.php'>یہاں</a> کلک/ٹیپ کریں۔ </p></div>";
			}else{

				$sql = "INSERT INTO `tblauthors`(`author_name`, `author_name_urdu`)
					VALUES (?,?)";
				
				// prepare and bind
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("ss",$author_name,$author_name_urdu);
				//$result = $conn->query($sql);
				$result = $stmt->execute();
				
				if ($result)
				{
					$msg = "<div class='alert alert-success'>Entry Successful😀.</div>";	
				}
				else{
					$msg = "<div class='alert alert-danger'>Errors Occured.</div>";	
				}
			}
		}

}

$author_name 		='';
$author_name_urdu 	='';


if (isset($_GET['id']))
{
$select = "SELECT * FROM `tblauthors` where id={$_GET['id']}";
$result = $conn->query($select);
	if ($result && $result->num_rows > 0){
		$row = $result->fetch_assoc();
		$id 				= $row['id'];
		$author_name 		= $row['author_name'];
		$author_name_urdu 	= $row['author_name_urdu'];
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
								<h2>Add Author<hr/></h2>
							</div>
						</div>
						<div class="col">
							<div class="col">
								<!--Adding Author Form-->
								<form name="author-add" method="post" action="#">
									<br />
									<input type="hidden" name="author-add" value="author-add" />
									<input type="hidden" name="id" value="<?php echo $id;?>" />
									<span class="f-img fa fa-user fa-5x"></span>
									<p>Author Info</p>
									<p class="labelenglish"><b>Author Name:</b></p>
									<input type="text" name="author_name" class="blank" value="<?php echo $author_name; ?>" /> 
									<p class="labelurdu"><b>:مصنف کا نام </b></p>
									<input type="text" name="author_name_urdu" class="blank urdu" value="<?php echo $author_name_urdu; ?>" /> 
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
				</div>
			</section>
		</div>
	</div>
<?php
include(WEBSITE_PATH.'./includes/footer.php');
?>