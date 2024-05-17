<?php
include("header.php");
if(!isset($_SESSION['librarian_id']) && !isset($_SESSION['studentid']))
{
echo "<script>window.location='login.php';</script>";	
}
$sqlbooklist = "SELECT * FROM book LEFT JOIN bookcategory ON book.bookcategoryid=bookcategory.bookcategoryid WHERE book.status='Active' AND book.bookid='$_GET[bookid]'";
$qsqlbooklist = mysqli_query($con,$sqlbooklist);
$rsbooklist  = mysqli_fetch_array($qsqlbooklist);
$sqlfinesettings = "SELECT * FROM finesettings ";
$qsqlfinesettings = mysqli_query($con,$sqlfinesettings);
$rsfinesettings  = mysqli_fetch_array($qsqlfinesettings);
$daytokeep =  $rsfinesettings['daytokeep'];
if(isset($_POST['btnissue']))
{
	$dt = date("Y-m-d H:i:s");
	$returndate=Date('Y-m-d H:i:s', strtotime("+15 days"));
	$sql = "INSERT INTO transaction(studentid,bookid,transtype,bookingdate,borrowdate,returndate,status) VALUES('$_POST[studentid]','$_GET[bookid]','Issued','$dt','$dt','$returndate','Active')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1)
	{
		$insid = mysqli_insert_id($con);
		echo "<script>alert('Book issued successfully. Issue Reference No. is $insid.');</script>";
		echo "<script>window.location='viewissuedbooks.php';</script>";
	}
}
else
{
	if($_GET['bookingtype'] == "REQUEST")
	{
		$new_time = date('Y-m-d H:i:s', mktime(date("H")+12, date("i"), date("s"), date("m"), date("d"), date("Y")));
		$sql = "INSERT INTO transaction(studentid,bookid,transtype,bookingdate,borrowdate,status) VALUES('$_SESSION[studentid]','$_GET[bookid]','REQUEST','$dt','$new_time','Pending')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			$insid = mysqli_insert_id($con);
			echo "<script>alert('REQUEST SENT successfully. Request Reference No. is $insid . Kindly borrow in 12 hours..');</script>";
			echo "<script>window.location='viewtransactionrequest.php';</script>";
		}
	}
}
?>
<style type="text/css">
	.custom-search {
	  position: relative;
	  width: 300px;
	}
	.custom-search-input {
	  width: 100%;
	  border: 1px solid #ccc;
	  border-radius: 100px;
	  padding: 10px 100px 10px 20px; 
	  line-height: 1;
	  box-sizing: border-box;
	  outline: none;
	}
	.custom-search-botton {
	  position: absolute;
	  right: 3px; 
	  top: 3px;
	  bottom: 3px;
	  border: 0;
	  background: #d1095e;
	  color: #fff;
	  outline: none;
	  margin: 0;
	  padding: 0 10px;
	  border-radius: 100px;
	  z-index: 2;
	}
</style>
     <!-- ABOUT -->
     <section id="about" style="padding: 30px 0;">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-12">
                         <div class="about-info">
                              <h2><?php echo $rsbooklist['bookname']; ?></h2>
							<p>Category : <?php echo $rsbooklist['bookcategory']; ?></p>       
							<img src="imgbook/<?php echo $rsbooklist['bookimg']; ?>" style="width: 250px;">
							<p><?php echo $rsbooklist[3]; ?></p>                         
                         </div>
                    </div>
