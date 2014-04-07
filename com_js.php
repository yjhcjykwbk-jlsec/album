<?php
function unique($str){
  $n="";
  for($i=0;$i<count($str);$i++){
    if($i==0) $n.=$str[$i];
    else if($str[$i]==$str[$i-1]&&$str[$i]=='$') continue;
    else $n.=$str[$i];
  }
  return $n;
}
if(!isset($_REQUEST['dir'])||!isset($_REQUEST['img'])) {
  return;
}
$dir=$_REQUEST['dir'];
$img=$_REQUEST['img'];
$act=isset($_REQUEST['act'])?$_REQUEST['act']:"none";

$file="txt/$dir/$img.txt";
if(!file_exists("txt/$dir")) mkdir("txt/$dir");
if(!file_exists($file)) touch($file);


if($act=="clear"){
  file_put_contents($file,"$");
}else 
if(isset($_REQUEST['del'])){//delete id
  $del=$_REQUEST['del'];
  $txt=file_get_contents($file);
  $t=explode('$',$txt,-1);
  $nTxt="$";
  print_r($t);
  foreach($t as $i=>$j){
    echo $i.":".$j."\n";
    if($j==$del) continue;
    if($j=="") continue;
    else $nTxt.=($j."$");
    echo $nTxt."\n";
  }
  file_put_contents($file,$nTxt);
}else if($act=="get"){
  $txt=file_get_contents($file);
  echo $txt;
}else if($act=="set"){
  $com=$_REQUEST['com'];
  file_put_contents($file,$com.'$',FILE_APPEND);
}
?>

