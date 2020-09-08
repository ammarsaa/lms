<?php 

/****************************
* File Name: feedback.php 	*
* Author: Ammar S.A.A 		*
* Output: Feedback Page 	*
****************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');

$sql_select = "SELECT * FROM tblusers WHERE user_name = '{$_SESSION['user_name']}' ";

$sql = $conn->query($sql_select);

while($row = mysqli_fetch_array($sql)) {

    $id 				= $row['id'];
    $full_name 			= $row['full_name'];
    $email_id 			= $row['email_id'];
    $user_name 			= $row['user_name'];
    $status 			= $row['status'];
    $profile_picture 	= $row['profile_picture'];
}

if(isset($_POST['feedback_form'])) {

    $user_id 		= $id;
    $email 			= trim($email_id);
    $feedback 		= trim($_POST['feedback']);
    $feedback_urdu 	= trim($_POST['feedback_urdu']);
    //$creation_date 	= now();

    if (!empty($feedback) || !empty($feedback_urdu)) {

        $sql = "INSERT INTO 
        		tblfeedback 
        			(user_id, 
        			email_id, 
        			feedback, 
        			feedback_urdu,
        			creation_date) 
        		VALUES 
        		({$user_id},
        		'{$email}', 
        		'{$feedback}', 
        		'{$feedback_urdu}',
        		now())";

        $result = $conn->query($sql);

        if ($result) {
        	$msg = "<div class='alert alert-success text-capitalize'>thanks for your Feedback.</div>";
        }else{
        	$msg = "<div class='alert alert-danger text-capitalize'>Opss! Errors occured, please try again.</div>";
        }
    }else{
    	$msg = "<div class='alert alert-danger'>Opss! You have to fill atleast ONE FIELD.</div>";
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
	                	<!--Feedback Form-->
							<form action="#" method="post" role="feedbac_form">
							<br/>
                				<input type="hidden" name="feedback_form" value="feedback_form" />
                				<input type="hidden" name="id" value="<?php echo $id; ?>" />
                				<img class="f-img img-circle" src="<?php echo WEBSITE_URL; ?>/images/profile_pictures/<?php if(empty($profile_picture)){ echo '../monitor_mlms.png'; }else{ echo $profile_picture; } ?>" />
                				<h2>Your Feedback</h2>
								<p class="labelenglish"><b>Feedback:</b></p>
								<textarea name="feedback" class="blank" rows="3"></textarea>
								<p class="labelurdu"><b>:رائے</b></p>
								<textarea name="feedback_urdu" class="urdu blank" rows="3"></textarea>
								<div>
									<input type="reset" value="Reset" name="reset" class="btn btn-success" />
									<input type="submit" value="Submit" name="submit" class="btn btn-success" />
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