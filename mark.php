<?php
function httpcopy($url,$dir, $file="", $timeout=60) {
  // $file = empty($file) ? pathinfo($url,PATHINFO_BASENAME) : $file;
  // $dir = pathinfo($file,PATHINFO_DIRNAME);
  $dir="DATASET/".$dir;
  !is_dir($dir) && @mkdir($dir,0755,true);
  $filename=$file;
  $file=$dir."/".$file;
  $url = str_replace(" ","%20",$url);

  if(function_exists('curl_init')) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $temp = curl_exec($ch);
    if(@file_put_contents($file, $temp) && !curl_error($ch)) {
      return $filename;
    } else {
      return false;
    }
  } else {
    $opts = array(
      "http"=>array(
        "method"=>"GET",
        "header"=>"",
        "timeout"=>$timeout)
      );
    $context = stream_context_create($opts);
    if(@copy($url, $file, $context)) {
      //$http_response_header
      return $filename;
    } else {
      return false;
    }
  }
}
/*
 * $url 图片地址
 * $filepath 图片保存地址
 * return 返回下载的图片路径和名称
 */
function getimg($url, $class) {

  if ($url == '') {
    return false;
  }
  $filepath="DATASET/$class/";
  $ext = strrchr($url, '.');

  if ($ext != '.gif' && $ext != '.jpg') {
    return false;
  }

  //判断路经是否存在
  !is_dir($filepath)?mkdir($filepath):null;

  //获得随机的图片名，并加上后辍名
  $filetime = time();
  $filename = date("YmdHis",$filetime).rand(100,999).'.'.substr($url,-3,3);

  //读取图片
  return httpcopy($url,$class,$filename);
  // $img = fetch_urlpage_contents($url);
  // //指定打开的文件
  // $fp = @ fopen($filepath.'/'.$filename, 'a');
  // //写入图片到指定的文本
  // fwrite($fp, $img);
  // fclose($fp);
  // return $filename;
}
?>
