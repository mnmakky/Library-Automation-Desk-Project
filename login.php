<?php
include("header.php");
if(isset($_SESSION["librarian_id"]))
{
echo "<script>window.location='dashboard.php';</script>";	
}
if(isset($_SESSION['studentid']))
{
echo "<script>window.location='studentpanel.php';</script>";	
}
if(isset($_POST['submit']))
{
	if($_POST['usertype'] == "Student")
	{
		$sql="SELECT * FROM student WHERE rollno='$_POST[rollno]' AND password='$_POST[password]' AND status='Active'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_num_rows($qsql) == 1)
		{
			$rs = mysqli_fetch_array($qsql);
	        	$_SESSION['studentid'] = $rs['studentid'];
			echo "<script>window.location='studentpanel.php';</script>";
		}
		else
		{
			echo "<script>alert('You have entered invalid login credentials...');</script>";
			echo "<script>window.location='login.php';</script>";
		}
	}
	
	if($_POST['usertype'] == "Admin" || $_POST['usertype'] == "Librarian")
	{
		$sql="SELECT * FROM librarian WHERE type='$_POST[usertype]' AND loginid='$_POST[rollno]' AND password='$_POST[password]' AND status='Active'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_num_rows($qsql) == 1)
		{
			$rs = mysqli_fetch_array($qsql);
			$_SESSION["librarian_id"] = $rs['librarian_id'];
			$_SESSION['type'] = $rs['type'];
			echo "<script>window.location='dashboard.php';</script>";
		}
		else
		{
			echo "<script>alert('You have entered invalid login credentials...');</script>";
			echo "<script>window.location='login.php';</script>";
		}
	}
}
?>


     <!-- About -->
     <section id="about">
          <div class="container">
               <div class="row">


                    <div class="col-md-offset-3 col-md-12 col-sm-12">
                         <div class="entry-form">
                              <form action="" method="post">
                                   <h2>Login Panel</h2>
								   
								   
                                   <input type="text" name="rollno" class="form-control" placeholder="LOGIN-ID OR Roll Number" required="">

                                   <input type="password" name="password" class="form-control" placeholder="Your password" required="">
								   
								   <select name="usertype" class="form-control">
										<option value="">Select User type</option>
										<option value="Student">Member</option>
										<option value="Librarian">Librarian</option>
										<option value="Admin">Admin</option>
								   </select>

                                   <button class="submit-btn form-control" id="form-submit" name="submit" type="submit">Login</button>
                              </form>
                         </div>
                    </div>

               </div>
          </div>
     </section>
     
<?php
include("footer.php");
?>