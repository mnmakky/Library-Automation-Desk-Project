<?php
include("header.php");

if(!isset($_SESSION['librarian_id']) && !isset($_SESSION['studentid'])) {
	echo "<script>window.location='login.php';</script>";	
}
if(isset($_GET['delid'])) {
	$sqldel = "DELETE  FROM penalty WHERE penaltyid='$_GET[delid]'";
	$qsqldel =mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1) {
		echo "<script>alert('penalty record deleted successfully...');</script>";
		echo "<script>window.location='viewpenalty.php';</script>";
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
                                   <h2>Penalty<small>View penalty details!!</small></h2>
                              </div>

                              <div class="col-md-12 col-sm-12">
							  
<table id="idviewbook"  class="table table-striped table-bordered"  >
	<thead>
		<tr>
			<th>Issue ID</th>
			<th>Book</th>
			<th>Student</th>
			<th>Cost </th>
			<th>Penalty date</th>
		</tr>
	</thead>
	
	<tbody>
	<?php
	$sql= "SELECT * FROM `penalty` left join transaction on penalty.transactionid=transaction.transationid ";
	if(isset($_SESSION['studentid']))
	{
		$sql = $sql . " AND  transaction.studentid='" . $_SESSION['studentid'] . "'";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		 $sqltransaction= "SELECT * FROM `transaction` LEFT JOIN student ON transaction.studentid = student.studentid LEFT JOIN book ON book.bookid=transaction.bookid  WHERE  transaction.transationid='$rs[transactionid]'";
		$qsqltransaction = mysqli_query($con,$sqltransaction);
		echo mysqli_error($con);
		$rstransaction = mysqli_fetch_array($qsqltransaction);
		if($rs['cost'] != 0)
		{
		echo "<tr>
			<td>$rs[transactionid]</td>
			<td>$rstransaction[bookname] <br><img src='imgbook/$rstransaction[bookimg]' style='width: 150px;height:200px;'></td>
			<td>$rstransaction[studentname]<br><img src='imgstudent/$rstransaction[studentimg]' style='width: 150px;height:200px;'></td>
			<td>£$rs[cost]</td>
			<td>".date("d-M-Y",strtotime($rs['penaltydate']))."</td>
		</tr>";
		}
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