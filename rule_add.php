<?php 

/****************************
* File Name: rule_add.php 	*
* Author: Ammar S.A.A 		*
* Output: Form to add Rule 	*
****************************/

require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
require(WEBSITE_PATH.'./includes/session.php');
include(WEBSITE_PATH.'./includes/header.php');
include(WEBSITE_PATH.'./includes/logo.php');
include(WEBSITE_PATH.'./includes/menu.php');

if (isset($_POST['rule-add']))
{
	
	$rule 			= trim($_POST['rule']);
	$rule_urdu 		= trim($_POST['rule_urdu']);

	if (isset($_GET['id']))
	{
		$sql = "UPDATE `tblrulesandregulations` SET 
		`rule` 			= ?,
		`rule_urdu` 	= ?
		WHERE id={$_POST['id']}";

		// prepare and bind
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ssss",$rule,$rule_urdu);
	}
	else
	{
		if (IfExist(TBLRULESANDREGULATIONS, 'rule', $rule)) {
				$msg = "<div class='alert alert-info'>Duplicate Entry for <strong>".$rule."</strong> To View Rules' List Click/Tap <a href='".WEBSITE_URL."/rule_list.php'>HERE</a>.</div>";
		}
		elseif (IfExist(TBLRULESANDREGULATIONS, 'rule_urdu', $rule_urdu)) {
				$msg = "<div class='alert alert-info urdu'><p><strong>".$rule_urdu."</strong>کا اندراج پہلے ہی ہو چکا ہے۔ مکمل لسٹ دیکھنے کے لئے  <a class='btn btn-sm' href='".WEBSITE_URL."/rule_list.php'>یہاں</a> کلک/ٹیپ کریں۔ </p></div>";
		}
		else
		{
			$sql = "INSERT INTO `tblrulesandregulations`(`rule`, `rule_urdu`)
				VALUES (?,?)";
			
			// prepare and bind
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ssss",$rule,$rule_urdu,$categories,$tags);
		}
	}
	//$result = $conn->query($sql);
	$result = $stmt->execute();

	if ($result)
	{
		$msg = "<div class='alert alert-success'>Rule Entered Successfully To View Rule Click/Tap <a href='".WEBSITE_URL."/rule_list.php'>HERE</a>😀.</div>";	
	}
	else{
		$msg = "<div class='alert alert-danger'>Errors Occured.</div>";	
	}
	
}

$rule 			= '';
$rule_urdu 		= '';

if (isset($_GET['id']))
{
$select = "SELECT * FROM `tblrulesandregulations` where id={$_GET['id']}";
$result = $conn->query($select);
	if ($result && $result->num_rows > 0){
		$row = $result->fetch_assoc();
		$id 			= $row['id'];
		$rule 			= $row['rule'];
		$rule_urdu 		= $row['rule_urdu'];
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
								<h2>Add Rule
									<hr/>
								</h2>
							</div>
						</div>
						<div class="col">
							<div class="col">
								<!--Adding Rule Form-->
								<form name="rule-add" method="post" action="#">
									<br />
									<input type="hidden" name="rule-add" value="rule-add" />
									<input type="hidden" name="id" value="<?php echo $id;?>" />
									<span class="f-img fa fa-list fa-5x"></span>
									<br />
									<small>Rule Info</small>
									<p class="labelenglish"><b>Rule:</b></p>
									<textarea type="text" name="rule" class="blank" value=""><?php echo $rule; ?></textarea> 
									<p class="labelurdu"><b>:اصول</b></p>
									<textarea type="text" name="rule_urdu" class="blank urdu" value=""><?php echo $rule_urdu; ?></textarea>
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