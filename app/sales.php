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

	$result = mysql_query("select count(*) from Comments where category='sales'");
	$cnt = 0;
	$source = 0;
	if($line = mysql_fetch_array($result,MYSQL_BOTH))
	{
		echo "n=".$line['count(*)'];	}
	$number = $line['count(*)'];
	echo "&";
	$result = mysql_query("select comment, date, keyword, location, area from Comments where category='sales'");

	for($i = 0 ; $i < $number ; $i++)
	{
		$line = mysql_fetch_array($result);
		$line['comment'] = str_replace('&quot', '"', $line['comment']);
		$line['comment'] = str_replace('&', "and", $line['comment']);
		$line['location'] = str_replace('&', "and", $line['location']);
		$line['keyword'] = str_replace('&', "and", $line['keyword']);
		echo "c".$cnt."=".$line['comment']."&";
		echo "d".$cnt."=".$line['date']."&";
		echo "k".$cnt."=".$line['keyword']."&";		
		echo "l".$cnt."=".$line['location']."&";
		echo "a".$cnt."=".$line['area']."&";




		echo "t".$cnt."=";		
		if(strpos($line['comment'], 'macy')
		 || strpos($line['comment'], 'Macy')
		 || strpos($line['comment'], 'MACY') )
			echo "Macy's";
		else if(stripos($line['comment'], "Nords") 
		|| stripos($line['comment'], "nords") 
		|| stripos($line['comment'], "NORDS") 
		)
			echo "Nordstorm";		
		else if(stripos($line['comment'], "Sephora")
		|| stripos($line['comment'], "sephora")
		|| stripos($line['comment'], "SEPHORA"))
			echo "Sephora";
		else if(stripos($line['comment'], "Aberc")
		|| stripos($line['comment'], "aberc")
		|| stripos($line['comment'], "ABERC"))
			echo "Abercrombie";
		else if(stripos($line['comment'], "NIKE")
		|| stripos($line['comment'], "Nike")
		|| stripos($line['comment'], "nike"))
			echo "NIKE";
		else if(stripos($line['comment'], "GAP")
		|| stripos($line['comment'], "gap"))
			echo "GAP";
		else if(stripos($line['comment'], "Blooming")
		|| stripos($line['comment'], "blooming")
		|| stripos($line['comment'], "BLOOMING"))
			echo "Bloomingdales";
		else if(stripos($line['comment'], "H&M")
		|| stripos($line['comment'], "h&m"))
			echo "HandM";
		else if(stripos($line['comment'], "GODIVA")
		|| stripos($line['comment'], "godiva")
		|| stripos($line['comment'], "Godiva"))
			echo "GODIVA";
		else if(stripos($line['comment'], "Kiehls")
		|| stripos($line['comment'], "kiehls")
		|| stripos($line['comment'], "KIEHLS"))
			echo "Kiehls";
		else if(stripos($line['comment'], "Lancom")
		|| stripos($line['comment'], "LANCOM")
		|| stripos($line['comment'], "lancom"))
			echo "Lancom";
		else if(stripos($line['comment'], "UTLA")
		|| stripos($line['comment'], "utla")
		|| stripos($line['comment'], "Utla"))
			echo "ULTA";
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
