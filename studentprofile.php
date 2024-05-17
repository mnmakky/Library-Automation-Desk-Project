<?php
include("header.php");
if(isset($_POST['submit']))
{
	$filename=rand(). $_FILES["studentimg"]["name"];
	move_uploaded_file($_FILES["studentimg"]["tmp_name"],"imgstudent/".$filename);
	
	if(isset($_SESSION['studentid']))
	{
		//4. update statement starts 
		$sql = "UPDATE student SET courseid ='$_POST[courseid]',studentname='$_POST[studentname]'";
		if($_FILES["studentimg"]["name"] != "")
		{
		$sql = $sql . ",studentimg='$filename'";
		}
		$sql = $sql . ",rollno='$_POST[rollno]',password='$_POST[password]',emailid='$_POST[emailid]',contactno='$_POST[contactno]' WHERE studentid='$_SESSION[studentid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('student profile updated successfully..');</script>";
		}
		//4. update statement ends here
	}
}
//Step 2 : Select statement to update record starts here
if(isset($_SESSION['studentid']))
{
	$sqledit = "SELECT * FROM student WHERE studentid='$_SESSION[studentid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
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
}
//Step 2 : Select statement to update record starts here
?>
     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">
<form id="contact-form" role="form" action="" method="post" enctype="multipart/form-data">
	<div class="col-md-6 col-sm-12">
			  <div class="section-title">
				   <h2>Student<small>Enter student details!</small></h2>
			  </div>

			  <div class="col-md-12 col-sm-12">
			  
				
				<label>Course:</label>
				<select name="courseid"  class="form-control">
					<option value="">Select Course</option>
					<?php
					$sqlcourse="SELECT * FROM course WHERE status='Active'";
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
				
				<label>Student name:</label>
				<input type="text" class="form-control" placeholder="Enter the student name" name="studentname" value="<?php echo $rsedit['studentname']; ?>" >
				
				<label>Roll no:</label>
				<input type="text" class="form-control" placeholder="Enter the roll no" name="rollno"  value="<?php echo $rsedit['rollno']; ?>">
				
				
				<label>Password:</label>
				<input type="password" class="form-control" placeholder="Enter the password" name="password"  value="<?php echo $rsedit['password']; ?>">
				
				<label>Email ID:</label>
				<input type="text" class="form-control" placeholder="Enter the email id" name="emailid"  value="<?php echo $rsedit['emailid']; ?>">
				
				<label>Contact no:</label>
				<input type="text" class="form-control" placeholder="Enter the contact no" name="contactno"  value="<?php echo $rsedit['contactno']; ?>">
							
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
				<label>Student image:</label>
				<input type="file" class="form-control" placeholder="Upload student Image" name="studentimg" >
				<img src="<?php echo $imgname; ?>" style="height:250px;width:50%;">
	</div>
</form>
               </div>
          </div>
     </section>       
<?php
include("footer.php");
?>