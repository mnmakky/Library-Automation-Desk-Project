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
		$sql ="UPDATE course SET course='$_POST[course]',coursenote='$_POST[coursenote]',status='$_POST[status]',branchid='$_POST[branchid]' where courseid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Course record updated successfully..');</script>";
		}		
	}
	else
	{
		$sql = "INSERT INTO course(course,coursenote,status,branchid) VALUES('$_POST[course]','$_POST[coursenote]','$_POST[status]','$_POST[branchid]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Course record inserted successfully..');</script>";
			echo "<script>window.location='course.php';</script>";
		}
	}
}
//Step 2 : Select statement to update record starts 
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM course WHERE courseid	='$_GET[editid]'";
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
				   <h2>Course<small>Enter course details!</small></h2>
			  </div>

			  <div class="col-md-12 col-sm-12">
			  
			 
				<label> Select Branch: <span class="err" id="idbranchid"></span></label>
			  	<select name="branchid"  class="form-control">
					<option value="">Select Branch</option>
					<?php
					$sqlbranch ="SELECT * FROM branch WHERE status='Active'";
					$qsqlbranch = mysqli_query($con,$sqlbranch);
					while($rsbranch = mysqli_fetch_array($qsqlbranch))
					{
						if($rsbranch['branchid'] == $rsedit['branchid'])
						{
						echo "<option value='$rsbranch[branchid]' selected>$rsbranch[branchname]</option>";
						}
						else
						{
						echo "<option value='$rsbranch[branchid]'>$rsbranch[branchname]</option>";
						}
					}
					?>
				</select>
				
				<label>Course: <span class="err" id="idcourse"></span></label>
				<input type="text" class="form-control" placeholder="Enter course name" name="course" value="<?php echo $rsedit['course']; ?>" >


				<label>Course Note: <span class="err" id="idcoursenote"></span></label>
				<Textarea class="form-control" placeholder="Enter the course note" name="coursenote" ><?php echo $rsedit['coursenote']; ?></textarea>
				
				
				<label>Course status: <span class="err" id="idstatus"></span></label>
				<select name="status"  class="form-control">
					<option value="">Select Status</option>
					<?php
					$arr = array("Active","Inactive");
					foreach($arr as $val)
					{
						if($val == $rsedit['status'])
						{
						echo "<option value='$val' SELECTED>$val</option>";
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
			  <img src="images/cc.jpg" height="400" width="400">
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
	if(document.frmform.branchid.value == "")
	 {
		 document.getElementById("idbranchid").innerHTML= "Please select the valid fields...";
		 condition = "False";
	 }
	
	 if(document.frmform.course.value == "")
	 {
		 document.getElementById("idcourse").innerHTML= "Please enter the course...";
		 condition = "False";
	 }
	 if(document.frmform.coursenote.value == "")
	 {
		 document.getElementById("idcoursenote").innerHTML= "Please fill out course note...";
		 condition = "False";
	 }
	 if(document.frmform.status.value == "")
	 {
		 document.getElementById("idstatus").innerHTML= "Kindly select the status...";
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