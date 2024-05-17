<?php
include("header.php");
if(!isset($_SESSION['librarian_id']))
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
		echo "<script>alert('Book  record deleted successfully...');</script>";
		echo "<script>window.location='viewbook.php';</script>";
	}
}
?>

     <!-- CONTACT starts -->
     <section id="contact">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <form id="contact-form" role="form" action="" method="post">
                              <div class="section-title">
                                   <h2>Book <small>View book details!!</small></h2>
                              </div>

                              <div class="col-md-12 col-sm-12">
							  
<table id="idviewbook"  class="table table-striped table-bordered"  >
	<thead>
		<tr style="color: white;">
			<th>Book image</th>
			<th>Book name</th>
            
			<th>Call number</th>
             <th>barcode</th>
			<th>Book Stock</th>
           
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	
	<tbody>
	<?php
	$sql= "SELECT book.*,bookcategory.bookcategory FROM book LEFT JOIN bookcategory ON book.bookcategoryid=bookcategory.bookcategoryid";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		$sqlbook_stock= "SELECT ifnull(sum(qty),0) FROM book_stock WHERE bookid='$rs[0]' AND status='Active'";
		$qsqlbook_stock = mysqli_query($con,$sqlbook_stock);
		$rsbook_stock = mysqli_fetch_array($qsqlbook_stock);
			
		if($rs['bookimg'] == "")
		{
			$imgname = "images/noimage.png";
		}
		else if(file_exists("imgbook/".$rs['bookimg']))
		{
			$imgname = "imgbook/".$rs['bookimg'];
		}
		else
		{		
			$imgname = "images/noimage.png";
		}
		echo "<tr>
			<td><img src='$imgname' style='width:50px;height:75px;' ></td>
			<td><b>$rs[bookname]</b>
			<br> [<b>Category:</b> $rs[bookcategory]]
			<br>[<b>Author:</b> $rs[author]]
			</td>
			<td>$rs[callnumber]</td>
			<td>$rs[barcode]</td>
			<td>Total Qty : $rsbook_stock[0]
			<br>
			<a href='bookstock.php?bookid=$rs[bookid]'  class='btn btn-info' >Add Stock</a> | <a  class='btn btn-warning' href='viewbookstock.php?bookid=$rs[bookid]'>View Stock</a>
			</td>
			<td>$rs[status]</td>
			<td><a href='book.php?editid=$rs[bookid]' '  class='btn btn-info' >Edit</a> | <a  class='btn btn-danger' href='viewbook.php?delid=$rs[bookid]' onclick='return confirmdel()'>Delete</a></td>			
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