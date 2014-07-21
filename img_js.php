<?php
include_once "db.php";
//img_js.php(action=del,user=xx,dir=xx,img=xx)

if(!isset($_REQUEST['action'])) {echo "action not set";return;}
$action=$_REQUEST['action'];

if($action=="del"){
  if(!isset($_REQUEST['img'])) {echo "没有设置要删除的图片";return;}
  if(!isset($_REQUEST['user'])) {echo "没有设置用户";return;}
  if(!isset($_REQUEST['dir'])) {echo "dir not set";return;}
  $img=$_REQUEST['img'];
  $dir=$_REQUEST['dir'];
  if(unlink("DATASET/$user/".$dir."/".$img)) {echo "delete true";}
  if(is_file("view/$user/".$dir."/".$img)) {unlink("view/$user/".$dir."/".$img);}
  if(is_file("thumb/$user/".$dir."/".$img)) {unlink("thumb/$user/".$dir."/".$img);}
  return;
}
echo "action not known";
?>
