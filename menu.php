<meta charset="utf-8">
<h4 style="display:block;float:left;"><font style="display:block;position:fixed;font-weight:normal;color:white;margin-top:-15px;z-index:90;margin-left:10px;">推荐您关注</font></h4>
<div style="max-height:85%;height:85%;overflow-y:scroll;position:fixed;border:1px solid rgba(255,255,255,0.4);border-radius: 0px 0px 0px 0px;background:transparent;float:left;margin-top:13px;margin-left:-1px;margin-right:0;z-index:99;">
<div style="display:block;padding-top:8px;padding-bottom:20px;">
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
		<img width="60px" height="50px"src="<?php if(file_exists("DATASET/".$dir."/front.jpg")) echo "DATASET/".$dir."/front.jpg";else echo "default.jpg";?>"
	 	style="padding-top:0px;"/>
		</a>
		<?php echo mb_substr($dir,0,5,$ENCODE).".";?>
		</div></li>
		<?php } ?>
		</ul></div>
		</div>



