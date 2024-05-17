<?php
include("header.php");
if(!isset($_SESSION["librarian_id"]))
{
echo "<script>window.location='login.php';</script>";	
}
?>


     
     <section id="team" style="padding-top: 30px;">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title" style="padding-bottom: 20px;">
                              <h2>Dashboard </h2>
                         </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-md-3 col-sm-6">
                         <div class="team-thumb">
                              <div class="team-image"> <a href="viewbook.php"><img src="images/book.jpg" class="img-responsive" alt="" style="width:100%;height:250px;"></a>
                              </div>
                              <div class="team-info">
                                   <center><h3>
								   <?php
								   $sql ="SELECT * FROM book";
								   $qsql= mysqli_query($con,$sql);
								   echo mysqli_num_rows($qsql);
								   ?>
								   </h3>
                                     records
                                   </center>
                              </div>
                              <ul class="social-icon">
                                   <center><li>Books record</li></center>
                              </ul>
                         </div>
                    </div>
					
					
				<div class="col-md-3 col-sm-6">
                         <div class="team-thumb">
                              <div class="team-image"> <a href="viewbookcategory.php"><img src="images/cat.jpg" class="img-responsive" alt="" style="width:100%;height:250px;"></a>
                              </div>
                              <div class="team-info">
                                   <center><h3>
								   <?php
								   $sql ="SELECT * FROM bookcategory";
								   $qsql= mysqli_query($con,$sql);
								   echo mysqli_num_rows($qsql);
								   ?>
								   </h3> records</center>
                              </div>
                              <ul class="social-icon">
                                   <center><li>Book category record</li></center>
                              </ul>
                         </div>
                    </div>
		
				<div class="col-md-3 col-sm-6">
                         <div class="team-thumb">
                              <div class="team-image"> <a href="viewbookstock.php"><img src="images/library.jpg" class="img-responsive" alt="" style="width:100%;height:250px;"></a>
                              </div>
                              <div class="team-info">
                                   <center><h3>
								   <?php
								   $sqlbook_stock ="SELECT sum(qty) FROM book_stock WHERE status='Active'";
								   $qsqlbook_stock = mysqli_query($con,$sqlbook_stock);
                                           $rsqtybook_stock = mysqli_fetch_array($qsqlbook_stock);
								   echo $rsqtybook_stock[0];
								   ?>
								   </h3> records</center>
                              </div>
                              <ul class="social-icon">
                                   <center><li>No. of Books in Library</li></center>
                              </ul>
                         </div>
                    </div>
				<div class="col-md-3 col-sm-6">
                         <div class="team-thumb">
                              <div class="team-image">
                                   <a href="viewbranch.php"><img src="images/branch.jpg" class="img-responsive" alt="" style="width:100%;height:250px;"></a>
                              </div>
                              <div class="team-info">
                                   <center><h3>
								   <?php
								   $sql ="SELECT * FROM branch";
								   $qsql= mysqli_query($con,$sql);
								   echo mysqli_num_rows($qsql);
								   ?>
								   </h3> records</center>
                              </div>
                              <ul class="social-icon">
                                   <center><li>No. of Library Branches</li></center>
                              </ul>
                         </div>
                    </div>
				
               </div>
               <br>
               <div class="row">
				<div class="col-md-3 col-sm-6">
                         <div class="team-thumb">
                              <div class="team-image">
                                  <a href="viewcourse.php"><img src="images/course.jpg" class="img-responsive" alt="" style="width:100%;height:250px;"></a>
                              </div>
                              <div class="team-info">
                                   <center><h3>
								   <?php
								   $sql ="SELECT * FROM course";
								   $qsql= mysqli_query($con,$sql);
								   echo mysqli_num_rows($qsql);
								   ?>
								   </h3> records</center>
                              </div>
                              <ul class="social-icon">
                                   <center>
                                     <li>No. of Course records</li>
                                   </center>
                              </ul>
                         </div>
                    </div>
				<div class="col-md-3 col-sm-6">
                         <div class="team-thumb">
                              <div class="team-image"> <a href="viewlibrarian.php"><img src="images/majed.jpg" class="img-responsive" alt="" style="width:100%;height:250px;"></a>
                              </div>
                              <div class="team-info">
                                   <center><h3>
								   <?php
								   $sql ="SELECT * FROM librarian";
								   $qsql= mysqli_query($con,$sql);
								   echo mysqli_num_rows($qsql);
								   ?>
								   </h3> records</center>
                              </div>
                              <ul class="social-icon">
                                   <center><li>No. of Librarian records</li></center>
                              </ul>
                         </div>
                    </div>
					
                    <div class="col-md-3 col-sm-6">
                         <div class="team-thumb">
                              <div class="team-image"> <a href="viewstudent.php"><img src="images/std.jpg" class="img-responsive" alt="" style="width:100%;height:250px;"></a>
                              </div>
                              <div class="team-info">
                                   <center><h3>
                                           <?php
                                           $sql ="SELECT * FROM student";
                                           $qsql= mysqli_query($con,$sql);
                                           echo mysqli_num_rows($qsql);
                                           ?>
                                           </h3> records</center>
                              </div>
                              <ul class="social-icon">
                                   <center>
                                     <li> No. of Member records</li></center>
                              </ul>
                         </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                         <div class="team-thumb">
                              <div class="team-image"> <a href="viewtransaction.php"><img src="images/trans.jpg" class="img-responsive" alt="" style="width:100%;height:250px;"></a>
                              </div>
                              <div class="team-info">
                                   <center><h3>
                                           <?php
                                           $sql ="SELECT * FROM transaction";
                                           $qsql= mysqli_query($con,$sql);
                                           echo mysqli_num_rows($qsql);
                                           ?>
                                           </h3> records</center>
                              </div>
                              <ul class="social-icon">
                                   <center><li> No. of Issue/Return Books</li></center>
                              </ul>
                         </div>
                    </div>

               </div>
               <br>
               <div class="row">
                 
                    <div class="col-md-3 col-sm-6">
                         <div class="team-thumb">
                              <div class="team-image"> <a href="viewpenalty.php"><img src="images/pen.jpg" class="img-responsive" alt="" style="width:100%;height:250px;"></a>
                              </div>
                              <div class="team-info">
                                   <center><h3>
                                           <?php
                                           $sql ="SELECT * FROM penalty";
                                           $qsql= mysqli_query($con,$sql);
                                           echo mysqli_num_rows($qsql);
                                           ?>
                                           </h3> 
                                   Fines
                                   </center>
                              </div>
                              <ul class="social-icon">
                                   <center><li>No. of Penalties Collected</li></center>
                              </ul>
                         </div>
                    </div>
               </div>
          </div>
     </section>

<?php
include("footer.php");
?>