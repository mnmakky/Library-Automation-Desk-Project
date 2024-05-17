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
		$sql = "UPDATE book_stock SET bookid ='$_POST[bookid]',branchid='$_POST[branchid]',purchasedate='$_POST[purchasedate]',qty='$_POST[qty]',cost='$_POST[cost]',status='Active' WHERE book_stock_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('book_stock record Updated successfully..');</script>";
			echo "<script>window.location='viewbookstock.php?bookid=$_GET[bookid]';</script>";
		}
		//4. update statement ends here
	}
	else
	{
		$sql = "INSERT INTO book_stock(bookid,branchid,purchasedate,qty,cost,status) VALUES('$_POST[bookid]','$_POST[branchid]','$_POST[purchasedate]','$_POST[qty]','$_POST[cost]','Active')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Bookstock inserted successfully..');</script>";
			echo "<script>window.location='viewbookstock.php?bookid=$_GET[bookid]';</script>";
		}
	}
}
//Step 2 : Select statement to update record starts here
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM book_stock WHERE book_stock_id	='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	echo mysqli_error($con);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//Step 2 : Select statement to update record starts here

if(isset($_REQUEST['bookid']))
{
	$sqlbook= "SELECT book.*,bookcategory.bookcategory FROM book LEFT JOIN bookcategory ON book.bookcategoryid=bookcategory.bookcategoryid WHERE book.bookid='$_REQUEST[bookid]'";
	$qsqlbook = mysqli_query($con,$sqlbook);
	$rsbook = mysqli_fetch_array($qsqlbook);
			
		if($rsbook['bookimg'] == "")
		{
			$imgname = "images/noimage.png";
		}
		else if(file_exists("imgbook/".$rsbook['bookimg']))
		{
			$imgname = "imgbook/".$rsbook['bookimg'];
		}
		else
		{		
			$imgname = "images/noimage.png";
		}
	
	$sqlbook_stock= "SELECT ifnull(sum(qty),0) FROM book_stock WHERE bookid='$rsbook[0]' AND status='Active'";
	$qsqlbook_stock = mysqli_query($con,$sqlbook_stock);
	$rsbook_stock = mysqli_fetch_array($qsqlbook_stock);
}
?>
     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">
<form id="contact-form" role="form" action="" method="post"enctype="multipart/form-data" onsubmit="return validatedata()" name="frmform">
<input type="hidden" class="form-control"  name="bookid"  value="<?php echo $rsbook[0]; ?>">

	<div class="col-md-6 col-sm-12">
			  <div class="section-title">
				   <h2>Book detail <small>View book detail!</small></h2>
			  </div>

			  <div class="col-md-12 col-sm-12">
			  
				<label>Book Category: <?php echo $rsbook['bookcategory']; ?></label>
					<br>
					
				<label>Book name: <?php echo $rsbook['bookname']; ?></label>
					<br>


				<label>Book cost: ₹<?php echo $rsbook['bookcost']; ?></label>
					<br>
				
				<label>Book Author: <?php echo $rsbook['author']; ?></label>
					<br>
				
				<label>Book quantity: <?php echo $rsbook_stock[0]; ?></label>
				
<br>
			<img id="blah"  src="<?php echo $imgname; ?>" style="height:250px;width: 50%;">
				
			  </div>

				
	</div>
	<div class="col-md-6 col-sm-12">
			  <div class="section-title">
				   <h2>Book Stock detail<small>Enter Book Stock details!</small></h2>
			  </div>


			 
				<label> Select Branch:</label>
			  				<select name="branchid"  class="form-control">
					<option value="">Select Branch</option>
					<?php
					$sqlbranch ="SELECT * FROM branch WHERE status='Active'";
					$qsqlbranch = mysqli_query($con,$sqlbranch);
					while($rsbranch = mysqli_fetch_array($qsqlbranch))
					{
						if($rsbranch['branchid'] == $rsedit['branchid'])
						{
						echo "<option value='$rsbranch[branchid]' selected>$rsbranch[branchname]</option>";
						}
						else
						{
						echo "<option value='$rsbranch[branchid]'>$rsbranch[branchname]</option>";
						}
					}
					?>
				</select>
					
				<label> Book Purchased  on:</label>
				<input type="date" class="form-control" placeholder="Enter the purchase date" name="purchasedate" value="<?php echo $rsedit['purchasedate']; ?>" max="<?php echo date("Y-m-d"); ?>">


		
				<label>Book Quantity:</label>
				<input type="number" class="form-control" placeholder="Enter the quantity" name="qty"  id="qty"  value="<?php echo $rsedit['qty']; ?>" onkeyup="calculatetotalcost()" onchange="calculatetotalcost()">
				
				
				<label>Book cost:</label>
				<input type="text" class="form-control" placeholder="Enter Book cost" name="cost" id="cost"  value="<?php echo $rsedit['cost']; ?>" onkeyup="calculatetotalcost()" onchange="calculatetotalcost()">
	
	
				<label>Total cost:</label>
				<input type="text" class="form-control" placeholder="Enter Book cost" name="tcost" id="tcost" value="<?php echo $rsedit['cost'] *  $rsedit['qty']; ?>"  readonly>
			  </div>


			  <div class="col-md-4 col-sm-12">
			  <Br></br>
				   <input type="submit" class="form-control" name="submit" value="Add Book Stock">
				   
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
	//qty cost tcost
	function calculatetotalcost()
	{
		document.getElementById("tcost").value= parseFloat(document.getElementById("qty").value) * parseFloat(document.getElementById("cost").value);
	}
</script>