<?php
function getSubDir($user){
  $dirs=array();
  if ($handle = opendir("DATASET/$user/")) {
    while (false !== ($entry = readdir($handle))) {
      if(is_dir("DATASET/$user/".$entry)&&$entry!=".."&&$entry!=".thumb") {
        $dirs[]=$entry;
      }
    }
  }
  return $dirs;
}
function getSubDirGBK($user){
  $dirs=array();
  if ($handle = opendir("DATASET/$user/")) {
    while (false !== ($entry = readdir($handle))) {
      if(is_dir("DATASET/$user/".$entry)&&$entry!=".."&&$entry!=".thumb") {
        $entry=iconv("GBK","UTF-8//IGNORE",$entry);
        $dirs[]=$entry;
      }
    }
  }
  return $dirs;
}

?>
