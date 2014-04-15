<?php

function initMap(){
	$str=file_get_contents("details.txt");
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
function getDesp($dir,&$arrayEntry){
	include_once "log.php";
	// myLog("before handling...........\n");
	// myLog(print_r($arrayEntry,true));
	if(count($arrayEntry)<=0) return;
	$map=initMap();
	foreach ($arrayEntry as $i=>$entry){
		$filename=$dir."/".$entry['href'];
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
function writeDesp($img,$desp,$ref){
	file_put_contents("details.txt",$img."\n".$desp."\n".$ref."\n",FILE_APPEND|LOCK_EX);
//	myLog("writeDesp:".$img.":".$desp.":".$ref."\n");
}
// writeDesp("\\0旅行/1.jpg","发第三方发生地方 发生的发生","http://www.baidu.com");
// initMap();
?>