<?php if(isset($_SESSION['studentid'])) { ?>
                    <div class="col-md-offset-1 col-md-4 col-sm-12"   >
                         <div class="entry-form">
                              <form action="" method="get">
								<input type="hidden" name="bookid" value="<?php echo $_GET['bookid']; ?>">
								<input type="hidden" name="bookingtype" value="REQUEST">		
                                   <h2>Add to Bag..</h2>
							<table>
								<tr>
								  <th>Booking<br>date</th>
								  <td>
                                   <input type="text" readonly name="borrowdate" class="form-control" placeholder="Borrow Date" required style="border: 1px solid;" value="<?php echo date('d-M-Y h:i A'); ?>">
								   </td>
								</tr>
								<tr>
								  <th>Borrow before</th>
								  <td>
                                   <input type="text" readonly name="borrowbefore" class="form-control" placeholder="Borrow Date" required style="border: 1px solid;" value="<?php echo $new_time = date('Y-m-d h:i A', mktime(date("H")+12, date("i"), date("s"), date("m"), date("d"), date("Y"))); ?>">
								   </td>
								 </tr>
								<tr>
								  <th>Return<br> before</th>
								  <td>
                                   <input type="text" readonly name="returnbefore" class="form-control" placeholder="Return Date" required style="border: 1px solid;" value="<?php echo $new_time = date("d-M-Y h:i A", strtotime('+'.$daytokeep.' days')); ?>" >
								   </td>
								  </tr>
								<tr>
								  <td colspan="2">
<?php
$arrchkbook =  count_student_borrowed_books($_SESSION['studentid']);
if($arrchkbook['totalbookissued']  >= $arrchkbook['max_book_limit'])
{
?>								  	<center><b style="color: red;">Note: You have already borrowed <?php echo $arrchkbook['totalbookissued'] . "/" . $arrchkbook['max_book_limit']; ?> books..</b><br>
                                   <button class="btn btn-danger" type="button" onclick="alert('You have already borrowed <?php echo $arrchkbook['totalbookissued'] . "/" . $arrchkbook['max_book_limit']; ?> books..')" name="btnconfirm" id="form-submit">Disabled</button></center>
<?php 
}
else
{
?>                                   <b style="color: green;">Note: You have borrowed <?php echo $arrchkbook['totalbookissued'] . "/" . $arrchkbook['max_book_limit']; ?> books..</b><br>
                                   <button class="submit-btn form-control" type="submit" name="btnconfirm" id="form-submit">Click & Confirm</button>
<?php
}
?>                                   
								   </td>
								</tr>
							</table>
                              </form>
                         </div>
                    </div>
<?php
}
if(isset($_SESSION['librarian_id']))
{
?>
                    <div class="col-md-offset-1 col-md-4 col-sm-12" style="padding-top: 25px;" >
                         <div class="entry-form" style="width: 600px;">
                              <form action="" method="post">
								<input type="hidden" name="bookid" value="<?php echo $_GET['bookid']; ?>">
								<input type="hidden" name="bookingtype" value="REQUEST">		
                                   <h2>Issue book..</h2>
<table>

	<tr>
		<th>Select student</th>
		<td style="padding-left: 10px;">
			<div class="custom-search">
				<input type="hidden" readonly name="studentid" id="studentid" class="form-control" required style="border: 1px solid;" value="0">
			  	<textarea id="student" required name="student" readonly class="custom-search-input" placeholder="Student Profile"></textarea>
			  	<button class="custom-search-botton" type="button"  data-toggle="modal" data-target="#modStudentList">Select</button>  
			</div>
	   </td>
	</tr>
	<tr>
	  <th>Booking date</th>
	  <td style="padding-left: 10px;">
		<input type="datetime-local" readonly name="borrowdate" class="form-control" placeholder="Borrow Date" required style="border: 1px solid;" value="<?php echo date('Y-m-d H:i:s'); ?>">
	   </td>
	</tr>

	<tr>
	  <th>Return before</th>
	  <td style="padding-left: 10px;">
		<input type="datetime-local" readonly name="returnbefore" class="form-control" placeholder="Return Date" required style="border: 1px solid;" value="<?php echo $new_time = date("Y-m-d H:i:s", strtotime('+'.$daytokeep.' days')); ?>" >
	   </td>
	</tr>

	<tr>
	  <td colspan="2">
		<button class="submit-btn form-control" type="submit" name="btnissue" id="btnissue">Click & Issue Book</button>
	   </td>
	</tr>

</table>
                              </form>
                         </div>
                    </div>
<?php } ?>
               </div>
          </div>
     </section>

<?php
include("footer.php");
?>
<style type="text/css">
.modal-ku {
  width: 75%;
}
.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
    color: #444444;
}
</style>
<div class="modal fade" id="modStudentList" role="dialog">
	<div class="modal-dialog modal-ku">
	 <!-- Modal content-->
	 <div class="modal-content">
	   <div class="modal-header">
	     <button type="button" class="close" data-dismiss="modal">&times;</button>
	     <h4 class="modal-title">Select Student</h4>
	   </div>
	   <div class="modal-body">
<table id="idviewbook"  class="table table-striped table-bordered"  >
	<thead>
		<tr>
			<th>Image</th>
			<th>Course</th>
			<th>Student Name</th>
			<th>Roll No.</th>
			<th>Contact No.</th>
			<th style='text-align: center;'>No. of Books borrowed</th>
			<th>Action</th>
		</tr>
	</thead>
	
	<tbody>
	<?php
	$sql= "SELECT * FROM student left join course ON course.courseid = student.courseid WHERE student.status='Active'";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		$arrbookrec =  count_student_borrowed_books($rs['studentid']);
		if($rs['studentimg'] == "")
		{
			$imgname = "images/noimage.png";
		}
		else if(file_exists("imgstudent/".$rs['studentimg']))
		{
			$imgname = "imgstudent/".$rs['studentimg'];
		}
		else
		{		
			$imgname = "images/noimage.png";
		}
		echo "<tr>
			<td><img  src='$imgname' style='height:50px;width: 50px;'></td>
			<td>$rs[course]</td>
			<td>$rs[studentname]</td>
			<td>$rs[rollno]</td>
			<td>$rs[contactno]</td>
			<td style='text-align: center;'>";
		echo $arrbookrec['totalbookissued'] . "/" . $arrbookrec['max_book_limit'];
		echo "</td><td>";
		if(intval($arrbookrec['totalbookissued']) >= intval($arrbookrec['max_book_limit']))
		{
			echo "<button  class='btn btn-danger' onclick='alert(`Maximum limit reached...`)' >Select</button></td>";
		}	
		else
		{
			echo "<button  class='btn btn-info' onclick='load_student(" . $rs['studentid'] . ",`" . $rs['studentname'] . "`,`" . $rs['rollno']. "`,`" . $rs['course']. "`)'>Select</button></td>";
		}			
		echo "</tr>";
	}
	?>
	</tbody>	
</table>
	   </div>
	 </div>
	</div>
</div>
<script>
$(document).ready( function () {
    $('#idviewbook').DataTable();
} );
function load_student(studentid,studentname,rollno,course)
{
	$("#studentid").val(studentid);
	$("#student").val(studentname + "\nRoll No. " + rollno );
	$('#modStudentList').modal('toggle');
}
</script>