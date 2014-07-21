<?php

function initMap($user,$dir){
	$str=file_get_contents("DATASET/$user/".$dir."/details.txt");
	$arr=explode("\n",$str);
	$map=array();
	// print_r($arr);
	for($i=0;$i+2<count($arr);$i+=3){
		$item['desp']=$arr[$i+1];
		$item['ref']=$arr[$i+2];
		$map[$arr[$i]]=$item;
	}
	return $map;
}
function getDesp($user,$dir,&$arrayEntry){
	include_once "log.php";
	// myLog("before handling...........\n");
	// myLog(print_r($arrayEntry,true));
	if(count($arrayEntry)<=0) return;
	$map=initMap($user,$dir);
	foreach ($arrayEntry as $i=>$entry){
		$filename=$entry['href'];
		if(isset($map[$filename])){
			$item=$map[$filename];
			$arrayEntry[$i]['desp']=$item['desp'];
			$arrayEntry[$i]['ref']=$item['ref'];
		}
		else {
			$arrayEntry[$i]['desp']="";
			$arrayEntry[$i]['ref']="";
		}
	}
	// myLog("after handling...........\n");
	// myLog(print_r($arrayEntry,true));
}
function writeDesp($user,$dir,$img,$desp,$ref){
  $img=str_replace("\n","",$img);
  $desp=str_replace("\n","",$desp);
  $ref=str_replace("\n","",$ref);
	$str=file_get_contents("DATASET/$user/".$dir."/details.txt");
	$arr=explode("\n",$str);
  $desp=str_replace("\n"," ",$desp);
	for($i=0;$i+2<count($arr);$i+=3){
		if(strcmp($arr[$i],$img)==0){
			$arr[$i+1]=$desp;
			$arr[$i+2]=$ref;
			$str="";
			foreach($arr as $i=>$txt){
        if($i<count($arr)-1) $str.=$txt."\n";
        //last line
        else $str.=$txt;
			}
			file_put_contents("DATASET/$user/".$dir."/details.txt",$str);
			return;
		}
	}
	file_put_contents("DATASET/$user/".$dir."/details.txt",$img."\n".$desp."\n".$ref."\n",FILE_APPEND|LOCK_EX);
//	myLog("writeDesp:".$img.":".$desp.":".$ref."\n");
}
// initMap();
?>


