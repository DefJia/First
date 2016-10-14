<?php 
date_default_timezone_set("PRC");

function ip() { 
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) { 
		$ip = getenv('HTTP_CLIENT_IP'); 
	} 
	elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) { 
		$ip = getenv('HTTP_X_FORWARDED_FOR'); 
	} 
	elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) { 
		$ip = getenv('REMOTE_ADDR'); 
	} 
	elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) { 
		$ip = $_SERVER['REMOTE_ADDR']; 
	} 
	return preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : 'unknown'; 
} 
$ip=ip(); 
//echo "您的ip是:" . $ip; 
 
$times=date("Y-m-d"); 
$time=date("Y-m-d H:i:s"); 
$str=$ip." ".$time; 
$l=fopen("$times.txt","a+"); 
fwrite($l,$str. "\n"); 
fclose($l); 
?>