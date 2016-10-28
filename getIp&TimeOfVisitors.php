<?php 
//try to get a start!
date_default_timezone_set("PRC");//make sure the date() match the timezone

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

// 利用新浪接口根据ip查询所在区域信息 
/* $res0 = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=$ip"); 
$res0 = json_decode($res0); 
print_r($res0); 
echo "<br />"; */ 

// 利用淘宝接口根据ip查询所在区域信息 
$res1 = file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=$ip"); 
$res1 = json_decode($res1); 
/* print_r($res1); */ 

error_reporting(0);
?>
