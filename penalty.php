<?php
include("header.php");
if(!isset($_SESSION['librarian_id']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		//4. update statement starts 
		$sql = "UPDATE penalty SET penalty_type ='$_POST[penalty_type]',transactionid='$_POST[transactionid]',bookid='$_POST[bookid]',cost='$_POST[cost]',penaltydate='$_POST[penaltydate]',status='$_POST[status]' WHERE penaltyid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('penalty record Updated successfully..');</script>";
			echo "<script>window.location='viewpenalty.php';</script>";
		}
		//4. update statement ends here
	}
	else
	{
			// studentid bookid
			$sql = "INSERT INTO penalty(transactionid,bookid,cost,penaltydate,status) VALUES('$_POST[transationid]','$_POST[bookid]','$_POST[cost]','$_POST[penaltydate]','Active')";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
			if(mysqli_affected_rows($con) ==1)
			{
				$returndate = date("Y-m-d H:i:s");
					$sqldel = "UPDATE transaction SET transtype='Returned',returndate='$returndate',status='Active' WHERE transationid='$_POST[transationid]'";
					$qsqldel =mysqli_query($con,$sqldel);
					echo mysqli_error($con);
				echo "<script>alert('Book Returned..');</script>";
				echo "<script>window.location='viewissuedbooks.php';</script>";
			}
	}
}
//Step 2 : Select statement to update record starts here
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM penalty WHERE penaltyid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//Step 2 : Select statement to update record starts here
?>
     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">
<form id="contact-form" role="form" action="" method="post" enctype="multipart/form-data" onsubmit="return validatedata()" name="frmform">

	<div class="col-md-6 col-sm-12">
		 <div class="contact-image">
		   <div class="section-title">
				   <h2>Book Issue details</h2>
			  </div>
		 <table id="idviewbook"  class="table table-striped table-bordered"  >
	<tbody>
	<?php
	$sql= "SELECT * FROM `transaction` LEFT JOIN student ON transaction.studentid = student.studentid LEFT JOIN book ON book.bookid=transaction.bookid WHERE transaction.status='Active' AND transaction.transtype='Issued' AND transaction.transationid='$_GET[transactionid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{

$cdate = strtotime($rs['returndate']);
$today = time();
$difference = $cdate - $today;
//if ($difference < 0) { $difference = 0; }

		echo "	
<input type='hidden' name='transationid' value='$rs[transationid]'>
<input type='hidden' name='studentid' value='$rs[studentid]'>
<input type='hidden' name='bookid' value='$rs[bookid]'>
		<tr>
					<th>Book Issue No.</th>
					<td valign='middle'><center><b  style='font-size: 35px;'>$rs[0]</b><center></td>
				</tr>
				
				<tr>
					<th>Student</th>
					<td>$rs[studentname]<br><img src='imgstudent/$rs[studentimg]' style='width: 150px;height:200px;'></td>
				</tr>
			
				<tr>
					<th>Book</th>
					<td>$rs[bookname]<br><img src='imgbook/$rs[bookimg]' style='width: 150px;height:200px;'></td>
				</tr>
				
				<tr>
					<th>Issued Date</th>
					<td>" . date("d-M-Y h:i A",strtotime($rs['borrowdate'])) ."</td>
				</tr>
				
				<tr>
				<th>Return Date</th>
			<td>" . date("d-M-Y h:i A",strtotime($rs['returndate'])) . "<br><b color: red;>". floor($difference/60/60/24)." days remaining</b></td>
				</tr>";
				$noofdayspenalty = 0;
				if(floor($difference/60/60/24) < 0)
				{
					$noofdayspenalty  = abs(floor($difference/60/60/24));
				}				
	}
	?>
	</tbody>	
</table>
		 </div>
	</div>
	
	<div class="col-md-6 col-sm-12">
			  <div class="section-title">
				   <h2>Penalty<small>Enter penalty details!</small></h2>
			  </div>

			  <div class="col-md-12 col-sm-12">
			  
				
				<label>Penalty Charges:<span class="err" id="idcost"></span></label>
				<?php $arrlibsetting = library_settings(); ?>
				<input type="number" class="form-control" placeholder="Enter the cost" name="cost" value="<?php 

				echo $noofdayspenalty * $arrlibsetting['penaltycost'];
				?>"> 
				
				<label>Penalty date:<span class="err" id="idpenaltydate"></span></label>
				<input type="date" class="form-control" placeholder="Enter the penalty date" name="penaltydate" value="<?php echo $dt; ?>" readonly>
				
				
				
			  </div>


			  <div class="col-md-4 col-sm-12">
			  <Br></br>
				   <input type="submit" class="form-control" name="submit" value="Return Book">
			  </div>

	</div>

</form>
               </div>
          </div>
     </section>       
<?php
include("footer.php");
?>
<script>
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

function validatedata()
{
	var condition= "True";
	$( ".err" ).empty();
	 if(document.frmform.transactionid.value == "")
	 {
		 document.getElementById("idtransactionid").innerHTML= "transactionid should not be empty...";
		 condition = "False";
	 }
	 if(document.frmform.bookid.value == "")
	 {
		 document.getElementById("idbookid").innerHTML= "Bookid should not be empty...";
		 condition = "False";
	 }
	 if(document.frmform.cost.value == "")
	 {
		 document.getElementById("idcost").innerHTML= "cost should not be empty...";
		 condition = "False";
	 }
	 if(document.frmform.penaltydate.value == "")
	 {
		 document.getElementById("idpenaltydate").innerHTML= "penaltydate should not be empty...";
		 condition = "False";
	 }
	 if(document.frmform.status.value == "")
	 {
		 document.getElementById("idstatus").innerHTML= "Kindly select the status..";
		 condition = "False";
	 }
	 
	 if(condition == "True")
	 {
		 return true;
	 }
	 else
	 {
		 return false;
	 }
}
</script>