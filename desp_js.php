<?php
//desp_js.php(user,dir,name,desp,ref)
include_once "desp.php";
if(!isset($_REQUEST['name'])||!isset($_REQUEST['dir'])||!isset($_REQUEST['user']))
{
	echo "fail";
	return;
}
$user=$_REQUEST['user'];
$dir=$_REQUEST['dir'];
$name=$_REQUEST['name'];
$desp=isset($_REQUEST['desp'])?($_REQUEST['desp']):"";
$ref=isset($_REQUEST['ref'])?($_REQUEST['ref']):"";
writeDesp($user,$dir,$name,$desp,$ref);
echo "ok";
?>
