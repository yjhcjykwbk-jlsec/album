<?php
include_once "db.php";

if(!isset($_REQUEST['action'])) {echo "action not set";return;}
$action=$_REQUEST['action'];

if($action=="delImg"){
  if(!isset($_REQUEST['img'])) {echo "没有设置要删除的图片";return;}
  $img=$_REQUEST['img'];
  if(unlink("DATASET/".$img)) {echo "true";return;}
  echo "delete failed:DATASET/".$img;
  return;
}
echo "action not known";
?>
