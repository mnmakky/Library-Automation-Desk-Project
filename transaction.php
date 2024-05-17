<?php
include("header.php");
if(!isset($_SESSION['librarian_id']) && !isset($_SESSION['studentid']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		//4. update statement starts 
		$sql = "UPDATE transaction SET  studentid='$_POST[studentid]',bookid='$_POST[bookid]',transtype='$_POST[transtype]',bookingdate='$_POST[bookingdate]',borrowdate='$_POST[borrowdate]',returndate='$_POST[returndate]',status='$_POST[status]' WHERE transationid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
	    echo mysqli_error($con);
	    if(mysqli_affected_rows($con) ==1)
	   {
		echo "<script>alert('transaction record inserted successfully..');</script>";
		echo "<script>window.location='viewtransaction.php';</script>";
	   }
	   //4. update statement ends here
	}
	else
	{
		$sql = "INSERT INTO transation(studentid,bookid,transtype,bookingdate,borrowdate,returndate,status) VALUES('$_POST[studentid]','$_POST[bookid]','$_POST[transtype]','$_POST[bookingdate]','$_POST[borrowdate]','$_POST[returndate]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('transaction record inserted successfully..');</script>";
			echo "<script>window.location='transaction.php';</script>";
		}
	}
}

	//Step 2 : Select statement to update record starts here
	if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM transaction WHERE transationid='$_GET[editid]'";
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
			  <div class="section-title">
				   <h2>Transation<small>Enter transaction details!</small></h2>
			  </div>

			  <div class="col-md-12 col-sm-12">
			  
				
				<label>Student id:<span class="err" id="idstudentid"></span></label>
				<select name="studentid"  class="form-control">
					<option value="">Select student id</option>
				</select>
				
				<label>Book id:<span class="err" id="idbookid"></span></label>
				<select name="bookid"  class="form-control">
					<option value="">Select book id</option>
				</select>
				
				<label>Transtype: <span class="err" id="idtranstype"></span></label>
				<input type="text" class="form-control" placeholder="Enter the transtype" name="transtype" value="<?php echo $rsedit['transtype']; ?>">
				
				<label>Booking date:<span class="err" id="idbookingdate"></span></label>
				<input type="date" class="form-control" placeholder="Enter the booking date" name="bookingdate"value="<?php echo $rsedit['bookingdate']; ?>">
				
				<label>Borrow date:<span class="err" id="idborrowdate"></span></label>
				<input type="date" class="form-control" placeholder="enter the borrow date" name="borrowdate"value="<?php echo $rsedit['borrowdate']; ?>"> 
				<input type="time" class="form-control" placeholder="enter the borrow date" name="borrowdate"value="<?php echo $rsedit['borrowdate']; ?>"> 
				
				<label>Return date:<span class="err" id="idreturndate"></span></label>
				<input type="date" class="form-control" placeholder="enter the borrow date" name="returndate" value="<?php echo $rsedit['returndate']; ?>">
				<input type="time" class="form-control" placeholder="enter the borrow date" name="returndate" value="<?php echo $rsedit['returndate']; ?>">
			
				<label>Status:<span class="err" id="idstatus"></span></label>
				<select name="status"  class="form-control">
					<option value="">Select Status</option>
					<?php
					$arr = array("Active","Inactive");
					foreach($arr as $val)
					{
						echo "<option value='$val'>$val</option>";
					}
					?>
				</select>
				
			  </div>


			  <div class="col-md-4 col-sm-12">
			  <Br></br>
				   <input type="submit" class="form-control" name="submit" value="submit">
			  </div>

	</div>

	<div class="col-md-6 col-sm-12">
		 <div class="contact-image">
			  <img src="images/contact-image.jpg" class="img-responsive" alt="Smiling Two Girls">
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
	 if(document.frmform.studentid.value == "")
	 {
		 document.getElementById("idstudentid").innerHTML= "studentid should not be empty...";
		 condition = "False";
	 }
	 if(document.frmform.boookid.value == "")
	 {
		 document.getElementById("idbookid").innerHTML= "Bookid should not be empty...";
		 condition = "False";
	 }
	 if(document.frmform.transtype.value == "")
	 {
		 document.getElementById("idtranstype").innerHTML= "transtype should not be empty...";
		 condition = "False";
	 }
	 if(document.frmform.bookingdate.value == "")
	 {
		 document.getElementById("idbookingdate").innerHTML= "bookingdate should not be empty...";
		 condition = "False";
	 }
	 if(document.frmform.borrowdate.value == "")
	 {
		 document.getElementById("idborrowdate").innerHTML= "borrowdate should not be empty...";
		 condition = "False";
	 }
	 if(document.frmform.returndate.value == "")
	 {
		 document.getElementById("idreturndate").innerHTML= "returndate should not be empty...";
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