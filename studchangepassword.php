<?php
include("header.php");

if(!isset($_SESSION['studentid']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_POST['submit']))
{
	//4. update statement starts 
	$sql = "UPDATE student SET password='$_POST[newpassword]' WHERE password='$_POST[oldpassword]' AND studentid='$_SESSION[studentid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<script>alert('Student Password updated successfully..');</script>";
	}
	else
	{
		echo "<script>alert('Failed to Update password..');</script>";
	}
	//4. update statement ends here
}
?>
     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">
<form id="contact-form" role="form" action="" method="post" enctype="multipart/form-data">


	<div class="col-md-3 col-sm-12"></div>
	
	<div class="col-md-6 col-sm-12">
			  <div class="section-title">
				   <h2>Change Password<small>Enter Old Password and New Password to Change Password!</small></h2>
			  </div>

			  <div class="col-md-12 col-sm-12">
			  
							
				<label>Old Password:</label>
				<input type="password" class="form-control" placeholder="Enter the old password" name="oldpassword"  >
				
				<label>New Password:</label>
				<input type="password" class="form-control" placeholder="Enter the new password" name="newpassword" >
				
				<label>Confirm Password:</label>
				<input type="password" class="form-control" placeholder="Enter the confirm password" name="confirmpassword"  >
				
			  </div>

			  <div class="col-md-4 col-sm-12">
			  <Br></br>
				  <input type="submit" class="form-control" name="submit" value="Update Password">
			  </div>

	</div>

	<div class="col-md-3 col-sm-12">
		 
	</div>
</form>
               </div>
          </div>
     </section>       
<?php
include("footer.php");
?>