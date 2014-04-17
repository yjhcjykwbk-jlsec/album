<?php
include_once "desp.php";
if(!isset($_REQUEST['name'])||!isset($_REQUEST['dir']))
{
	echo "fail";
	return;
}
$dir=$_REQUEST['dir'];
$name=$_REQUEST['name'];
$desp=isset($_REQUEST['desp'])?($_REQUEST['desp']):"";
$ref=isset($_REQUEST['ref'])?($_REQUEST['ref']):"";
writeDesp($dir,$name,$desp,$ref);
echo "ok";
?>
