<?php
include("header.php");
if(!isset($_SESSION['librarian_id']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_POST['submit']))
{
	$sql = "UPDATE finesettings SET daytokeep='$_POST[daytokeep]',penaltycost='$_POST[penaltycost]',nobooks='$_POST[nobooks]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<script>alert('Fine settings record updated successfully..');</script>";
	}
}
$sql = "SELECT   * FROM finesettings";
$qsql = mysqli_query($con,$sql);
echo mysqli_error($con);
$rs = mysqli_fetch_array($qsql);
?>
     <!-- CONTACT START -->
     <section id="contact">
          <div class="container">
               <div class="row">
<form id="contact-form" role="form" action="" method="post" enctype="multipart/form-data" onsubmit="return validatedata()" name="frmform">
	<div class="col-md-6 col-sm-12">
			  <div class="section-title">
				   <h2>Fine setting<small>Enter fine details!</small></h2>
			  </div>

			  <div class="col-md-12 col-sm-12">
			  
				<label>Days to keep:<span class="err" id="iddaytokeepid"></span></label>
				<input type="number" min="0" class="form-control" placeholder="Enter days to keep" name="daytokeep" value="<?php echo $rs['daytokeep']; ?>" >
				
				<label>Penalty / Day:<span class="err" id="idpenaltycost"></span></label>
				<input type="number" min="0" class="form-control" placeholder="Enter penalty cost" name="penaltycost" value="<?php echo $rs['penaltycost']; ?>" >

				<label>No. of books for student:<span class="err" id="idnobooks"></span></label>
				<input type="number" min="0" class="form-control" placeholder="Enter Number of books" name="nobooks" value="<?php echo $rs['nobooks']; ?>" >
			  </div>


			  <div class="col-md-4 col-sm-12">
			  <Br></br>
				   <input type="submit" class="form-control" name="submit" value="submit">
			  </div>

	</div>

	<div class="col-md-6 col-sm-12">
		 <div class="contact-image">
			  <img src="images/fine.jpg">
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
	 if(document.frmform.penaltydate.value == "")
	 {
		 document.getElementById("idpenaltydateid").innerHTML= "penaltydateid should not be empty...";
		 condition = "False";
	 }
	 if(document.frmform.daytokeep.value == "")
	 {
		 document.getElementById("iddaytokeep").innerHTML= " should not be empty...";
		 condition = "False";
	 }
	 if(document.frmform.penaltycost.value == "")
	 {
		 document.getElementById("idpenaltycost").innerHTML= "penaltycost should not be empty...";
		 condition = "False";
	 }
	 if(document.frmform.nobook.value == "")
	 {
		 document.getElementById("idnobook").innerHTML= "nobooks should not be empty...";
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