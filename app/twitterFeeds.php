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
# Global vars
$text = $_POST["twit"];
$lat = (empty($_POST["twitLat"]))?"41.85":$_POST["twitLat"];
$lon = (empty($_POST["twitLon"]))?"-87.65":$_POST["twitLon"];
$host = "localhost";
$user = "navteqipro";
$pw = "PASSw0rd";
$db = "ipro303";

try{
	# Establishing db connection
	$con = mysql_connect($host,$user,$pw) or die("Can't connect!");
	mysql_select_db($db) or die("Can't select db");

	# The retrieving JSON file from twitter and saving it
	$search = "http://search.twitter.com/search.json?callback=?&lang=en&show_user=true&q=$text&".
		"geocode=$lat%2C$lon%2C8km";
	$json_text = json_decode(file_get_contents($search));
	# Looping through the data
	foreach($json_text->results as $stuff){
		# Filling in uninitialized values
		$user = isset($stuff->from_user)?$stuff->from_user:"";
		$tweet = isset($stuff->text)?$stuff->text:"";
		$location = isset($stuff->location)?$stuff->location:"";
		$time = isset($stuff->created_at)?$stuff->created_at:"";
		$date = date("Y-m-d H:i:s",strtotime($time));
		$pic = isset($stuff->profile_image_url)?$stuff->profile_image_url:"";

		# Printing data into webpage
		echo "<p><b>User: </b>$user<br/>";
		echo "<b>Tweet: </b>$tweet<br/>";
		echo "<b>Location: </b>$location<br/>";
		echo "<b>Date: </b>$date<br/>";
		echo "<b>Profile Picture: </b><img src=$pic></p>";

		# Inserting data into db
		mysql_query("insert into POI (name) values ('$location')");
		mysql_query("insert into Comments (username,comment,location,date,category,source) 
			values ('$user','$tweet',
				'$location','$date','Other','Twitter')");
		mysql_query("insert into Images (username,url,date,category) 
			values ('$user','$pic','$date','Other')");
	}
	mysql_close();
}catch(Exception $e){
	echo $e;
}
?>
</body>
</html>
