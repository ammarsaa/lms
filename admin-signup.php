<?php

/********************************
* File Name: admin-signup.php 	*
* Author: Ammar S.A.A        	*
* Output: Admin Signup Form  	*
********************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');

// perform admin signup
if (isset($_POST['admin-signup']))
{
	
	$full_name 			= trim($_POST['full_name']);
	$admin_email 		= trim($_POST['admin_email']);
	$user_name 			= trim($_POST['user_name']);
	$password 			= $_POST['password'];
	$profile_picture 	= $_FILES['profile_picture']['name'];
	$profile_pic_tmp 	= $_FILES['profile_picture']['tmp_name'];

	//Moves uploaded Profile Pictures to a permenent location
	move_uploaded_file($profile_pic_tmp,"./images/profile_pictures/$profile_picture");
	

	if (!empty($admin_email) && !empty($password))
	{
		if (isset($_GET['id']))
		{
			if(empty($profile_picture)) 
			{    
				$sql_profile_pic = "SELECT * FROM `admin` WHERE id = '{$_GET['id']}' ";

				$sql = $conn->query($sql_profile_pic);

				while($row = mysqli_fetch_array($sql)) {
				    $profile_picture   = $row['profile_picture'];
				}

			}
			$sql = "UPDATE `admin` SET 
			`full_name` 		= '{$full_name}',
			`admin_email` 		= '{$admin_email}',
			`user_name` 		= '{$user_name}',
			`password` 			= '{$password}',
			`profile_picture` 	= '{$profile_picture}'
			WHERE id={$_POST['id']}";

			//$stmt= $conn->prepare($sql);
			//$stmt->bind_param("ssssssi", $full_name, $admin_email, $user_name, $password, $status, $profile_picture, $_POST['id']);

		}else{
			if (IfExist(TBLADMIN, 'user_name', $user_name)) {
				$msg = "<div class='alert alert-info'><strong>".$user_name."</strong> Already Exist,Please Choose Anothoer One.</div>";
			}else{
			$sql = "INSERT INTO `admin`(`full_name`, `admin_email`, `user_name`, `password`, `profile_picture`) 
				VALUES ('{$full_name}','{$admin_email}','{$user_name}','{$password}','{$profile_picture}')";
			}
		}
		$result = $conn->query($sql);
		//$result = $stmt->execute();
		if ($result)
		{
			$msg = "<div class='alert alert-success'>Registration successful! To View Amdins Click/Tap <a href='".WEBSITE_URL."./admin.php'>HERE</a>.</div>";	
		}else{
			$msg = "<div class='alert alert-danger'>Errors occured!</div>";
		}
	}else{
		$msg = "<div class='alert alert-danger'>E-mail or Password can not be empty.</div>";
	}
}

$full_name 			= '';
$admin_email 		= '';
$user_name 			= '';
$password 			= '';
$profile_picture 	= '';
$status 			= '';

if (isset($_GET['id']))
{
$select = "SELECT * FROM `admin` WHERE id={$_GET['id']}";
$result = $conn->query($select);
	if ($result && $result->num_rows > 0){
		$row = $result->fetch_assoc();
		$id 			= $row['id'];
		$full_name 		= $row['full_name'];
		$admin_email	= $row['admin_email'];
		$user_name 		= $row['user_name'];
		$password 		= $row['password'];
		$status 		= $row['status'];
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
								<form name="admin-signup" method="post" action="" onsubmit="return checkForm(this);" enctype="multipart/form-data">
									<br />
									<input type="hidden" name="admin-signup" value="admin-signup" />
									<input type="hidden" name="id" value="<?php echo $id;?>" />
									<img class="f-img img-circle" src="images/profile_pictures/<?php if(empty($profile_picture)){ echo 'MonitorMLMS.png'; }else{ echo $profile_picture; } ?>" />
									<h2>Admin</h2>
									<small>Signup Form</small>
									<p class="labelenglish"><b>Profile Picture:</b></p>
									<input type="file" accept="img/*" value="<?php echo $profile_picture; ?>" name="profile_picture" class="labelenglish text-uppercase text-right" />
									<p class="labelenglish"><small><b>Note:</b><br /> Your <b class="text-uppercase text-right"><?php if(empty($profile_picture)){ echo 'Profile Picture'; }else{ echo $profile_picture; } ?></b> must not be more than <b>11 MB</b>.</small></p>
									<p class="labelenglish"><b>Full Name:</b></p>
									<input title="Enter your full name" value="<?php echo $full_name; ?>" type="text" name="full_name" pattern="\w+++" class="blank" required />
									<p class="labelenglish"><b>E-mail:</b></p>
									<input title="Enter your E-mail" type="email" value="<?php echo $admin_email; ?>" name="admin_email" class="blank" required />
									<p class="labelenglish"><b>Admin Name:</b></p>
									<input title="Enter your user name" type="text" value="<?php echo $user_name; ?>" name="user_name" class="blank" required />
									
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

									<?php 	

									if (isset($_GET["id"])) {

									?>
									
									<p class="labelenglish"><b>Status:</b></p><br />
									<div class="form-check form-check-inline" name="status">
										<input class="form-check-input" type="radio" name="status" value="Active" checked <?php if ($status='Active') { echo "checked"; } ?> />
										<label class="form-check-label" for="status">
											Active
										</label>
									</div>
									<div class="form-check form-check-inline" name="status">
										<input class="form-check-input" type="radio" name="status" value="Inactive" <?php if ($status='Inactive') { echo "checked"; } ?> />
										<label class="form-check-label" for="status"> 
											Inactive
										</label>
									</div>

									<?php } ?>

									<div>
										<input type="reset" name="reset" value="Reset"  class="btn btn-success" />
										<?php 

										if (isset($_GET['id'])) {
											echo "<input type='submit' name='submit' value='Update'  class='btn btn-success' />";
										}
										else{
											echo "<input type='submit' name='submit' value='Signup'  class='btn btn-success' />";
										}

										?>
									</div>
									<p>By signing up you agree our <a href="<?php echo WEBSITE_URL; ?>./rule_list.php">Rules & Regulations</a>.</p>
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