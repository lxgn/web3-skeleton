<?php
//phpinfo();
//print "aaaaaaaaaaaa";
$t = $_SERVER['HTTP_X_FORWARDED_PROTO'];
//print $t;
switch($t)
{
	case "https":
	break;
	default:
	$kuda = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header("Location: $kuda");
	//print $kuda;
	die;
}
//$t = json_decode($t,1);
//print_r($t);
include "metamask.php";
?>