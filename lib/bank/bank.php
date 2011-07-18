<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
class Bank{
	private static $crimeList = array();
	private static $salesList = array();

	public function __construct(){
		self::importCrime();
		self::importSales();;
	}
	private function importCrime(){
		/* Importing crime words from a text file */
		$crime_handle = fopen("/home/navteqipro/public_html/doc/crimeWords.txt","r") 
			or die("Can't open crime file");
		while(!feof($crime_handle)){
			array_push(self::$crimeList,fgets($crime_handle));
		}
		array_pop(self::$crimeList);
		fclose($crime_handle);
	}
	private function importSales(){
		/* Importing sales words from a text file */
		$sales_handle = fopen("/home/navteqipro/public_html/doc/salesWords.txt","r") 
			or die("Can't open sales file");
		while(!feof($sales_handle)){
			array_push(self::$salesList,fgets($sales_handle));
		}
		array_pop(self::$salesList);
		fclose($sales_handle);
	}
	public function searchCrime($word = ""){
		$found = false;
		foreach(self::$crimeList as $crime){
			if(strcasecmp(trim($crime),trim($word)) == 0)
				$found = true;
		}
		return $found;
	}
	public function searchSales($word = ""){
		$found = false;
		foreach(self::$salesList as $sale){
			if(strcasecmp(trim($sale),trim($word)) == 0)
				$found = true;
		}
		return $found;
	}
	public function getCrimeList() {
		return self::$crimeList;
	}
	public function getSalesList() {
		return self::$salesList;
	}
}
?>
