<?php
include("header.php");
if(!isset($_SESSION['librarian_id']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_GET['delid']))
{
	$sqldel = "DELETE  FROM course WHERE courseid='$_GET[delid]'";
	$qsqldel =mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Course record deleted successfully...');</script>";
		echo "<script>window.location='viewcourse.php';</script>";
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
                                   <h2>Course<small>View Course details!!</small></h2>
                              </div>

                              <div class="col-md-12 col-sm-12">
							  
<table id="idviewbook"  class="table table-striped table-bordered"  >
	<thead>
		<tr style="color:white;">
			<th>Branch</th>
			<th>Course name</th>
			<th>Course description</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	
	<tbody>
	<?php
	$sql= "SELECT course.*,branch.branchname FROM course LEFT JOIN branch on course.branchid=branch.branchid";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[branchname]</td>
			<td>$rs[course]</td>
			<td>$rs[coursenote]</td>
			<td>$rs[status]</td>
			<td><a href='course.php?editid=$rs[0]'  class='btn btn-info' >Edit</a> | <a  class='btn btn-danger' href='viewcourse.php?delid=$rs[0]' onclick='return confirmdel()'>Delete</a></td>
			
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