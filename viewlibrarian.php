<?php
include("header.php");
if(!isset($_SESSION['librarian_id']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_GET['delid']))
{
	$sqldel = "DELETE  FROM  librarian WHERE librarian_id='$_GET[delid]'";
	$qsqldel =mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('librarian  record deleted successfully...');</script>";
		echo "<script>window.location='viewlibrarian.php';</script>";
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
                                   <h2>Librarian<small>View Librarian details!!</small></h2>
                              </div>

                              <div class="col-md-12 col-sm-12">
							  
<table id="idviewbook"  class="table table-striped table-bordered"  >
	<thead>
		<tr>
			<th>Name</th>
			<th>Type</th>
			<th>Login id</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	
	<tbody>
	<?php
	$sql= "SELECT * FROM librarian";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[name]</td>
			<td>$rs[type]</td>
			<td>$rs[loginid]</td>
			<td>$rs[status]</td>
			<td><a href='librarian.php?editid=$rs[librarian_id]'  class='btn btn-info' >Edit</a> | <a  class='btn btn-danger' href='viewlibrarian.php?delid=$rs[librarian_id]' onclick='return confirmdel()'>Delete</a></td>
			
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