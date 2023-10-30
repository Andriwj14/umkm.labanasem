<?php
require("sistem.php");
session_start();


 if   ($_SESSION['ses_ip'] !=$ip )
{ 
	echo $ip;
	dbConnect();
	$query ="INSERT INTO tcounter Values ('$ip','$reff','$agent','$file','$genid',NOW())";
	mysql_query($query) or error( mysql_error() );	
}
else 
{ 
	$blank   ="";   
} 
?>