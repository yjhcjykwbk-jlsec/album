<meta charset="utf-8">
<!--<h4 style="display:block;float:left;"><font style="display:block;font-size:60%;position:fixed;font-weight:italic;color:#423;margin-top:-16px;z-index:90;margin-left:0;">推荐您关注</font></h4> -->
<div id="album_menu" style="width:10%;overflow-y:scroll;position:fixed;top:1%;padding-top:20px;opacity:0.7;border:1px solid rgba(0,0,0,0.03);border-radius: 0px 2px 2px 0px;background:rgba(160,250,200,0.0);box-shadow:10px 0px 10px 2px rgba(0,0,0,0.1);float:left;bottom:0;margin-left:0%;margin-right:0;z-index:99;">
<div style="display:block;padding-top:8px;padding-bottom:8px;">
<ul style="list-styles:none" style="">
<?php
include_once "util.php";
if($ENCODE=="utf-8") 
$dirs=getSubDir();
else $dirs=getSubDirGBK();
foreach($dirs as $i=>$dir){
	?>
		<li> <div style="border-radius:0px 5px 5px 0px;padding:3px 12px 20px 16px;float:bottom;font-size:10px;color:#944;font-family:'微软雅黑,宋体';">
		<a  style="display:block;float:bottom;padding-bottom:-15px;"  
		href="index.php?dir=<?php echo $dir;?>" onclick="setDir('<?php echo $dir?>');return false;">
		<img width="80%" height=""src="<?php if(file_exists("DATASET/".$dir."/front.jpg")) echo "DATASET/".$dir."/front.jpg";else echo "default.jpg";?>"
	 	style="padding-top:0px;"/>
		</a>
		<?php echo mb_substr($dir,0,5,$ENCODE).".";?>
		</div></li>
		<?php } ?>
		</ul></div>
		</div>



