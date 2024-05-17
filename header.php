<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include("dbconnection.php");
date_default_timezone_set('UK');
$dt=date("Y-m-d");
$tim = date("H:i:s");
include("functions.php");
?>
<html lang="en">
<head>

     <title>Library Automation Desk</title>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/templatemo-style.css">
     <link rel="stylesheet" href="css/jquery.dataTables.min.css">
<style>
.dataTables_length select {
   background-color: grey;
}
.dataTables_filter input {
   background-color: grey;
}
.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
    color: #fff3f3;
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
    cursor: hand;
    color: #fbfbfb !important;
    border: 1px solid transparent;
    border-radius: 2px;
}
</style>
<style>
.err {
   color: red;
   font-weight: 700;
}
</style>
</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>


     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">

	<?php
	if($_SESSION['type'] != "Admin")
	{
	?>
               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT  -->
                    <a href="index.php" class="navbar-brand">Library Automation Desk</a>
               </div>
	<?php
	}
	?>
               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav 
					<?php
					if($_SESSION['type'] != "Admin")
					{
					echo " navbar-nav-first ";
					}
					?>">
						 
<?php
if($_SESSION['type'] == "Admin")
{
?>

			<li><a href="dashboard.php" class="smoothScroll">Dashboard</a></li>
	   <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Book <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="book.php">Add book</a></li>
          <li><a href="viewbook.php">View book</a></li>
          <li><a href="viewbookstock.php">View book stock</a></li>
			<?php
			if($_SESSION['type'] == "Admin")
			{
			?>
				  <li><a href="bookcategory.php">Add book category</a></li>
				  <li><a href="viewbookcategory.php">View book category</a></li>
			<?php
			}
			?>
        </ul>
      </li>
	  

	   <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Librarian<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="librarian.php">Add librarian</a></li>
          <li><a href="viewlibrarian.php">View librarian</a></li>
        </ul>
		
      </li>
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Book Issue-Return<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="booklist.php">Issue Book</a></li>
          <li><a href="issuerequestbook.php">Issue request</a></li>
          <li><a href="viewissuedbooks.php">Issued book</a></li>
          <li><a href="viewreturnedbooks.php">Returned book</a></li>
        </ul>
    </li>
	  
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Members<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="student.php">Add members</a></li>
          <li><a href="viewstudent.php">View members</a></li>
        </ul>
		
      </li>
	  
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Report<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="issuerequestbook.php">Book Request report</a></li>
          <li><a href="viewissuedbooks.php">Book Issue report</a></li>
		  <li><a href="viewreturnedbooks.php">Book Return report</a></li>
          <li><a href="viewpenalty.php">Penalty report</a></li>
          <li><a href="viewtransaction.php">Book Transaction Report</a></li>
        </ul>		
      </li>
	  
	  	 <?php
	if($_SESSION['type'] == "Admin")
	{
	?>
	   <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<?php
				if($_SESSION['type'] == "Admin")
				{
				?>
						<li><a href="branch.php">Add branch</a></li>
						<li><a href="viewbranch.php">View Branch</a></li>
          	<li><a href="course.php">Add Department</a></li>
          	<li><a href="viewcourse.php">View Department</a></li>
				<?php
				}
				?>
			  <li><a href="finesetting.php">Fine settings</a></li>          
			</ul>		
		</li>
	  
	  
	 <?php
	}
	?>


<?php
}
else if($_SESSION['type'] == "Librarian")
{
?>


		<li><a href="dashboard.php" class="smoothScroll">Dashboard</a></li>

	   <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Book <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="book.php">Add book</a></li>
          <li><a href="viewbook.php">View book</a></li>
		  <li><a href="bookstock.php">Add book stock</a></li>
          <li><a href="viewbookstock.php">View book stock</a></li>
        </ul>
      </li>
 
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Book Issue-Return<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="issuerequestbook.php">Issue request</a></li>
          <li><a href="viewissuedbooks.php">Issued book</a></li>
          <li><a href="viewreturnedbooks.php">Returned book</a></li>
          
        </ul>		
      </li>
	  
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Student<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="student.php">Add student</a></li>
          <li><a href="viewstudent.php">View student</a></li>
        </ul>		
      </li>
	  
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Report<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="issuerequestbook.php">Book Request report</a></li>
          <li><a href="viewissuedbooks.php">Book Issue report</a></li>
		  <li><a href="viewreturnedbooks.php">Book Return report</a></li>
          <li><a href="viewpenalty.php">Penalty report</a></li>
          <li><a href="viewtransaction.php">Book Transaction Report</a></li>
        </ul>		
      </li>

<?php
}
else if($_SESSION['type'] == "Student")
{
?>


		<li><a href="dashboard.php" class="smoothScroll">Dashboard</a></li>

	   <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Book <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="addbook.php">Add book</a></li>
          <li><a href="viewbook.php">View book</a></li>
		  <li><a href="addbookstock.php">Add book stock</a></li>
          <li><a href="viewbookstock.php">View book stock</a></li>
        </ul>
      </li>

	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Book Issue-Return<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="issuebook.php">Issue book</a></li>
          <li><a href="returnbook.php">Return book</a></li>
        </ul>		
      </li>
	  
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Members<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="addstudent.php">Add members</a></li>
          <li><a href="viewstudent.php">View members</a></li>
        </ul>		
      </li>
	  
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Report<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="bookissuereport.php">Book issue report</a></li>
          <li><a href="bookreturnreport.php">Book return report</a></li>
		  <li><a href="bookstockreport.php">Book stock report</a></li>
          <li><a href="viewpenalty.php">Penalty report</a></li>
        </ul>		
      </li>


<?php
}
else
{
?>

                         <li><a href="#top" class="smoothScroll">Home</a></li>
                         <li><a href="#about" class="smoothScroll">About</a></li>
                         <li><a href="#contact" class="smoothScroll">Contact</a></li>
<?php
}
?>
	  
						
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
	<?php
		if(isset($_SESSION["librarian_id"]))
		{
	?>
		    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-address-book-o"></i>Account <span class="caret"></span></a>
			<ul class="dropdown-menu">
			  <li><a href="librarianprofile.php"><i class="fa fa-address-book-o"></i>Profile</a></li>
			  <li><a href="libchngpswd.php"><i class="fa fa-address-book-o"></i>Change Password</a></li>
			  <li><a href="logout.php"><i class="fa fa-address-book-o"></i>Logout</a></li>
			</ul>
		</li>
	<?php
		}
		else if(isset($_SESSION['studentid']))
		{
	?>
		    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-address-book-o"></i>Account <span class="caret"></span></a>
			<ul class="dropdown-menu">
			  <li><a href="studentpanel.php"><i class="fa fa-address-book-o"></i>My Home</a></li>
			  <li><a href="studentprofile.php"><i class="fa fa-address-book-o"></i>Profile</a></li>
			  <li><a href="studchangepassword.php"><i class="fa fa-address-book-o"></i>Change Password</a></li>
			  <li><a href="logout.php"><i class="fa fa-address-book-o"></i>Logout</a></li>
			</ul>
		</li>
	<?php
		}
		else
		{
	?>
						 
            <li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>
            <li><a href="register.php"><i class="fa fa-address-book-o"></i> Register</a></li>

	<?php
		}
	?>
                    </ul>
               </div>

          </div>
     </section>
