<?php
include("header.php");
if(!isset($_SESSION['librarian_id']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		//4. update statement starts here
		$sql = "UPDATE librarian SET  name='$_POST[name]',type='$_POST[type]',loginid='$_POST[loginid]',password='$_POST[password]',status='$_POST[status]' WHERE librarian_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
	{
		echo "<script>alert('Librarian details updated successfully..');</script>";
		echo "<script>window.location='viewlibrarian.php';</script>";
	}
		//4. update statement ends 
	}
	else
	{
		$sql = "INSERT INTO librarian(name,type,loginid,password,status) VALUES('$_POST[name]','$_POST[type]','$_POST[loginid]','$_POST[password]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
	{
		echo "<script>alert('Librarian details inserted successfully..');</script>";
		echo "<script>window.location='librarian.php';</script>";
	}
}
}

//Step 2 : Select statement to update record starts here
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM librarian WHERE librarian_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//Step 2 : Select statement to update record starts here

?>
     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">
<form id="contact-form" role="form" action="" method="post" enctype="multipart/form-data" onsubmit="return validatedata()" name="frmform">
	<div class="col-md-6 col-sm-12">
			  <div class="section-title">
				   <h2>Librarian<small>Enter librarian details!</small></h2>
			  </div>

			  <div class="col-md-12 col-sm-12">
			  
				
				<label>Name:<span class="err" id="idnameid"></span></label>
				<input type="text" class="form-control" placeholder="Enter the name" name="name" value="<?php echo $rsedit['name']; ?>">
				
				<label>Type:<span class="err" id="idtype"></span></label>
				<select name="type"  class="form-control">
					<option value="">Select Librarian type</option>
					<?php
					$arr = array("Librarian","Admin");
					foreach($arr as $val)
					{
						if($val == $rsedit['type'])
						{
							echo "<option value='$val' selected>$val</option>";
						}
						else
						{
							echo "<option value='$val'>$val</option>";
						}
					}
					?>
				</select>
				
				<label>Login ID:<span class="err" id="idloginid"></span></label>
				<input type="text" class="form-control" placeholder="Enter the login ID" name="loginid" value="<?php echo $rsedit['loginid']; ?>">
				
				<label>Password:<span class="err" id="idpassword"></span></label>
				<input type="password" class="form-control" placeholder="Enter the password" name="password"value="<?php echo $rsedit['password']; ?>"> 
				
				<label>Confirm Password:<span class="err" id="idcpassword"></span></label>
				<input type="password" class="form-control" placeholder="Enter the password" name="cpassword" value="<?php echo $rsedit['password']; ?>"> 
				
				<label>Status:<span class="err" id="idstatus"></span></label>
				<select name="status"  class="form-control">
					<option value="">Select Status</option>
					<?php
					$arr = array("Active","Inactive");
					foreach($arr as $val)
					{
						if($val == $rsedit['status'])
						{
							echo "<option value='$val' selected>$val</option>";
						}
						else
						{
							echo "<option value='$val'>$val</option>";
						}
					}
					?>
				</select>
				
			  </div>


			  <div class="col-md-4 col-sm-12">
			  <Br></br>
				   <input type="submit" class="form-control" name="submit" value="submit">
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
<script>
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

function validatedata()
{
	var condition= "True";
	$( ".err" ).empty();
	 if(document.frmform.name.value == "")
	 {
		 document.getElementById("idnameid").innerHTML= "Please enter the name...";
		 condition = "False";
	 }
	 if(document.frmform.type.value == "")
	 {
		 document.getElementById("idtype").innerHTML= "Please select the type...";
		 condition = "False";
	 }
	 if(document.frmform.loginid.value == "")
	 {
		 document.getElementById("idloginid").innerHTML= "Enter the valid Login id...";
		 condition = "False";
	 }
	 if(document.frmform.password.value == "")
	 {
		 document.getElementById("idpassword").innerHTML= "Enter the valid password...";
		 condition = "False";
	 }
	 if(document.frmform.cpassword.value == "")
	 {
		 document.getElementById("idcpassword").innerHTML= "Enter the valid password once again..";
		 condition = "False";
	 }
	 if(document.frmform.status.value == "")
	 {
		 document.getElementById("idstatus").innerHTML= "kindly select status...";
		 condition = "False";
	 }
	 if(condition == "True")
	 {
		 return true;
	 }
	 else
	 {
		 return false;
	 }
}
</script>