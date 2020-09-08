<?php

/********************************
* File Name: user-signup.php 	*
* Author: Ammar S.A.A 			*
* Output: User Signup Form 		*
********************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');

// perform user signup
if (isset($_POST['user-signup']))
{
	
	$full_name 			= trim($_POST['full_name']);
	$email_id 			= trim($_POST['email_id']);
	$password 			= $_POST['password'];
	$mobile_no 			= trim($_POST['mobile_no']);
	$status 			= $_POST['status'];
	$user_name 			= trim($_POST['user_name']);
	$profile_picture 	= $_FILES['profile_picture']['name'];
	$profile_pic_tmp 	= $_FILES['profile_picture']['tmp_name'];

	//Moves uploaded Profile Pictures to a permenent location
	move_uploaded_file($profile_pic_tmp,"./images/profile_pictures/$profile_picture");
	
	if (!empty($email_id) && !empty($password)){
		if (isset($_GET['id']))
		{
			if(empty($profile_picture)) 
			{    
				$sql_profile_pic = "SELECT * FROM `tblusers` WHERE id = '{$_GET['id']}' ";

				$sql = $conn->query($sql_profile_pic);

				while($row = mysqli_fetch_array($sql)) {
				    $profile_picture   = $row['profile_picture'];
				}

			}
			$sql = "UPDATE tblusers SET 
        	`full_name` 			= '{$full_name}',
        	`email_id` 				= '{$email_id}',
			`mobile_no` 			= '{$mobile_no}',
			`user_name` 			= '{$user_name}',
			`status` 				= '{$status}',
			`password` 				= '{$password}',
			`profile_picture` 		= '{$profile_picture}'
        	WHERE id = {$_POST['id']}";
		}
		else{
			$sql = "INSERT INTO `tblusers`(`full_name`, `email_id`, `mobile_no`, `user_name`, `password`, `profile_picture`) 
				VALUES ('{$full_name}','{$email_id}','{$mobile_no}', '{$user_name}', '{$profile_picture}','{$password}')";
		}
		$result = $conn->query($sql);
		if ($result)
		{
			$msg = "<div class='alert alert-success text-capitalize'>Registration successful!</div>";	
		}else{
			$msg = "<div class='alert alert-danger text-capitalize'>Errors occured! or if you has changed the user name so this user name(".$user_name.") already exist.</div>";
		}
	}else{
		$msg = "E-mail or Password can not be empty";
	}
}

$full_name 	= '';
$email_id 	= '';
$mobile_no 	= '';
$user_name 	= '';
$password 	= '';
$status 	= '';
$profile_picture   = '';

if (isset($_GET['id']))
{
$select = "SELECT * FROM `tblusers` where id={$_GET['id']}";
$result = $conn->query($select);
	if ($result && $result->num_rows > 0){
		$row = $result->fetch_assoc();
		$id 		= $row['id'];
		$full_name 	= $row['full_name'];
		$email_id 	= $row['email_id'];
		$user_name 	= $row['user_name'];
		$password 	= $row['password'];
		$mobile_no 	= $row['mobile_no'];
		$status 	= $row['status'];
		$profile_picture   = $row['profile_picture'];
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
								<!--SignUp Form-->
								<form class="" name="user-signup" method="post" action="#" enctype="multipart/form-data" onsubmit="return checkForm(this);">
									<br />
									<input type="hidden" name="user-signup" value="user-signup" />
									<input type="hidden" name="id" value="<?php echo $id;?>" />
									<img class="f-img img-circle" src="<?php echo WEBSITE_URL; ?>/images/profile_pictures/<?php if(empty($profile_picture)){ echo '../monitor_mlms.png'; }else{ echo $profile_picture; } ?>" />
									<h2>User</h2>
									<p>Signup Form</p>
									<p class="labelenglish"><b>Profile Picture:</b></p>
									<input type="file" accept="img/*" value="<?php echo $profile_picture ?>" name="profile_picture" class="labelenglish text-uppercase" />
									<p class="labelenglish"><small><b>Note:</b><br /> Your <b class="text-uppercase text-right"><?php if(empty($profile_picture)){ echo 'Profile Picture'; }else{ echo $profile_picture; } ?></b> must not be more than <b>11 MB</b>.</small></p>
									<p class="labelenglish"><b>Full Name:</b></p>
									<input title="Enter your full name" value="<?php echo $full_name ?>" type="text" name="full_name" pattern="\w+++" class="blank" required />  
									<p class="labelenglish"><b>E-mail:</b></p>
									<input type="email" value="<?php echo $email_id ?>" name="email_id" class="blank" required />
									<p class="labelenglish"><b>User Name:</b></p>
									<input type="text" value="<?php echo $user_name ?>" name="user_name" class="blank" required />
									
									<p class="labelenglish"><b>Password:</b></p> 
									<input value="<?php echo $password ?>" type="password"  name="password" class="blank" required 
									
									title="Password must contain at least 6 characters, including UPPER/lowercase and
										numbers"
									pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
  									if(this.checkValidity()) form.con_pass.pattern = RegExp.escape(this.value)";/>
									
									<p class="labelenglish"><b>Confirm Password:</b></p>
									<input value="<?php echo $password ?>" class="blank" name="con_pass" type="password" required
									
										title="Please enter the same Password as above" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
										onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
									">
									
									<p class="labelenglish"><b>Mobile No.:</b></p>
									<input type="text" value="<?php echo $mobile_no ?>" name="mobile_no" class="blank" required />
									<?php 	

									if (isset($_GET["id"])) {

									?>
									<p class="labelenglish"><b>Status:</b></p><br />
									<div class="form-check form-check-inline" name="status">
										<input class="form-check-input" type="radio" name="status" value="Active" <?php if ($status='Active') { echo "checked"; ?> />
										<label class="form-check-label" for="status">
											Active
										</label>
									</div>
									<div class="form-check form-check-inline" name="status">
										<input class="form-check-input" type="radio" name="status" value="Inactive" <?php }else{ echo "checked" ; } ?> />
										<label class="form-check-label" for="status"> 
											Inactive
									  	</label>
									</div>
									<?php } ?>
									<div>
										<input type="reset" name="reset" value="Reset"  class="btn btn-success"/>
										<?php 

										if (isset($_GET['id'])) {
											echo "<input type='submit' name='submit' value='Update'  class='btn btn-success' />";
										}
										else{
											echo "<input type='submit' name='submit' value='Signup'  class='btn btn-success' />";
										}

										?>
									</div>
									<p>By signing up you agree our <a href="<?php echo WEBSITE_URL; ?>./rule_list.php">RULES AND REGULATIONS</a>.</p>
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