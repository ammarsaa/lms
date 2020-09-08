<?php

/****************************
* File Name: book_add.php 	*
* Author: Ammar S.A.A 		*
* Output: Form to add Book 	*
****************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');

// perform user signup
if (isset($_POST['book-add']))
{
	
	$book_pic 			= $_FILES['book_pic']['name'];
	$book_pic_tmp 		= $_FILES['book_pic']['tmp_name'];
	$book_name 			= trim($_POST['book_name']);
	$book_name_urdu 	= trim($_POST['book_name_urdu']);
	$cat_id 			= ($_POST['cat_id']);
	$author_id 			= ($_POST['author_id']);
	$isbn_no  			= ($_POST['isbn_no']);
	$price 				= ($_POST['price']);
	
	//Moves uploaded Profile Pictures to a permenent location
	move_uploaded_file($book_pic_tmp,"./images/book_pic/$book_pic");

	if (!empty($book_name) && !empty($isbn_no) && !empty($cat_id) && !empty($author_id)  && !empty($price)){

		if (isset($_GET['id']))
			{
				$sql = "UPDATE `tblbooks` SET 
				`book_pic` 			= ?,
				`book_name` 		= ?,
				`book_name_urdu` 	= ?,
				`cat_id` 			= ?,
				`author_id` 		= ?,
				`isbn_number` 		= ?,
				`book_price` 		= ?
				WHERE id =?";

				// prepare and bind
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("tssiisdi",$book_pic,$book_name,$book_name_urdu,$cat_id,$author_id,$isbn_no,$price,$_POST['id']);

			}
			else{
				if (IfExist(TBLBOOKS, 'book_name', $book_name)) {
					$msg = "<div class='alert alert-info'>Duplicate Entry for <strong>".$book_name."</strong> To View Books' List Click/Tap <a href='".WEBSITE_URL."/book_list.php'>HERE</a>.</div>";
				}
				elseif (IfExist(TBLBOOKS, 'book_name_urdu', $book_name_urdu)) {
						$msg = "<div class='alert alert-info urdu'><p><strong>".$book_name_urdu."</strong>کا اندراج پہلے ہی ہو چکا ہے۔ مکمل لسٹ دیکھنے کے لئے  <a class='' href='".WEBSITE_URL."/book_list.php'>یہاں</a> کلک/ٹیپ کریں۔ </p></div>";
				}
				$sql = "INSERT INTO `tblbooks`(`book_pic`,`book_name`,`book_name_urdu`, `cat_id`, `author_id`, `isbn_number`, `book_price`)
					VALUES (?,?,?,?,?,?,?)";

				// prepare and bind
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("tssiisd",$book_pic,$book_name,$book_name_urdu,$cat_id,$author_id,$isbn_no,$price);
				
				//$result = $conn->query($sql);
				$result = $stmt->execute();
				
				if ($result)
					{
						$msg = "<div class='alert alert-success'>Book added/updated successfully😀, To View Books' List Click/Tap <a href='".WEBSITE_URL."/book_list.php'>HERE</a></div>";	
					}
					else{
						$msg = "<div class='alert alert-danger'>Errors occured</div>";	
					}
			}

	}
	else{
		$msg ="<div class='alert alert-danger'>Any Field can not be empty.(except Book Picture and Book Name Urdu)</div>";		
	}
}

$book_pic 		= '';
$book_name 		= '';
$book_name_urdu = '';
$cat_id 		= '';
$author_id 		= '';
$isbn_no 		= '';
$price 			= '';


if (isset($_GET['id']))
{
$select = "SELECT * FROM `tblbooks` WHERE id={$_GET['id']}";
$result = $conn->query($select);
	if ($result && $result->num_rows > 0){
		$row = $result->fetch_assoc();
		$id 			= $row['id'];
		$book_pic 		= $row['book_pic'];
		$book_name 		= $row['book_name'];
		$book_name_urdu = $row['book_name_urdu'];
		$cat_id 		= $row['cat_id'];
		$author_id 		= $row['author_id'];
		$isbn_no 		= $row['isbn_number'];
		$price 			= $row['book_price'];
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
								<h2>Add Book <hr/></h2>
							</div>
						</div>
						<div class="row">
							<div class="col col-sm-12 col-md-12 col-xsm-12">
								<!--Login Form-->
								<form name="book-add" method="post" action="#" enctype="multipart/form-data">
									<br />
									<input type="hidden" name="book-add" value="book-add" />
									<input type="hidden" name="id" value="<?php echo $id;?>" />
									<span class="f-img glyphicon glyphicon-book display-1"></span>
									<br />
									<small>Book Info</small>
									<p class="labelenglish"><b>Book Picture:</b></p>
									<input type="file" accept="img/*" value="<?php echo $book_pic ?>" name="book_pic" class="labelenglish text-uppercase" />
									<p class="labelenglish"><small><b>Note:</b><br /> Your <b class="text-uppercase text-right"><?php if(empty($book_pic)){ echo 'Book Picture'; }else{ echo $book_pic; } ?></b> must not be more than <b>11 MB</b>.</small></p>
									<p class="labelenglish"><b>Book Name:</b></p>
									<input type="text" name="book_name" value="<?php echo $book_name ?>" class="blank"  />
									<p class="labelurdu"><b>:کتاب کا نام</b></p>
									<input type="text" name="book_name_urdu" value="<?php echo $book_name_urdu ?>" class="blank urdu" />  
									<p class="labelenglish"><b>Category:</b></p>
									<select id="category" name="cat_id" class="blank form-control-lg" >
									
									<?php 
									
									$categories = GetCategories($conn);
									foreach ($categories as $row) {
									$is_selected ="";
										if($row['id'] == $cat_id)
										{
											$is_selected ="selected";

										}
										echo "<option class='blank' {$is_selected} value='{$row['id']}'>{$row['category_name']}</option>";
										} 
									
										?>
								    
								    </select>
									<p class="labelenglish"><b>Author:</b></p>
									<select id="author" name="author_id" class="blank" >
									
									<?php 
									
									$authors = GetAuthors($conn);
									foreach ($authors as $row) {
										$is_selected ="";
										if($row['id'] == $author_id)
										{
											$is_selected ="selected";
										}
										echo "<option {$is_selected} value='{$row['id']}'>{$row['author_name']}</option>";
										} 
									
										?>
								    
								    </select>
									<p class="labelenglish"><b>ISBN No.:</b></p>
									<input type="text" name="isbn_no" class="blank" value="<?php echo $isbn_no ?>"  />
									<p class="labelenglish"><b>Price:</b></p>
									<input type="number" name="price" class="blank" value="<?php echo $price ?>" />  									
  									<div>
										<input type="reset" name="reset" value="Reset"  class="btn btn-success"/>
									<?php
									if (isset($_GET['id'])) {
									 	echo '<input type="submit" name="submit" value="Update"  class="btn btn-success" />';
									}else{
										echo '<input type="submit" name="submit" value="Add"  class="btn btn-success" />';
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