<?php
require('./bank.php');
error_reporting(E_ALL);
ini_set('display_error','1');
try{
	$bank = new Bank();
	$bool = $bank->searchCrime("hit");
	echo $bank->getCrimeList();
}catch(Exception $e){
	echo $e;
}

?>
