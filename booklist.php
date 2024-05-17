<?php
include("header.php");
if(!isset($_SESSION['librarian_id']) && !isset($_SESSION['studentid']))
{
echo "<script>window.location='login.php';</script>";	
}
?>
<style>
#tblidbooklist thead{
  display:none;
}
.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
    color: #040404;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    cursor: default;
    color: #000000 !important;
    border: 1px solid #40404000;
    background: transparent;
    box-shadow: none;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    box-sizing: border-box;
    display: inline-block;
    min-width: 1.5em;
    padding: 0.5em 1em;
    margin-left: 2px;
    text-align: center;
    text-decoration: none !important;
    cursor: pointer;
    color: #000000 !important;
    color: #080808 !important;
    border: 1px solid transparent;
    border-radius: 2px;
}
</style>
<style>
/*
tr:nth-child(1), tr:nth-child(2), tr:nth-child(3) { display: table-cell;}
tr:nth-child(4) { border-top: 1px dashed red;}
tr:nth-child(5), tr:nth-child(6) { display: table-cell; padding-bottom: 1em; contents;}
tr:nth-child(8), tr:nth-child(9) { display: table-cell; padding-bottom: 1em; contents;}
*/
</style>
     <!-- TEAM -->
  
     <section id="team"  style="padding-top: 30px;">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title"   style="padding-bottom: 20px;">
                              <h2>View Book List </h2>
                         </div>
                    </div>

				<div class="col-md-12 col-sm-12 " style="border: 1px solid green;padding: 5px;">
					<b>Book Category : </b>
					<form action="booklist.php" method="GET">
						<input id="search" name="keywords" type="text" placeholder="Type here" value="<?php echo $_GET['keywords'] ?>">
						<input id="submit" type="submit" value="Search">
					</form>
					<?php
					if(isset($_GET['bookcategoryid']))
					{
					echo "<a href='booklist.php'  class='btn btn-info' >All</a>";
					}
					else
					{
					echo "<a href='booklist.php'  class='btn btn-success' >All</a>";
					}
					$sql= "SELECT * FROM bookcategory WHERE status='Active'"; 
					$qsql = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qsql))
					{
						if($rs['bookcategoryid'] == $_GET['bookcategoryid'])
						{
						echo "<a href='booklist.php?bookcategoryid=$rs[bookcategoryid]'  class='btn btn-success' >$rs[bookcategory]</a></td></tr>";
						}
						else
						{
						echo "<a href='booklist.php?bookcategoryid=$rs[bookcategoryid]'  class='btn btn-info' >$rs[bookcategory]	</a></td></tr>";
						}
					}
					?>
				</div>
<table id="tblidbooklist" class="table table-striped table-bordered">
	<thead>
		<tr >
            	<th></th>
            	<th></th>
            	<th></th>
		</tr>
	</thead>
	<tbody>	                    
		<?php
		$sqlbooklist = "SELECT * FROM book LEFT JOIN bookcategory ON book.bookcategoryid=bookcategory.bookcategoryid WHERE book.status='Active' ";
		if($_GET['bookcategoryid'] != "")
		{
			$sqlbooklist = $sqlbooklist . " AND bookcategory.bookcategoryid='$_GET[bookcategoryid]'";
		}
		if($_GET['keywords'] != '')
		{
			$sqlbooklist = $sqlbooklist . " AND (book.bookname like '%$_GET[keywords]%' || book.barcode like '%$_GET[keywords]%' || book.bookdescription like '%$_GET[keywords]%')";
		}
		$qsqlbooklist = mysqli_query($con,$sqlbooklist);
		$i=0;
		while($rsbooklist  = mysqli_fetch_array($qsqlbooklist))
		{
			if($rsbooklist['bookimg'] == "")
			{
				$imgname = "images/noimage.png";
			}
			else if(file_exists("imgbook/".$rsbooklist['bookimg']))
			{
				$imgname = "imgbook/".$rsbooklist['bookimg'];
			}
			else
			{		
				$imgname = "images/noimage.png";
			}
			if($i  == 0)
			{
				echo "<tr>";
			}			
				echo "<td  style='width: 33.33%'>";
		?>
			   	<div class="col-md-12 col-sm-12" style="border: 2px solid green;padding: 5px; ">
			          <div class="team-thumb">
			               <div class="team-image" >
			                    <img src="<?php echo $imgname; ?>" class="img-responsive" alt="" style="max-width: 100%; max-height: 300px; ">
			               </div>
			               <div class="team-info">
			                    <h4><?php echo $rsbooklist['bookname']; ?></h4>
			                    <span><?php echo $rsbooklist['bookcategory']; ?></span>
			               </div>
			               <ul class="social-icon">
	<?php
	$rstotqty = chk_book_available_or_not($rsbooklist['bookid']);
	if(intval($rstotqty['totborrowedbookqty'])>=intval($rstotqty['totbook_stk_qty']))
	{
	?>
          <center><input type="button" class="btn btn-danger" name="submit" value="Not Availabe" onclick="alert('Curently this book not available.')"></centert>
     <?php 
	}
     else
     { ?>
          <center><input type="button" class="form-control" name="submit" value="View" onclick="window.location='viewbookdetail.php?bookid=<?php echo $rsbooklist[0]; ?>'"></centert>
<?php
	}
?>   
			               </ul>
			          </div>
			     </div>
		<?php
				echo "</td>";
				if($i == 2)
				{
					echo "</tr>";
					$i =0;
				}
				else
				{
					$i++;
				}
		}
			if($i == 1)
			{
				echo "<td style='width: 33.33%'>&nbsp;</td>";
				$i++;
			}
			if($i == 2)
			{
				echo "<td style='width: 33.33%'>&nbsp;</td></tr>";
			}
		?>
	</tbody>
</table>
               </div>
          </div>
     </section>

<?php
include("footer.php"); 
?>
<script>
$(document).ready( function () {
    $('#tblidbooklist').DataTable({
    	"pageLength": 3,
    	"searching": true,
    	"LengthChange": false,
    	"bLengthChange": false,
    	 "info": false,
    	 "ordering": false,
    });
} );
</script>

