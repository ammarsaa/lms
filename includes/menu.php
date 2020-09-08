<?php  

/***********************************
* File Name: menu.php              *
* Author: Ammar S.A.A              *
* Output: User/Admin Menu/Navbar   *
***********************************/

include (WEBSITE_PATH.'./includes/functions.php');

if (IfIsUser($conn)) {
	if (isset($_SESSION['user_name'])) {
		//Getting things out from user session query
		$sql_select = "SELECT * FROM tblusers WHERE user_name = '{$_SESSION['user_name']}' ";
		    
	  $sql = $conn->query($sql_select);
	    
	  while($row = mysqli_fetch_array($sql)) {
	    
	    $user_id        	= $row['id'];
	    $full_name        = $row['full_name'];
	    $email_id         = $row['email_id'];
	    $user_name        = $row['user_name'];
	    $password         = $row['password'];
	    $mobile_no        = $row['mobile_no'];
	    $status 					= $row['status'];
	    $profile_picture 	= $row['profile_picture'];
	    $reg_date         = $row['reg_date'];
	    $updation_date    = $row['updation_date'];
		}
	}
}else{
	if (isset($_SESSION['user_name'])) {
		//Getting things out from admin session query
		$sql_select = "SELECT * FROM admin WHERE user_name = '{$_SESSION['user_name']}' ";
		    
	  $sql = $conn->query($sql_select);
	    
	  while($row = mysqli_fetch_array($sql)) {
	    
	    $user_id        	= $row['id'];
	    $full_name        = $row['full_name'];
	    $email_id         = $row['admin_email'];
	    $user_name        = $row['user_name'];
	    $password         = $row['password'];
	    $reg_date         = $row['reg_date'];
	    $updation_date    = $row['updation_date'];
	    $status 					= $row['status'];
	    $profile_picture 	= $row['profile_picture'];
		}
	}
}

?>

        <div class="row">
					<div class="col" id="bs-example-navbar-collapse-1">
						<!--Navbar Start-->
						<nav class="site-header sticky-top py-1 navbar nav-hover navbar-expand-lg navbar-light bg-light" height="250px">
 							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    						<span class="fa fa-2x fa-circle-o fa-spin text-dark"></span>
  						</button>
							<div class="collapse navbar-collapse" id="navbarSupportedContent">
  							<ul class="navbar-nav mr-auto">
                  <!--User Menu/Nav Start-->
                  <?php if(!empty($_SESSION['user_name'])){ if (IfIsUser($conn)) { ?>
                  <li class="nav-item">
                    <a class="nav-link" href="dashboard.php"><b>Dashboard</b></a>
                  </li>
									<li class="nav-item">
										<a class="nav-link" href="author_list.php"><b>Authors</b></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="book_list.php"><b>Books</b></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="category_list.php"><b>Categories</b></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="issuedbooks_list.php?action=requested"><b>Requested Books</b></a>
									</li>
                  <li class="nav-item">
										<a class="nav-link" href="rule_list.php"><b>Rules & Regulations</b></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="profile.php">
											<img class="img-responsive fixed-circle" width="20px" src="<?php echo WEBSITE_URL; ?>/images/profile_pictures/<?php if(!empty($profile_picture)){echo $profile_picture;} ?>" /><b> Profile</b>
										</a>
									</li>
									<li class="nav-item">
                      <a class="nav-link" href="feedback.php"><b>Feedback</b></a>
                  </li>
                  <!--User Menu/Nav End-->
                  <?php }else{ ?>
                  <li class="nav-item">
                      <a class="nav-link" href="dashboard.php"><b>Dashboard</b></a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="author_list.php" role="btn btn-success" aria-haspopup="true" aria-expanded="false"><b>Authors</b></a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="author_add.php">Add Author</a>
                      <a class="dropdown-item" href="author_list.php">Authors List</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="book_list.php" role="btn btn-success" aria-haspopup="true" aria-expanded="false"><b>Books</b></a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="book_add.php">Add Book</a>
                      <a class="dropdown-item" href="book_list.php">Books List</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="list_category.php" role="btn btn-success" aria-haspopup="true" aria-expanded="false"><b>Categories</b></a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="category_add.php">Add Category</a>
                      <a class="dropdown-item" href="category_list.php">Category List</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="issuedbooks_list.php?action=issued" role="btn btn-success" aria-haspopup="true" aria-expanded="false"><b>Issue Books</b></a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="issuebook.php">Issue Book</a>
                      <a class="dropdown-item" href="issuedbooks_list.php?action=issued">Issued Books</a>
                    	<a class="dropdown-item" href="issuedbooks_list.php?action=returned">Returned Books</a>
                      <a class="dropdown-item" href="issuedbooks_list.php?action=requested">Requested Books</a>
                      <a class="dropdown-item" href="issuedbooks_list.php">Issued Returned & <br> Requested Books</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="rule_list.php" role="btn btn-success" aria-haspopup="true" aria-expanded="false"><b>Rules & Regulations</b></a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="rule_add.php">Add Rule</a>
                      <a class="dropdown-item" href="rule_list.php">Rules & Regulations</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo WEBSITE_URL. 'users.php'?>"><b>Users</b></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="feedback_list.php"><b>Feedbacks</b></a>
                  </li>
									<li class="nav-item">
										<a class="nav-link" href="profile.php">
											<img class="img-responsive fixed-circle" width="20px" src="<?php echo WEBSITE_URL; ?>/images/profile_pictures/<?php if(!empty($profile_picture)){echo $profile_picture;} ?>" /><b> Profile</b>
										</a>
									</li>
                  <!--<li class="nav-item">
                        <a class="nav-link" href="admin.php"><b>Admins</b></a>
                  </li>-->
                <?php } }else{?>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php"><b>Admin Login</b></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?action=users"><b>User Login</b></a>
                  </li>
            <!--	<li class="nav-item">
                    <a class="nav-link" href="user-signup.php"><b>User Signup</b></a>
                  </li>	-->
                  <?php }?>
                </ul>
              </div>
            </nav>
            <!--Navbar End-->
          </div>
        </div>
      </section>