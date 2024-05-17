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
		$sql = "UPDATE bookcategory SET bookcategory ='$_POST[bookcategory]',bookdescription='$_POST[bookdescription]',status='$_POST[status]' WHERE bookcategoryid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('bookcategory record Updated successfully..');</script>";
			echo "<script>window.location='viewbookcategory.php';</script>";
		}
		//4. update statement ends here
	}
	else
	{
		
	$sql = "INSERT INTO bookcategory(bookcategory,bookdescription,status) VALUES('$_POST[bookcategory]','$_POST[bookdescription]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<script>alert('Book category inserted successfully..');</script>";
		echo "<script>window.location='bookcategory.php';</script>";
	}
}
}
//Step 2 : Select statement to update record starts here
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM bookcategory WHERE bookcategoryid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//Step 2 : Select statement to update record starts here

?>
     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">
<form id="contact-form" role="form" action="" method="post"  enctype="multipart/form-data" onsubmit="return validatedata()" name="frmform">
	<div class="col-md-6 col-sm-12">
			  <div class="section-title">
				   <h2>BookCategory <small>Enter bookcategory details!</small></h2>
			  </div>

			  <div class="col-md-12 col-sm-12">
			  
				<label>Book Category:<span class="err" id="idbookcategoryid"></span></label>
				<input type="text"  class="form-control" placeholder="Enter Book category" name="bookcategory" value="<?php echo $rsedit['bookcategory']; ?>" >


				<label>Book Description:<span class="err" id="idbookdescription"></span></label>
				<Textarea class="form-control" placeholder="Enter Book Description" name="bookdescription" value="<?php echo $rsedit['bookdescription']; ?>" > </textarea>
			
				<label>Book status:<span class="err" id="idstatus"></span></label>
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
		 <div class="cate">
			  <img src="images/cate.jpg" class="img-responsive" alt="Smiling Two Girls">
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
	 if(document.frmform.bookcategory.value == "")
	 {
		 document.getElementById("idbookcategoryid").innerHTML= "Please fill out this fields...";
		 condition = "False";
	 }
	 if(document.frmform.bookdescription.value == "")
	 {
		 document.getElementById("idbookdescription").innerHTML= " bookdescription should not be empty...";
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