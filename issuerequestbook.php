<?php
include("header.php");
if(!isset($_SESSION['librarian_id']) && !isset($_SESSION['studentid']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_GET['issueid']))
{
	//daytokeep
	$dt = date("Y-m-d H:i:s");
	$returndate=Date('Y-m-d H:i:s', strtotime("+15 days"));
	$sqldel = "UPDATE transaction SET transtype='Issued',borrowdate='$dt',returndate='$returndate',status='Active' WHERE transationid='$_GET[issueid]'";
	$qsqldel =mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Book issued successfully...');</script>";
		echo "<script>window.location='viewissuedbooks.php';</script>";
	}
}
if(isset($_GET['rejectid']))
{
	$sqldel = "UPDATE transaction SET status='Rejected' WHERE transationid='$_GET[rejectid]'";
	$qsqldel =mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('REQUEST Transaction Rejected successfully...');</script>";
		echo "<script>window.location='issuerequestbook.php';</script>";
	}
}
?>

     <!-- Contact -->
     <section id="contact">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <form id="contact-form" role="form" action="" method="post">
                              <div class="section-title">
                                   <h2>VIEW REQUEST <small>View transaction details!!</small></h2>
                              </div>

                              <div class="col-md-12 col-sm-12">
							  
<table id="idviewbook"  class="table table-striped table-bordered"  >
	<thead>
		<tr style="background-color:yellow;">
		    
			<th>REQUEST No.</th>
			<th>Student</th>
			<th>Book</th>
			<th>Booking date</th>
			<th>Last Date/Time to Borrow</th>
			<th>Action</th>
		</tr>
	</thead>
	
	<tbody>
	<?php
	$sql= "SELECT * FROM `transaction` LEFT JOIN student ON transaction.studentid = student.studentid LEFT JOIN book ON book.bookid=transaction.bookid WHERE  transaction.transtype='REQUEST' ORDER BY transaction.transationid DESC";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td valign='middle'><br><br><center><b  style='font-size: 35px;'>$rs[0]</b><center></td>
			<td>$rs[studentname]<br>
			<img src='imgstudent/$rs[studentimg]' style='width: 150px;height:200px;'>
			</td>
			<td>$rs[bookname]<br>
			<img src='imgbook/$rs[bookimg]' style='width: 150px;height:200px;'></td>
			<td>" . date("d-M-Y",strtotime($rs['bookingdate'])) ."</td>
			<td>" . date("d-M-Y h:i A",strtotime($rs['borrowdate'])) . "</td>
			<td>";
		$dttim = date("Y-m-d H:i:s");
		$hrdifference = round((strtotime($dttim) - strtotime($rs['borrowdate']))/3600, 1);
			if($hrdifference > 0 )
			{
				echo "<a  class='btn btn-danger' href='#' >Request Expired..</a>";
			}
			else
			{
				if($rs[7] == "Rejected")
				{
					echo $rs[7];
				}
				else
				{
				echo "<center><a  class='btn btn-success' href='issuerequestbook.php?issueid=$rs[0]' >Issue Book</a> <Hr>
				<a  class='btn btn-danger' href='issuerequestbook.php?rejectid=$rs[0]' onclick='return confirmdela()'>Reject</a></center>";
				}
			}
			echo "</td>
			
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
function confirmdela()
{
	if(confirm("Are you sure want to Reject this request?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}		
}
</script>