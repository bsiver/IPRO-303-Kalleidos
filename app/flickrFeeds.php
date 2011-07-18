<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<body>
<form><input type="button" value="Back to search page" onCLick="history.go(-1);return true;"></form>
<?php
/* phpFlickr 3.1 provides getFriendlyGeodata($lat,$lon) and photos_getWithGeoData
 * photos_search = searches photos based off of tags, line 1078*/ 
error_reporting(E_ALL);
ini_set('display_errors','1');
require('/home/navteqipro/public_html/lib/flickrLib/phpFlickr.php');

# Key and Secret used for Authentication 
$key = '1391c9f23ccc47111e9d5136e684cd84';
$secret = '10f4a36cc44681be';
$flickrObj = new phpFlickr($key);
$tags = (empty($_POST["flick"]))? "":$_POST["flick"];
$lat = (empty($_POST["flickLat"]))?"41.85":$_POST["flickLat"];
$lon = (empty($_POST["flickLon"]))?"-87.65":$_POST["flickLon"];
$radio = (empty($_POST["option"]))? $tags : $_POST["option"];

try{
	# Retrieving photo urls
	$photos = $flickrObj->photos_search(array("tags"=>$tags,"tag_mode"=>"any",
		"lat"=>$lat,"lon"=>$lon,"accuracy"=>"16"));

	# Looping through the data
	foreach($photos['photo'] as $photo){
		echo '<a rel="nofollow" target="_blank" href="http://farm'.$photo['farm'].
			'.static.flickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].
			'.jpg" title="'.$photo['title'].'">';
		echo '<img src="http://farm'.$photo['farm'].'.static.flickr.com/'.$photo['server'].
			'/'.$photo['id'].'_'.$photo['secret'].'_s.jpg" alt="'.$photo['title'].'"/>';
		echo '</a>';
		echo 'Title:'.$photo['title'].'<br/>';
	}
	
}catch(Exception $e){
	echo $e;
}
?>
</body>
</html>
