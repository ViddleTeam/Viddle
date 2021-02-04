<?php
function get_ip($ip2long = true)
{
 if($_SERVER['HTTP_CLIENT_IP'])
 {
  $ip = $_SERVER['HTTP_CLIENT_IP'];
 }
 else if($_SERVER['HTTP_X_FORWARDED_FOR'])
 {
  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
 }
 else
 {
  $ip = $_SERVER['REMOTE_ADDR'];
 }

 if($ip2long)
 {
  $ip = ip2long($ip);
 }

 return $ip;
}
?>
