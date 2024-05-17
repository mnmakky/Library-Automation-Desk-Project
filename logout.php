<?php
session_start();
session_destroy();

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");

echo "<script>window.location='dashboard.php';</script>";
		
?>