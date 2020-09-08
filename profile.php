<?php 

/******************************
* File Name: profile.php      *
* Author: Ammar S.A.A         *
* Output: User/Admin Profile 	*
******************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');

if (IfIsUser($conn)) {
	
	$sql_select = "SELECT * FROM tblusers WHERE user_name = '{$_SESSION['user_name']}' ";
    
    $sql = $conn->query($sql_select);
    
    while($row = mysqli_fetch_array($sql)) {
    
        $id 				= $row['id'];
        $full_name 			= $row['full_name'];
        $email_id 			= $row['email_id'];
        $user_name 			= $row['user_name'];
        $password 			= $row['password'];
        $mobile_no 			= $row['mobile_no'];
        $status             = $row['status'];
        $profile_picture    = $row['profile_picture'];
        $reg_date 			= $row['reg_date'];
        $updation_date 		= $row['updation_date'];
    }
}else{
	$sql_select = "SELECT * FROM admin WHERE user_name = '{$_SESSION['user_name']}' ";

    $sql = $conn->query($sql_select);
    
    while($row =$sql->fetch_assoc()) {
    
        $id                = $row['id'];
        $full_name         = $row['full_name'];
        $email_id          = $row['admin_email'];
        $user_name         = $row['user_name'];
        $password          = $row['password'];
        $status            = $row['status'];
        $profile_picture   = $row['profile_picture'];
        $reg_date          = $row['reg_date'];
        $updation_date     = $row['updation_date'];
    }

}

?>
<?php 

if (IfIsUser($conn)) {
	
	if(isset($_POST['edit-profile'])) 
	{

	  $full_name         = trim($_POST['full_name']);
	  $email_id          = trim($_POST['email_id']);
	  $mobile_no         = trim($_POST['mobile_no']);
	  $username          = trim($_POST['username']);
	  $password          = $_POST['password'];
	  $profile_picture   = $_FILES['profile_picture']['name'];
	  $profile_pic_tmp   = $_FILES['profile_picture']['tmp_name'];
		
		move_uploaded_file($profile_pic_tmp,"./images/profile_pictures/$profile_picture");
    
		if (empty($profile_picture)) {
    	$sql= "SELECT * FROM `tblusers` WHERE id = '{$id}'";
    	$result = $conn->query($sql);
    	if ($result && $result->num_rows > 0) {
    		$row = $result->fetch_assoc();
    		$profile_picture   = $row['profile_picture'];
    	}
    }

	  $sql_update = "UPDATE tblusers SET 
	    `full_name`         = '{$full_name}',
	    `email_id`          = '{$email_id}',
	    `mobile_no`         = '{$mobile_no}',
	    `user_name`         = '{$username}',
	    `password`          = '{$password}',
	    `profile_picture`   = '{$profile_picture}'
	    WHERE id = {$_POST['id']}";

	    
	    // prepare and bind
	    //$stmt = $conn->prepare($sql_update); 
	    //$stmt->bind_param("ssssssi",$full_name,$email_id,$mobile_no,$username,$password,$profile_picture,$_POST['id']);

	  $result = $conn->query($sql_update);
	  //$result = $stmt->execute();

	  if ($result)
	  {
	    $msg = "<div class='alert alert-success'>Updation successful!</div>"; 
	  }else{
	    $msg = "<div class='alert alert-danger'>Errors occured!</div>";
	  }
  }
}else{

	if(isset($_POST['edit-profile'])) 
	{

	  $full_name         = trim($_POST['full_name']);
	  $email_id          = trim($_POST['email_id']);
	  $username          = trim($_POST['username']);
	  $password          = $_POST['password'];
	  $profile_picture   = $_FILES['profile_picture']['name'];
	  $profile_pic_tmp   = $_FILES['profile_picture']['tmp_name'];

		move_uploaded_file($profile_pic_tmp,"./images/profile_pictures/$profile_picture");
    
		if (empty($profile_picture)) {
    	$sql= "SELECT * FROM `admin` WHERE id = '{$id}'";
    	$result = $conn->query($sql);
    	if ($result && $result->num_rows > 0) {
    		$row = $result->fetch_assoc();
    		$profile_picture   = $row['profile_picture'];
    	}
    }

	  $sql_update = "UPDATE admin SET 
	    `full_name`         = '{$full_name}',
	    `admin_email` 			= '{$email_id}',
	    `user_name`         = '{$username}',
	    `password`          = '{$password}',
	    `profile_picture`   = '{$profile_picture}'
	    WHERE id = {$_POST['id']}";

	    // prepare and bind
	    //$stmt = $conn->prepare($sql_update); 
	    //$stmt->bind_param("ssssssi",$full_name,$email_id,$mobile_no,$username,$password,$profile_picture,$_POST['id']);

	  $result = $conn->query($sql_update);
	  //$result = $stmt->execute();

	  if ($result)
	  {
	    $msg = "<div class='alert alert-success'>Updation successful!</div>"; 
	  }else{
	    $msg = "<div class='alert alert-danger'>Errors occured!</div>";
	  }
	 }
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
                <!--Edit Profile Form-->
                <form action="#" method="post" enctype="multipart/form-data" name="edit-profile">
                	<br/>
                	<input type="hidden" name="edit-profile" value="edit-profile" />
                	<input type="hidden" name="id" value="<?php echo $id; ?>" />
                	<img class="f-img img-circle circle" src="<?php echo WEBSITE_URL; ?>/images/profile_pictures/<?php if(empty($profile_picture)){ echo '../monitor_mlms.png'; }else{ echo $profile_picture; } ?>" />
                	<h2>
                  	<?php echo $_SESSION["user_name"]; ?>
									</h2>
                	<p>Edit Profile Form</p>
                	<p class="labelenglish"><b>Full Name:</b></p>
                	<input type="readonly" value="<?php echo $full_name; ?>" class="blank" name="full_name">
                	<p class="labelenglish"><b>Email ID:</b></p>
                	<input type="text" value="<?php echo $email_id; ?>" class="blank" name="email_id">
                	<p class="labelenglish"><b>Profile Picture:</b></p>
                	<input class="labelenglish" type="file" accept="img/*" name="profile_picture" value="<?php echo $profile_picture; ?>">
                	<p class="labelenglish"><small><b>Note:</b><br /> Your <b class="text-uppercase text-right"><?php if(empty($profile_picture)){ echo 'Profile Picture'; }else{ echo $profile_picture; } ?></b> must not be more than <b>11.00 MB</b>.</small></p>
                	<p class="labelenglish"><b>User Name:</b></p>
                	<input type="text" value="<?php echo $user_name; ?>" class="blank" name="username">

                	<?php if (IfIsUser($conn)) { ?>
	                	<p class="labelenglish"><b>Mobile No.:</b></p>
										<input type="text" value="<?php echo $mobile_no ?>" name="mobile_no" class="blank" required />
                	<?php } ?>

                	<p class="labelenglish"><b>Password:</b></p>
                	<input value="<?php echo $password; ?>" type="password"  name="password" class="blank" required 
                  
                  title="Password must contain at least 6 characters, including UPPER/lowercase and
                    numbers"
                  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
                    if(this.checkValidity()) form.con_pass.pattern = RegExp.escape(this.value)";/>
                  
                	<p class="labelenglish"><b>Confirm Password:</b></p>
                	<input value="<?php echo $password; ?>" class="blank" name="con_pass" type="password" required
                  
                    title="Please enter the same Password as above" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                    onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');">

                	<div>
                    	<input type="reset" name="reset" value="Reset"  class="btn btn-success"/>
                    	<input type='submit' name='submit' value='Update'  class='btn btn-success' />
                  </div>
            <!--
                  <p class="labelenglish"><b>Status:</b></p> 
                  <div class="form-check form-check-inline" name="status">
                    <input class="form-check-input" type="radio" name="status" value="Active" <?php if ($status='Active') { echo "checked" ; } ?> />
                    <label class="form-check-label" for="status">
                      Active
                    </label>
                  </div>
                  <div class="form-check form-check-inline" name="status">
                    <input class="form-check-input" type="radio" name="status" value="Inactive" <?php if ($status='Inactive') { echo "checked" ; } ?> />
                    <label class="form-check-label" for="status"> 
                      Inactive
                    </label>
                  </div>
            -->

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