<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<form><input type="button" value="Back to search page" onCLick="history.go(-1);return true;"></form>
<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
$user = "navteqipro";
$pw = "PASSw0rd";
$db = "ipro303";


	# Establishing db connection
	$con = mysql_connect('localhost',$user,$pw) or die("Can't connect!");
	mysql_select_db($db) or die("Can't select db");

	# Inserting data into db
	mysql_query("TRUNCATE TABLE Comments");
	mysql_query("TRUNCATE TABLE Images");
	mysql_query("TRUNCATE TABLE POI");
	mysql_close();
?>
</body>
</html>
