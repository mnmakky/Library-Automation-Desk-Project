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
		//4. update statement starts 
		$sql = "UPDATE branch SET branchname='$_POST[branchname]',branchdescription='$_POST[branchdescription]',status='$_POST[status]' WHERE branchid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('branch record Updated successfully..');</script>";
			echo "<script>window.location='viewbranch.php';</script>";
		}
		//4. update statement ends here
	}
	else
	{
		$sql = "INSERT INTO branch(branchname,branchdescription,status) VALUES('$_POST[branchname]','$_POST[branchdescription]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('branch record inserted successfully..');</script>";
			echo "<script>window.location='branch.php';</script>";
		}
	}
}
//Step 2 : Select statement to update record starts here
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM  branch WHERE branchid='$_GET[editid]'";
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
				   <h2>Branch<small>Enter branch details!</small></h2>
			  </div>

			  <div class="col-md-12 col-sm-12">
			  
				<label>Branch name:<span class="err" id="idbranchnameid"></span></label>
				<INPUT class="form-control" placeholder="Enter the branch name" name="branchname" value="<?php echo $rsedit['branchname']; ?>">
				
				
				<label>Branch description:<span class="err" id="idbranchdescription"></span></label>
				<Textarea class="form-control" placeholder="Enter the branch description" name="branchdescription"><?php echo $rsedit['branchdescription']; ?></textarea>

				
				<label>Branch status:<span class="err" id="idstatus"></span></label>
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
			  <img src="images/librarybranch.png" class="img-responsive" >
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
	 if(document.frmform.branchname.value == "")
	 {
		 document.getElementById("idbranchnameid").innerHTML= "Please fill out this field...";
		 condition = "False";
	 }
	 if(document.frmform.branchdescription.value == "")
	 {
		 document.getElementById("idbranchdescription").innerHTML= "Please fill out this field....";
		 condition = "False";
	 }
	
	 if(document.frmform.status.value == "")
	 {
		 document.getElementById("idstatus").innerHTML= "Kindly select the status..";
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