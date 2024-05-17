<?php
include("header.php");
if(!isset($_SESSION['librarian_id']) && !isset($_SESSION['studentid']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_GET['delid']))
{
	$sqldel = "DELETE  FROM book WHERE bookid='$_GET[delid]'";
	$qsqldel =mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('transaction record deleted successfully...');</script>";
		echo "<script>window.location='viewbook.php';</script>";
	}
}
?>

     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                              <div class="section-title">
                                   <h2>Transaction <small>View transaction details!!</small></h2>
                              </div>

                              <div class="col-md-12 col-sm-12">

<form method="get" action="">
	<table  class="table table-striped table-bordered"  >
			<tr style="background-color:grey;color: white;">
				<th>Transaction Type : 
				<select name="transtype" class="form-control">
				<option value="">Select Records</option>
				<?php
					$arr = array("REQUEST","Issued","Returned");
					foreach($arr as $val)
					{
						if($_GET['transtype'] == $val)
						{
							echo "<option value='$val' selected>$val</option>";
						}
						else
						{
							echo "<option value='$val'>$val</option>";
						}
					}
				?>
				</select>
				</th>
				<th>From Date : <input type="date" name="fdate" value="<?php echo $_GET['fdate']; ?>" class="form-control"></th>
				<th>To Date : <input type="date" name="tdate" value="<?php echo $_GET['tdate']; ?>" class="form-control"></th>
				<th><br><input type="Submit" name="submit" value="Search" class="form-control"></th>
			</tr>
	</table>
</form>
<hr>
<table id="idviewbook"  class="table table-striped table-bordered"  >
	<thead>
		<tr style="background-color:yellow;">		    
			<th>Student</th>
			<th>Book</th>
			<th>Transaction type</th>
			<th>Booking date</th>
			<th>Borrow date</th>
			<th>Return date</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql= "SELECT * FROM transaction left join student ON transaction.studentid=student.studentid LEFT JOIN book on  transaction.bookid=book.bookid  LEFT JOIN bookcategory ON bookcategory.bookcategoryid=book.bookcategoryid WHERE transaction.status<>''";
	if(isset($_GET['submit']))
	{
		$sql = $sql . " AND transaction.bookingdate BETWEEN '$_GET[fdate]' AND '$_GET[tdate]' and transaction.transtype='$_GET[transtype]'";
	}
	//echo $sql;
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[studentname]<br>(<b>Roll No. $rs[rollno]</b>)</td>
			<td>$rs[bookname]<br>(<b>$rs[bookcategory]</b>)</td>
			<td>$rs[transtype]</td>
			<td>" . date("d-M-Y h:i A",strtotime($rs['bookingdate'])) . "</td>
			<td>" . date("d-M-Y h:i A",strtotime($rs['borrowdate'])) . "</td>
			<td>";
			if($rs['returndate'] == "0000-00-00 00:00:00")
			{
			}
			else
			{
			  echo date("d-M-Y h:i A",strtotime($rs['returndate']));
			}
		echo "</td></tr>";
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