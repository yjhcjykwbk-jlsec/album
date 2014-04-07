<?php
function getSubDir(){
  $dirs=array();
  if ($handle = opendir("DATASET")) {
    while (false !== ($entry = readdir($handle))) {
      if(is_dir("DATASET/".$entry)&&$entry!=".."&&$entry!=".thumb") {
        $dirs[]=$entry;
      }
    }
  }
  return $dirs;
}
function getSubDirGBK(){
  $dirs=array();
  if ($handle = opendir("DATASET")) {
    while (false !== ($entry = readdir($handle))) {
      if(is_dir("DATASET/".$entry)&&$entry!=".."&&$entry!=".thumb") {
        $entry=iconv("GBK","UTF-8//IGNORE",$entry);
        $dirs[]=$entry;
      }
    }
  }
  return $dirs;
}

?>
