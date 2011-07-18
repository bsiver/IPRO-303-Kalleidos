<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<body>
<?php
error_reporting(-1);
ini_set('display_errors','1');
$areasAssoc = array();
$llsAssoc = array();

try{
	$con = mysql_connect("localhost","root","ipro303") or die("Can't connect to db!");
	mysql_select_db("ipro") or die("Can't select db!");
	$areasHandle = fopen("areas.txt","r") or die("Can't open sales file");
	$llsHandle = fopen("lls.txt","r") or die("Can't open sales file");

	while(!feof($areasHandle)){
		$area = trim(fgets($areasHandle));
		$areaList = explode(" ",$area,2);
		if(!empty($area))
			$areasAssoc[$areaList[0]] = $areaList[1];
	}
	print_r($areasAssoc);
	echo "<br/>_______________________________<br/>";
	while(!feof($llsHandle)){
		$ll = trim(fgets($llsHandle));
		$llList = explode(",",$ll);
		for($x = 0;$x < count($llList);$x++){
			$llList[$x] = trim($llList[$x],"\"");
		}
		if(!empty($ll))
			$llsAssoc[] = $llList;
	}
	print_r($llsAssoc);
	for($x = 0;$x < count($llsAssoc);$x++){
		if(isset($areasAssoc[$llsAssoc[$x][0]])){
			# since the zipcodes match up, we save the data into the db
			mysql_query("insert into Zipcodes values ".
				"('".$llsAssoc[$x][0]."','".$llsAssoc[$x][1]."','".$llsAssoc[$x][2]."','".
				$areasAssoc[$llsAssoc[$x][0]]."','".$llsAssoc[$x][3]."','".$llsAssoc[$x][4].
				"','".$llsAssoc[$x][5]."','".$llsAssoc[$x][6]."') ");
			echo $areasAssoc[$llsAssoc[$x][0]]."<br/>";
		}
	}
	fclose($areasHandle);
	fclose($llsHandle);
	mysql_close();
}
catch(Exception $e){
	echo $e;
}
?>
</body>
</html>
