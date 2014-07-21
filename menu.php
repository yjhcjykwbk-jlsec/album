<!-- refered container_div -->
<meta charset="utf-8">
<!--<h4 style="display:none;float:left;"><font style="display:block;font-size:60%;position:fixed;font-weight:italic;color:#423;margin-top:-16px;margin-left:0;">推荐您关注</font></h4> -->
<div id="album_menu" style="opacity:0.5;display:block;width:8.5%;overflow-y:scroll;position:fixed;padding-top:20px;top:0;border:1px solid rgba(120,120,120,0.3);border-radius: 0px 2px 2px 0px;background:transparent;box-shadow:0px 0px 0px 0px rgba(0,0,0,0.2);bottom:0;left:0;margin-right:0;z-index:10;">
<div style="display:block;padding-top:8px;padding-bottom:8px;">
<ul style="list-styles:none" style="">
<?php
include_once "util.php";
if($ENCODE=="utf-8") 
  $dirs=getSubDir($user);
else $dirs=getSubDirGBK($user);
foreach($dirs as $i=>$dir){
?>
    <li> <div style="border-radius:0px 5px 5px 0px;padding:3px 12px 0px 16px;float:bottom;font-size:10px;color:#944;font-family:'微软雅黑,宋体';">
    <a  style="display:block;float:bottom;padding-bottom:-15px;"  
    href="index.php?dir=<?php echo $dir;?>" onclick="setDir('<?php echo $dir?>');return false;">
    <img width="50%" height="30px" src="<?php if(file_exists("DATASET/$user/".$dir."/front.jpg")) echo "DATASET/$user/".$dir."/front.jpg";else echo "default.jpg";?>"
    style="padding-top:0px;"/>
    </a>
    <?php echo mb_substr($dir,0,5,$ENCODE).".";?>
    </div></li>
    <?php } ?>
    </ul></div>
    </div>

  <script> 
  </script>

