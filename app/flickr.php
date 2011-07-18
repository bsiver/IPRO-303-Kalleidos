<?php 
error_reporting(E_ALL);
ini_set('display_errors','1');
$host = "localhost";
$user = "navteqipro";
$pw = "PASSw0rd";
$db = "ipro303";

try{
	$con = mysql_connect($host,$user,$pw) or die("Can't connect!");
	mysql_select_db($db) or die("Can't select db");

	$result = mysql_query("select count(*) from Images where category='flickr' order by date desc;");
	$cnt = 0;
	if($line = mysql_fetch_array($result,MYSQL_BOTH))
	{
		echo "n=".$line['count(*)'];
	}
	$number = $line['count(*)'];
	if($number >= 110) $number = 110;
	echo "&";
	$result = mysql_query("select url, area from Images where category='flickr' order by date desc");
	for($i = 0 ; $i <$number ; $i++)
	{
		$line = mysql_fetch_array($result);
		$line['url'] = str_replace('&quot', '"', $line['url']);
		$line['url'] = str_replace('&', "and", $line['url']);

		echo "u".$cnt."=".$line['url']."&";
		echo "a".$cnt."=".$line['area']."&";
		$cnt++;
	}
	echo "cnt=" . $cnt;
	mysql_close();
}catch(Exception $e){
	echo $e;
}
?>
