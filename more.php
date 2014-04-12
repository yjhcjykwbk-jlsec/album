<?php
// getImageSize:
// Array
// (
// [0] => 350
// [1] => 318
// [2] => 2
// [3] => width=”350″ height=”318″
// [bits] => 8
// [channels] => 3
// [mime] => image/jpeg
// )
function debug($str,$str1=""){
  if(isset($_REQUEST['debug'])) { 
    print_r($str);
    if($str1!="") {
    	echo ":\n";
	print_r($str1);
    }
    echo "\n";
  }
}

//judge if the type is image
function isPic($type){
  //1 = GIF，2 = JPG，3 = PNG，4 = SWF，5 = PSD，6 = BMP，7 = TIFF(intel byte order)，8 = TIFF(motorola byte order)，9 = JPC，10 = JP2，11 = JPX，12 = JB2，13 = SWC，14 = IFF，15 = WBMP，16 = XBM；
  switch($type){
  case 1: case 2: case 3: case 7: case 8:
    return true;
  default:
    return false;
  }
}

//list the images under dir
function listDir($dir,$from,$to){
  $thumbDir="thumb/".$dir;
  $viewDir="view/".$dir;
  $imgDir="DATASET/".$dir;
  if(!file_exists($thumbDir))
    @mkdir($thumbDir);
  if(!file_exists($viewDir))
    @mkdir($viewDir);
  $items=array();
  if ($handle = opendir($imgDir)) {
    /* This is the correct way to loop over the directory. */
    $i=0;
    $prev="";$next="";
    while (false !== ($entry = readdir($handle))) {
      $filename=$imgDir."/".$entry;
      if(is_dir($filename)) continue;
	
      $info = getimagesize($filename);
	debug($filename);
      if(isPic($info['2'])){
        $i++;
        if($i==$from) $prev=$entry;
        if($i<=$from) continue;
        if($i==$to+1) $next=$entry;
        if($i>$to) break;
	
	$width=$info['0'];
	$height=$info['1'];
        $size=$width*$height;
        $thumb=$filename;

	$n=1;
	$m=1;
	if($size>4000*4000) {$n=8;$m=3;}
	else if($size>3000*3000) {$n=7;$m=3;}
	else if($size>2000*2000) {$n=6;$m=2;}
	else if($size>1200*1200) {$n=5;$m=2;}
	else if($size>700*700) $n=4;
	else if($size>400*400) $n=2;

        if($n>1) {
          $thumb=$thumbDir."/".$entry;
	  debug($thumb);
          if(!file_exists($thumb)) {
            include_once "thumb.php";
            img2thumb($filename,$thumb,$width/$n,$height/$n,0,0);
          }
        }
	 
	$view=$viewDir."/".$entry;
	  debug($view);
	if(!file_exists($view)){
	  if($m>1){
	    include_once "thumb.php";
	    img2thumb($filename,$view,$width/$m,$height/$m,0,0);
	  }
	  else copy($filename,$view);
	}
	
        $item['id']=$i-1;//count its id in the folder
        $item['href']=$entry;
        $item['src']=$thumb; $item['width']=$info['0'];$item['height']=$info['1'];
        $items[]=$item;
      }
    }
    closedir($handle);

    if(count($items)>0){
    //resolve the links
    $items[0]['prev']=$prev;
    $items[count($items)-1]['next']=$next;
    foreach($items as $i=> $item){
      if($i>0) {
        $items[$i-1]['next']=$items[$i]['href'];
        $items[$i]['prev']=$items[$i-1]['href'];
      }
    }
  }
}
  return $items;
}


$dir=!isset($_REQUEST['dir'])?".":$_REQUEST['dir'];
$from=isset($_GET['m'])?$_GET['m']:0;
$num=isset($_GET['n'])?$_GET['n']:11;
$to=isset($_GET['m'])?$from+$num:99999;
if($from<99999)
	$files=listDir($dir,$from,$to);
// $items=array();
// for ($i=$m; $i < count($files) && $i < $m+12; $i++) { 
// $items[] =$files["$i"];
// }
$result['items'] = $files;
// print_r($result);
echo json_encode($result);
?>
