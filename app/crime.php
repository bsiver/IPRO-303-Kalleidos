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

	$result = mysql_query("select count(*) from Comments where category='crime'");
	$cnt = 0;
	$source = 0;
	if($line = mysql_fetch_array($result,MYSQL_BOTH))
	{
		echo "n=".$line['count(*)'];	}
	$number = $line['count(*)'];
	echo "&";
	$result = mysql_query("select comment, source, date, area from Comments where category='crime'");
	for($i = 0 ; $i < $number ; $i++)
	{
		$line = mysql_fetch_array($result);
		$line['comment'] = str_replace('&quot', '"', $line['comment']);
		$line['comment'] = str_replace('&', "and", $line['comment']);

		echo "c".$cnt."=".$line['comment']."&";
		echo "s".$source."=".$line['source']."&";
		echo "d".$cnt."=".$line['date']."&";
		echo "a".$cnt."=".$line['area']."&";



		echo "t".$cnt."=";		
		if(strpos($line['comment'], 'robb')
		 || strpos($line['comment'], 'theft') 
		 || strpos($line['comment'], 'Robb')		 
		 || strpos($line['comment'], 'THEFT') 
		 || strpos($line['comment'], 'ROBB')
		 || strpos($line['comment'], 'Theft') )
			echo "robbery";
		else if(stripos($line['comment'], "murder") 
		|| stripos($line['comment'], "assassination")
		|| stripos($line['comment'], "Murder") 
		|| stripos($line['comment'], "Assassinat") 
		|| stripos($line['comment'], "MURDER") 
		|| stripos($line['comment'], "ASSASSINAT") 
		)
			echo "murder";		
		else if(stripos($line['comment'], "fraud")
		|| stripos($line['comment'], "Fraud")
		|| stripos($line['comment'], "FRAUD")
		|| stripos($line['comment'], "Felony")
		|| stripos($line['comment'], "felony")
		|| stripos($line['comment'], "FELONY"))
			echo "fraud";
		else
			echo "null";
		echo "&";
		$cnt++;
		$source++;
	}

	echo "cnt=" . $cnt;
	mysql_close();
}catch(Exception $e){
	echo $e;
}
?>
