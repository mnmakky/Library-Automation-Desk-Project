<?php
include("header.php");
if(!isset($_SESSION['librarian_id']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_GET['delid']))
{
	$sqldel = "DELETE  FROM bookcategory WHERE bookcategoryid='$_GET[delid]'";
	$qsqldel =mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Book category record deleted successfully...');</script>";
		echo "<script>window.location='viewbookcategory.php';</script>";
	}
}
?>

     <!-- CONTACT starts -->
     <section id="contact">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <form id="contact-form" role="form" action="" method="post">
                              <div class="section-title">
                                   <h2>Book Category <small>View Book Category!</small></h2>
                              </div>

                              <div class="col-md-12 col-sm-12">
							  
<table id="idviewbookcategory"  class="table table-striped table-bordered" >
	<thead>
		<tr style="color:white;" >
			<th>Book category</th>
			<th>Book description</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
    <?php
	$sql= "SELECT * FROM bookcategory";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[bookcategory]</td>
			<td>$rs[bookdescription]</td>
			<td>$rs[status]</td>
			<td><a href='bookcategory.php?editid=$rs[bookcategoryid]'  class='btn btn-info' >Edit</a> | <a  class='btn btn-danger' href='viewbookcategory.php?delid=$rs[bookcategoryid]' onclick='return confirmdel()'>Delete</a></td>
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
    $('#idviewbookcategory').DataTable();
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