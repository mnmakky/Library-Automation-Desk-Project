<?php
include("header.php");
if(!isset($_SESSION['librarian_id']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_POST['submit']))
{
	$imgname= rand(). $_FILES["studentimg"]["name"];
	move_uploaded_file($_FILES["studentimg"]["tmp_name"],"imgstudent/".$imgname);
	if(isset($_GET['editid']))
	{
		//4. update statement starts 
		$sql = "UPDATE student SET courseid ='$_POST[courseid]',studentname='$_POST[studentname]'";
		if($_FILES["studentimg"]["name"] != "")
		{
		$sql = $sql . ",studentimg='$imgname'";
		}
		$sql = $sql . " ,rollno='$_POST[rollno]',password='$_POST[password]',emailid='$_POST[emailid]',contactno='$_POST[contactno]',status='$_POST[status]' WHERE studentid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('student record Updated successfully..');</script>";
			echo "<script>window.location='viewstudent.php';</script>";
		}
		//4. update statement ends here
	}
	else
	{
		$sql = "INSERT INTO student(courseid,studentname,studentimg,rollno,password,emailid,contactno,status) VALUES('$_POST[courseid]','$_POST[studentname]','$imgname','$_POST[rollno]','$_POST[password]','$_POST[emailid]','$_POST[contactno]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('student record inserted successfully..');</script>";
			echo "<script>window.location='student.php';</script>";
		}
	}
}
//Step 2 : Select statement to update record starts here
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM student WHERE studentid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//Step 2 : Select statement to update record starts here
if($rsedit['studentimg'] == "")
{
	$imgname = "images/noimage.png";
}
else if(file_exists("imgstudent/".$rsedit['studentimg']))
{
	$imgname = "imgstudent/".$rsedit['studentimg'];
}
else
{		
	$imgname = "images/noimage.png";
}
?>
     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">
<form id="contact-form" role="form" action="" method="post" enctype="multipart/form-data" onsubmit="return validatedata()" name="frmform">
	<div class="col-md-6 col-sm-12">
			  <div class="section-title">
				   <h2>Student<small>Enter member details!</small></h2>
			  </div>

			  <div class="col-md-12 col-sm-12">
			  
				
				<label>Department: <span class="err" id="idcourseid"></span></label>
				<select name="courseid"  class="form-control">
					<option value="">Select Department</option>
					<?php
					$sqlcourse ="SELECT * FROM course WHERE status='Active'";
					$qsqlcourse = mysqli_query($con,$sqlcourse);
					while($rscourse = mysqli_fetch_array($qsqlcourse))
					{
						if($rscourse['courseid'] == $rsedit['courseid'])
						{
						echo "<option value='$rscourse[courseid]' selected>$rscourse[course]</option>";
						}
						else
						{
						echo "<option value='$rscourse[courseid]'>$rscourse[course]</option>";
						}
					}
					?>
				</select>
				
				<label>Member name: <span class="err" id="idstudentname"></span></label>
				<input type="text" class="form-control" placeholder="Enter the Member name" name="studentname" value="<?php echo $rsedit['studentname']; ?>" >
				
				
				<label>Employee no: <span class="err" id="idrollno"></span></label>
				<input type="text" class="form-control" placeholder="Enter the roll no" name="rollno"  value="<?php echo $rsedit['rollno']; ?>">
				
				
				<label>Password: <span class="err" id="idpassword"></span></label>
				<input type="password" class="form-control" placeholder="Enter the password" name="password"  value="<?php echo $rsedit['password']; ?>">
				
				<label>Confirm Password: <span class="err" id="idcpassword"></span></label>
				<input type="password" class="form-control" placeholder="Confirm the  password" name="cpassword"  value="<?php echo $rsedit['password']; ?>">
				
				<label>Email ID: <span class="err" id="idemailid"></span></label>
				<input type="text" class="form-control" placeholder="Enter the email id" name="emailid"  value="<?php echo $rsedit['emailid']; ?>">
				
				<label>Contact no: <span class="err" id="idcontactno"></span></label>
				<input type="text" class="form-control" placeholder="Enter the contact no" name="contactno"  value="<?php echo $rsedit['contactno']; ?>">
				
				<label>Status: <span class="err" id="idstatus"></span></label>
				<select name="status"  class="form-control">
					<option value="">Select Status</option>
					<?php
					$arr = array("Active","Inactive");
					foreach($arr as $val)
					{
						echo "<option value='$val'>$val</option>";
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
			<div class="section-title">
				   <h2>&nbsp;</h2>
			 </div>
			<label>Member image: <span class="err" id="idstudentimg"></span></label>
			<input type="file" id="imgInp" class="form-control" placeholder="Upload student Image" name="studentimg"   onchange="readURL(this.value)">
			<img id="blah"  src="<?php echo $imgname; ?>" style="height:250px;width: 50%;">
				
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
	if(document.frmform.courseid.value == "")
	 {
		 document.getElementById("idcourseid").innerHTML= "Please fill out the fields...";
		 condition = "False";
	 }
	
	 if(document.frmform.studentname.value == "")
	 {
		 document.getElementById("idstudentname").innerHTML= "Please enter the member name...";
		 condition = "False";
	 }
	 if(document.frmform.rollno.value == "")
	 {
		 document.getElementById("idrollno").innerHTML= "Please enter the valid Employee no...";
		 condition = "False";
	 }
	 if(document.frmform.password.value == "")
	 {
		 document.getElementById("idpassword").innerHTML= "Please enter the valid password...";
		 condition = "False";
	 }
	 if(document.frmform.cpassword.value == "")
	 {
		 document.getElementById("idcpassword").innerHTML= "Please enter the valid password once again...";
		 condition = "False";
	 }
	 if(document.frmform.emailid.value == "")
	 {
		 document.getElementById("idemailid").innerHTML= "Kindly insert the emailid..";
		 condition = "False";
	 }
	 if(document.frmform.contactno.value == "")
	 {
		 document.getElementById("idcontactno").innerHTML= "Please enter the contact no...";
		 condition = "False";
	 }
	
	 if(document.frmform.status.value == "")
	 {
		 document.getElementById("idstatus").innerHTML= "Kindly select the status...";
		 condition = "False";
	 }
	 if(document.frmform.studentimg.value == "")
	 {
		 document.getElementById("idstudentimg").innerHTML= "Kindly upload  memberimg..";
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