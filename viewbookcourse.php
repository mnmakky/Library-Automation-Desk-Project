<?php
include("header.php");
if(!isset($_SESSION['librarian_id']) && !isset($_SESSION['studentid']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_GET['delid']))
{
	$sqldel = "DELETE  FROM  course WHERE courseid='$_GET[delid]'";
	$qsqldel =mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Book course record deleted successfully...');</script>";
		echo "<script>window.location='viewbookcourse.php';</script>";
	}
}
?>

     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <form id="contact-form" role="form" action="" method="post">
                              <div class="section-title">
                                   <h2>Course <small>View Course details</small></h2>
                              </div>

                              <div class="col-md-12 col-sm-12">
							  
<table id="idviewbook"  class="table table-striped table-bordered"  >
	<thead>
		<tr>
			<th>Course</th>
            <th>Course note</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		
	</thead>
	
	<tbody>
	<?php
	$sql= "SELECT * FROM course";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[course]</td>
			<td>$rs[coursenote]</td>
			<td>$rs[status]</td>
			<td><a href='course.php?editid=$rs[courseid]' '  class='btn btn-info' >Edit</a> | <a  class='btn btn-danger' href='viewbookcourse.php?delid=$rs[courseid]' onclick='return confirmdel()'>Delete</a></td>
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