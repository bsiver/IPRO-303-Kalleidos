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
require('/home/navteqipro/public_html/lib/fourSqLib/EpiCurl.php');
require('/home/navteqipro/public_html/lib/fourSqLib/EpiFoursquare.php');
require('/home/navteqipro/public_html/lib/fourSqLib/EpiSequence.php');

# Key and Secret used for OAuth Authentication and global vars
$clientId = 'ZTMMWGLT5GO5X5A0JN1CAZ22F0MQECYFYIFKGASRS215FKPD';
$clientSecret = 'Y2C2IBP3DG0M5B1K4ZVK2MQ2RXPWXNZ1N3KNFHHXWV0TI1FE';
$fs = new EpiFoursquare($clientId,$clientSecret);
$text = $_POST["four"];
$lat = (empty($_POST["fourLat"]))?"41.85":$_POST["fourLat"];
$lon = (empty($_POST["fourLon"]))?"-87.65":$_POST["fourLon"];
$host = "localhost";
$user = "navteqipro";
$pw = "PASSw0rd";
$db = "ipro303";

try{
	# Establishing db connection
	$con = mysql_connect($host,$user,$pw) or die("Can't connect!");
	mysql_select_db($db) or die("Can't select db");

	# Retrieving tip information from chicago, based on user input 
	$tips = $fs->get('/tips/search',array('ll'=>$lat.','.$lon,'query'=>$text));
	$json_text = json_decode($tips->responseText);

	# Looping through the data
	foreach($json_text->response->tips as $tip){
		# Local vars
		$text = isset($tip->text)?$tip->text:"";
		$venue = isset($tip->venue)?$tip->venue:"";
		$user = isset($tip->user)?$tip->user:"";
		$location = isset($venue->location)?$venue->location:"";
		$category = isset($venue->categories[0])?$venue->categories[0]:"";
		$contact = isset($venue->contact)?$venue->contact:"";

		# venue info
		$name = isset($venue->name)?$venue->name:"";
		$phone = isset($contact->phone)?$contact->phone:"";

		# location based info
		$address = isset($location->address)?$location->address:"";
		$city = isset($location->city)?$location->city:"";
		$state = isset($location->state)?$location->state:"";
		$zip = isset($location->postalCode)?$location->postalCode:"";

		# other info on the venue
		$type = isset($category->name)?$category->name:"";
		$pic = isset($category->icon)?$category->icon:"";

		# info on the foursquare user
		$firstname = isset($user->firstName)?$user->firstName:"";
		$lastname = isset($user->lastName)?$user->lastName:"";
		$gender = isset($user->gender)?$user->gender:"";
		$photo = isset($user->photo)?$user->photo:"";

		echo "<p><b>Text: </b>$text</p><br/>";
		echo "<b>Location information: </b><br/><ul>";
		echo "<li>Name: $name</li>";
		echo "<li>Address: $address</li>";
		echo "<li>City: $city</li>";
		echo "<li>State: $state</li>";
		echo "<li>Zip: $zip</li></ul>";
		echo "<li>Phone: $phone</li>";
		echo "<b>Venue information: </b><br/><ul>";
		echo "<li>Type: $type</li>";
		echo "<li>Picture: <img src=$pic></li></ul>";
		echo "<b>User information: </b><br/><ul>";
		echo "<li>Name: $firstname $lastname</li>";
		echo "<li>Gender: $gender</li>";
		echo "<li>Photo: <img src=$photo></li></ul>";
		
		# Inserting data into db
		$date = date('Y-m-d H:i:s');
		mysql_query("insert into POI (name,address,city,state,zip,phone,type) 
			values ('$name','$address','$city','$state','$zip','$phone','$type')");
		mysql_query("insert into Comments (username,comment,location,date,category,source,gender) 
			values ('$firstname $lastname','$text','$name','$date','Other','Foursquare','$gender')");
		mysql_query("insert into Images (username,url,date,category) 
			values ('$firstname $lastname','$photo','$date','Other')");
	}
	mysql_close();	
	
}catch(Exception $e){
	echo $e;
}
?>
</body>
</html>
