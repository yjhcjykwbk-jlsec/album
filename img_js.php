<?php
include_once "db.php";

if(!isset($_REQUEST['action'])) {echo "action not set";return;}
$action=$_REQUEST['action'];

if($action=="del"){
  if(!isset($_REQUEST['img'])) {echo "没有设置要删除的图片";return;}
  if(!isset($_REQUEST['class'])) {echo "class not set";return;}
  $img=$_REQUEST['img'];
  $class=$_REQUEST['class'];
  if(unlink("DATASET/".$class."/".$img)) {echo "delete true";return;}
  echo "delete failed:DATASET/".$class."/".$img;
  return;
}
echo "action not known";
?>
