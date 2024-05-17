<?php
include("header.php");
if(!isset($_SESSION['librarian_id']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_POST['submit']))
{
	if(isset($_SESSION['librarian_id']))
	{
		//4. update statement starts here
		$sql = "UPDATE librarian SET  name='$_POST[name]',loginid='$_POST[loginid]' WHERE librarian_id='$_SESSION[librarian_id]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Librarian details updated successfully..');</script>";
		}
		//4. update statement ends 
	}
}

//Step 2 : Select statement to update record starts here
if(isset($_SESSION['librarian_id']))
{
	$sqledit = "SELECT * FROM librarian WHERE librarian_id='$_SESSION[librarian_id]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//Step 2 : Select statement to update record starts here

?>
     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">
<form id="contact-form" role="form" action="" method="post">
	<div class="col-md-6 col-sm-12">
			  <div class="section-title">
				   <h2>Librarian Profile<small>Enter librarian details!</small></h2>
			  </div>

			  <div class="col-md-12 col-sm-12">
			  
				
				<label>Name:</label>
				<input type="text" class="form-control" placeholder="Enter the name" name="name" value="<?php echo $rsedit['name']; ?>">
				
				
				<label>Login ID:</label>
				<input type="text" class="form-control" placeholder="Enter the login ID" name="loginid" value="<?php echo $rsedit['loginid']; ?>">
				
			  </div>


			  <div class="col-md-4 col-sm-12">
			  <Br></br>
				   <input type="submit" class="form-control" name="submit" value="Update Profile">
			  </div>

	</div>

	<div class="col-md-6 col-sm-12">
		 <div class="contact-image">
			  <img src="images/libr.jpg" height="400" width="400">
		 </div>
	</div>
</form>
               </div>
          </div>
     </section>       
<?php
include("footer.php");
?>