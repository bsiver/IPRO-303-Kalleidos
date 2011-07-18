<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<h1 id="header">Statistics run at <? echo date('m-d-Y H:i:s'); ?></h1>
<input type="button" value="Back to search page" onCLick="history.go(-1);return true;">
<?php
	error_reporting(E_ALL);
	ini_set('display_errors','1');
	# Global vars
	$host = "localhost";
	$user = "navteqipro";
	$pw = "PASSw0rd";
	$db = "ipro303";

try{
	# Establishing db connection
	$con = mysql_connect($host,$user,$pw) or die("Can't connect!");
	mysql_select_db($db) or die("Can't select db");
	
	# Fetch the current number of men in database
	$query = "SELECT count(*) FROM Comments WHERE gender = 'male'";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	$numguys = $row[0];
	
	# Fetch the current number of women in database
	$query = "SELECT count(*) FROM Comments WHERE gender = 'female'";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	$numgirls = $row[0];
	
	# Put today's date in standarized format
	$date = date('Y-m-d H:i:s');
	
	
	
}catch(Exception $e){
		echo $e;
}
	
	# Display info about genders
	echo "<table border='1'><tr>";
	echo "<td>Date</td>";
	echo "<td>Number of Girls</td>";
	echo "<td>Number of Guys</td>";
	echo "</tr>\n";
	
	echo "<td>$date</td>";
	echo "<td>$numgirls</td>";
	echo "<td>$numguys</td>";
?>

<?php
	# Fetch the current number of mentions of Chicago in the database
	$query = "SELECT count( * )FROM Comments WHERE location LIKE '%chi%'";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	$nummentions = $row[0];
	
	# Display info in table
	echo "<table border='1'><tr>";
	echo "<td>Date</td>";
	echo "<td>Number of Mentions</td>";
	echo "</tr>\n";
	
	echo "<td>$date</td>";
	echo "<td>$nummentions</td>";
?>

<?php
	# Find most recent 30 entries from Comments table
	$query = "SELECT * FROM Comments ORDER BY date DESC";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	$fields_num = mysql_num_fields($result);
	
	// print table headers
	echo "<table border='1'><tr>";
	echo "<td>Name</td>";
	echo "<td>Text</td>";
	echo "<td>Location</td>";
	echo "<td>Date</td>";
	echo "<td>Date</td>";
	echo "<td>Data Source</td>";
	echo "<td>Gender</td>";
	echo "</tr>\n";
	
	// print table data in rows
	while($row = mysql_fetch_row($result))
	{
		echo "<tr>";
		foreach($row as $cell)
			echo "<td>$cell</td>";
		echo "</tr>\n";
	}
	
	

	
	mysql_free_result($result);
	
?>
<br>
</body>

</html>
