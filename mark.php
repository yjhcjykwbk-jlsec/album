<?php
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
  $img = fetch_urlpage_contents($url);
  //指定打开的文件
  $fp = @ fopen($filepath.'/'.$filename, 'a');
  //写入图片到指定的文本
  fwrite($fp, $img);
  fclose($fp);
  return '/'.$filepath.'/'.$filename;
}
?>
