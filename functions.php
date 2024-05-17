
<?php
function library_settings()
{
	include("dbconnection.php");
	$sql = "SELECT * FROM finesettings";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	return mysqli_fetch_array($qsql);
}
function count_student_borrowed_books($studentid)
{
	include("dbconnection.php");
	$lib_setting = library_settings();
	$sqlbookborrowcount = "SELECT count(*) as totalbookissued FROM transaction WHERE studentid='" . $studentid . "' AND transtype='Issued'";
	$qsqlbookborrowcount = mysqli_query($con,$sqlbookborrowcount);
	$rsbookborrowcount = mysqli_fetch_array($qsqlbookborrowcount);
	return array("max_book_limit" => $lib_setting['nobooks'],"totalbookissued" => $rsbookborrowcount['totalbookissued']);
}
function book_available_qty($bookid)
{
	include("dbconnection.php");
	$sql = "SELECT sum(qty) as totqty FROM book_stock WHERE bookid='$bookid' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	return mysqli_fetch_array($qsql);
}
function chk_book_available_or_not($bookid)
{
	include("dbconnection.php");
	$arrbookqty = book_available_qty($bookid);
	$sql = "SELECT count(*) as borrowedbookqty FROM transaction WHERE bookid='$bookid' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	$rsborrowedbookqty = mysqli_fetch_array($qsql);
	return array("totbook_stk_qty" => $arrbookqty['totqty'],"totborrowedbookqty" => $rsborrowedbookqty['borrowedbookqty']);
}
?>