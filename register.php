<?php
include("header.php");
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
		$sql = "INSERT INTO student(courseid,studentname,studentimg,rollno,password,emailid,contactno,status) VALUES('$_POST[courseid]','$_POST[studentname]','$imgname','$_POST[rollno]','$_POST[password]','$_POST[emailid]','$_POST[contactno]','Active')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Student Registration done successfully..');</script>";
			echo "<script>window.location='login.php';</script>";
		}
	}
}
?>
     <!-- ABOUT -->
     <section id="about">
          <div class="container">
               <div class="row">


                    <div class="col-md-offset-3 col-md-12 col-sm-12">
                         <div class="entry-form-register">
                              <form  role="form" name="frmform" action="" method="post" enctype="multipart/form-data" onsubmit="return validatedata()" name="frmregister">
                                   <h2>Registration Panel</h2>
								   
					<select name="courseid" id="courseid" class="form-control">
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
					</select><span class="err" id="idcourseid"></span>

                                   <input type="text" name="studentname" class="form-control" placeholder="Name"><span class="err" id="idstudentname"></span>
								   
								   
								   <input type="file" name="studentimg" class="form-control" placeholder="Profile Image"><span class="err" id="idstudentimg"></span>
								   
								   <input type="text" name="rollno" class="form-control" placeholder="Roll number"><span class="err" id="idrollno"></span>

                                   <input type="password" name="password" class="form-control" placeholder="Enter Password"><span class="err" id="idpassword"></span>
								   
								   <input type="password" name="conformpassword" class="form-control" placeholder="Confirm password"><span class="err" id="idconformpassword"></span>
								   
                                   <input type="email" name="emailid" class="form-control" placeholder="Email ID"><span class="err" id="idemailid"></span>
								   
								   <input type="text" name="contactno" class="form-control" placeholder="Contact No"><span class="err" id="idcontactno"></span>
								   
                                   <button class="submit-btn form-control" name="submit" id="form-submit" type="submit">Register</button>
                              </form>
                         </div>
                    </div>

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
		 document.getElementById("idcourseid").innerHTML= "Kindly select the fields...";
		 condition = "False";
	 }
	 if(document.frmform.studentname.value == "")
	 {
		 document.getElementById("idstudentname").innerHTML= "Please enter the name...";
		 condition = "False";
	 }
	 if(document.frmform.rollno.value == "")
	 {
		 document.getElementById("idrollno").innerHTML= "Please enter the valid roll no...";
		 condition = "False";
	 }
	 if(document.frmform.password.value == "")
	 {
		 document.getElementById("idpassword").innerHTML= "Please enter the valid password...";
		 condition = "False";
	 }
	 if(document.frmform.password.value != document.frmform.conformpassword.value)
	 {
		 document.getElementById("idconformpassword").innerHTML= "Password and Confirm password not matching....";
		 condition = "False";
	 }
	 if(document.frmform.conformpassword.value == "")
	 {
		 document.getElementById("idconformpassword").innerHTML= "Please enter the valid password once again...";
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
	 if(document.frmform.studentimg.value == "")
	 {
		 document.getElementById("idstudentimg").innerHTML= "Kindly upload  image..";
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