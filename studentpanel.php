<?php
include("header.php");
if(!isset($_SESSION['studentid']))
{
echo "<script>window.location='login.php';</script>";	
}
?>


     <!-- FEATURE starts -->
     <section id="feature">
          <div class="container">
               <div class="row "> 

                    <div class="col-md-4 col-sm-4 ">
                         <div class="feature-thumb" style="padding: 1em 3em;cursor: pointer;" onclick="window.location='booklist.php'">
                              <center><h3>SEARCH BOOKS</h3></center>
                              <p><img src="images/searchbook.jpg" style="width:100%;height: 200px;"></p>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb" style="padding: 1em 3em;cursor: pointer;" onclick="window.location='viewtransactionrequest.php'">
                              <center><h3>VIEW BOOK REQUESTS</h3></center>
                              <p><img src="images/issuedreturned.jpg" style="width:100%;height: 200px; border: 1px solid ;"></p>
                         </div>
                    </div>
					
                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb" style="padding: 1em 3em;cursor: pointer;" onclick="window.location='viewissuedbooks.php'">
                              <center><h3>ISSUED</h3></center>
                              <p><img src="images/barrowed.jpg" style="width:100%;height: 200px; border: 1px solid ;"></p>
                         </div>
                    </div>
					
					
                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb" style="padding: 1em 3em;cursor: pointer;" onclick="window.location='viewreturnedbooks.php'">
                              <center><h3>RETURNED</h3></center>
                              <p><img src="images/returned.jpg" style="width:100%;height: 200px; border: 1px solid ;"></p>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4" >
                         <div class="feature-thumb" style="padding: 1em 3em;cursor: pointer;" onclick="window.location='viewpenalty.php'">
                              <center><h3>PENALTIES/CHARGES</h3></center>
                              <p><img src="images/penaltyfine.jpg"  style="width:100%;height: 200px; border: 1px solid ;"></p>
                         </div>
                    </div>

               </div>
          </div>
     </section>


<?php
include("footer.php");
?>