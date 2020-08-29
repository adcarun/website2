<?php
	$db_host	= "localhost";
	$db_name	= "san_sanivation";
	$db_user 	= "san_sanivation";
	$db_password = "S@nt1v7#oni"; 
	
	/*$db_host	= "localhost";
	$db_name	= "sanivation";
	$db_user 	= "root";
	$db_password    = "";*/
	$link=mysql_connect($db_host,$db_user,$db_password) or die(mysql_error());
	mysql_select_db($db_name) or die(mysql_error());
?>
