<?php
include("header.php");
if(!isset($_SESSION['librarian_id']))
{
echo "<script>window.location='login.php';</script>";	
}
if(isset($_POST['submit']))
{
	
	$filename=rand(). $_FILES["bookimg"]["name"];
	move_uploaded_file($_FILES["bookimg"]["tmp_name"],"imgbook/".$filename);
	
	if(isset($_GET['editid']))
	{
		//4. update statement starts here
		$sql = "UPDATE book SET bookcategoryid ='$_POST[bookcategoryid]',barcode='$_POST[barcode]',bookname='$_POST[bookname]',bookdescription='$_POST[bookdescription]',bookimg='$filename',bookcost='$_POST[bookcost]',author='$_POST[author]',status='$_POST[status]' WHERE bookid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('book record Updated successfully..');</script>";
			echo "<script>window.location='viewbook.php';</script>";
		}
		//4. update statement ends 
	}
	else
	{
		$sql = "INSERT INTO book(bookcategoryid,barcode,bookname,bookdescription,bookimg,bookcost,author,callnumber,status) VALUES('$_POST[bookcategoryid]','$_POST[barcode]','$_POST[bookname]','$_POST[bookdescription]','$filename','$_POST[bookcost]','$_POST[author]','$_POST[callnumber]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Book records are inserted successfully..');</script>";
			//echo "<script>window.location='book.php';</script>";
		}
	}
}
//Step 2 : Select statement to update record starts here
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM book WHERE bookid	='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//Step 2 : Select statement to update record starts here
if($rsedit['bookimg'] == "")
{
	$imgname = "images/noimage.png";
}
else if(file_exists("imgbook/".$rsedit['bookimg']))
{
	$imgname = "imgbook/".$rsedit['bookimg'];
}
else
{		
	$imgname = "images/noimage.png";
}
?>
     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">
<form id="contact-form" role="form" action="" method="post" enctype="multipart/form-data" onsubmit="return validatedata()" name="frmform">
	<div class="col-md-6 col-sm-12">
			  <div class="section-title">
				   <h2>Book <small>Enter book details!</small></h2>
			  </div>

			  <div class="col-md-12 col-sm-12">
			 
				<label>Book Category: <span class="err" id="idbookcategoryid"></span></label>
				<select name="bookcategoryid"  class="form-control">
					<option value="">Select book category</option>
					<?php
					$sqlbook ="SELECT * FROM bookcategory WHERE status='Active'";
					$qsqlbook = mysqli_query($con,$sqlbook);
					while($rsbook = mysqli_fetch_array($qsqlbook))
					{
						if($rsbook['bookcategoryid'] == $rsedit['bookcategoryid'])
						{
						echo "<option value='$rsbook[bookcategoryid]' selected>$rsbook[bookcategory]</option>";
						}
						else
						{
						echo "<option value='$rsbook[bookcategoryid]'>$rsbook[bookcategory]</option>";
						}
					}
					?>
				</select>
					
				<label>Book Title: <span class="err" id="idbookname"></span></label>
				<input type="text" class="form-control" placeholder="Enter book title" name="bookname" value="<?php echo $rsedit['bookname']; ?>" > 

<label>Barcode: <span class="err" id="idbarcode"></span></label>
				<input type="text" class="form-control" placeholder="Enter barcode" name="barcode" value="<?php echo $rsedit['barcode']; ?>" >

				<label>Book cost: <span class="err" id="idbookcost"></span></label>
				<input type="text" class="form-control" placeholder="Enter Book cost" name="bookcost" value="<?php echo $rsedit['bookcost']; ?>" >  
				
				<label>Book Author: <span class="err" id="idauthor"></span></label>
				<input type="text" class="form-control" placeholder="Enter Book author" name="author" value="<?php echo $rsedit['author']; ?>" >  
               
                 			<label>Call Number: <span class="err" id="idcallnumber"></span></label>
				<input type="text" class="form-control" placeholder="Enter Call Number" name="callnumber" value="<?php echo $rsedit['callnumber']; ?>" >
				
				
				<label>Book status: <span class="err" id="idstatus"></span></label>
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



	</div>

	<div class="col-md-6 col-sm-12">
		 	  <div class="section-title">
				   <h2>&nbsp;</h2>
			  </div>

				
				<label>Book Image: <span class="err" id="idimgInp"></span></label>
				<input type="file" id="imgInp"  class="form-control" placeholder="Upload Book Image" name="bookimg" onchange="readURL(this.value)" >
				
				<img id="blah"  src="<?php echo $imgname; ?>" style="height:250px;width: 50%;">
				
				<br>
				<label>Book Description:</label>
				<Textarea class="form-control" placeholder="Enter Book Description" name="bookdescription" ></textarea>
				
	</div>
			  <div class="col-md-12 col-sm-12">
			  <Br></hr>
				  <center><input type="submit" class="form-control" name="submit" value="submit" style="width: 250px;"></center>
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
	 if(document.frmform.bookcategoryid.value == "")
	 {
		 document.getElementById("idbookcategoryid").innerHTML= "Please fill out this fields...";
		 condition = "False";
	 }
	if(document.frmform.barcode.value == "")
	 {
		 document.getElementById("idbarcode").innerHTML= "Please fill out this fields...";
		 condition = "False";
	 } 
	 
	 if(document.frmform.bookname.value == "")
	 {
		 document.getElementById("idbookname").innerHTML= "Please enter book name...";
		 condition = "False";
	 }
	 if(document.frmform.callnumber.value == "")
	 {
		 document.getElementById("idcallnumber").innerHTML= "Please enter call number...";
		 condition = "False";
	 }
	 
	 if(document.frmform.bookcost.value == "")
	 {
		 document.getElementById("idbookcost").innerHTML= "Please enter the book cost...";
		 condition = "False";
	 }
	 if(document.frmform.author.value == "")
	 {
		 document.getElementById("idauthor").innerHTML= "Please enter the author...";
		 condition = "False";
	 }
	 if(document.frmform.status.value == "")
	 {
		 document.getElementById("idstatus").innerHTML= "Kindly select the status..";
		 condition = "False";
	 }
	 if(document.frmform.imgInp.value == "")
	 {
		 document.getElementById("idimgInp").innerHTML= "Kindly upload Image...";
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