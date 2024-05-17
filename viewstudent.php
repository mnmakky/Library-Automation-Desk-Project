<?php
include("header.php");
if(!isset($_SESSION['librarian_id']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_GET['delid']))
{
	$sqldel = "DELETE  FROM student WHERE studentid='$_GET[delid]'";
	$qsqldel =mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('student record deleted successfully...');</script>";
		echo "<script>window.location='viewstudent.php';</script>";
	}
}
/*
Steps to Update record  
Step 1 - Link
Step 2 - SELECT
Step 3 - Display
Step $ - update statement
*/
?>

     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <form id="contact-form" role="form" action="" method="post">
                              <div class="section-title">
                                   <h2>Student<small>View student details!!</small></h2>
                              </div>

                              <div class="col-md-12 col-sm-12">
							  
<table id="idviewbook"  class="table table-striped table-bordered"  >
	<thead>
		<tr style="color:white">
			<th>Image</th>
			<th>Course</th>
			<th>StudentName</th>
			<th>Rollno</th>
			<th>Email ID</th>
			<th>Contactno</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	
	<tbody>
	<?php
	$sql= "SELECT * FROM student left join course ON course.courseid = student.courseid";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		if($rs['studentimg'] == "")
		{
			$imgname = "images/noimage.png";
		}
		else if(file_exists("imgstudent/".$rs['studentimg']))
		{
			$imgname = "imgstudent/".$rs['studentimg'];
		}
		else
		{		
			$imgname = "images/noimage.png";
		}
		echo "<tr>
			<td><img  src='$imgname' style='height:75px;width: 50px;'></td>
			<td>$rs[course]</td>
			<td>$rs[studentname]</td>
			<td>$rs[rollno]</td>
			<td>$rs[emailid]</td>
			<td>$rs[contactno]</td>
			<td>";
		echo count_student_borrowed_books($studentid);
		echo "</td>
			<td><a href='student.php?editid=$rs[studentid]'  class='btn btn-info' >Edit</a> | <a  class='btn btn-danger' href='viewstudent.php?delid=$rs[studentid]' onclick='return confirmdel()'>Delete</a></td>
			
		</tr>";
	}
	?>
	</tbody>	
</table>							  
							  
                              </div>
                         </form>
                    </div>


               </div>
          </div>
     </section>       
<?php
include("footer.php");
?>
<script>
$(document).ready( function () {
    $('#idviewbook').DataTable();
} );
</script>
<script>
function confirmdel()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}		
}
</script>