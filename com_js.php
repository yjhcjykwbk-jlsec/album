<?php
function score($score){
	$file="star.txt";
	if(!file_exists($file)) touch($file);
	file_put_contents($file," ".$score,FILE_APPEND);
	if($score>4){
		return "给这么高分,谢谢您的支持！";
	}else if($score>3){
		return "竟然及格了哈...";
	}else {
		return "没及格@@,".$score*20;
	}
}
function unique($str){
  $n="";
  for($i=0;$i<count($str);$i++){
    if($i==0) $n.=$str[$i];
    else if($str[$i]==$str[$i-1]&&$str[$i]=='$') continue;
    else $n.=$str[$i];
  }
  return $n;
}


$act=isset($_REQUEST['act'])?$_REQUEST['act']:"none";
if($act=="score"){
	$score=isset($_REQUEST['score'])?$_REQUEST['score']:0;
	echo	score($score);
	return;
}


if(!isset($_REQUEST['dir'])||!isset($_REQUEST['img'])||!isset($_REQUEST['user'])){
  return;
}

$user=$_REQUEST['user'];
$dir=$_REQUEST['dir'];
$img=$_REQUEST['img'];
$file="txt/$user/$dir/$img.txt";
if(!file_exists("txt/$user/$dir")) mkdir("txt/$user/$dir");
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
  $com=str_replace("\n","<br>",$com);
  file_put_contents($file,$com.'$',FILE_APPEND);
}
?>

