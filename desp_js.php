<?php
include_once "desp.php";
if(!isset($_REQUEST['name'])||!isset($_REQUEST['desp']))
{
	echo "fail";
	return;
}
$ref=isset($_REQUEST['ref'])?($_REQUEST['ref']):"";
writeDesp($_REQUEST['name'],$_REQUEST['desp'],$ref);
echo "ok";
?>
