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

	$result = mysql_query("select count(*) from Emotions;");
	$cnt = 0;
	if($line = mysql_fetch_array($result,MYSQL_BOTH))
	{
		echo "n=".$line['count(*)'];
	}
	$number = $line['count(*)'];
	echo "&";
//	$number = 92;
	$result = mysql_query("select text, gender, type from Emotions;");
	for($i = 0 ; $i <$number ; $i++)
	{
		$line = mysql_fetch_array($result);
		$line['text'] = str_replace('&quot', '"', $line['text']);
		$line['text'] = str_replace('&', "and", $line['text']);
		echo "t".$cnt."=".$line['text']."&";
		echo "g".$cnt."=".$line['gender']."&";
		echo "type".$cnt."=".$line['type']."&";
		$cnt++;
	}

	echo "cnt=" . $cnt;
	mysql_close();
}catch(Exception $e){
	echo $e;
}
?>
