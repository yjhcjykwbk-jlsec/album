<meta charset="utf-8">
<h4 style="display:block;float:left;"><font style="display:block;position:fixed;font-weight:normal;color:white;margin-top:-25px;z-index:90;margin-left:10px;">推荐您关注</font></h4>
<div style="max-height:85%;overflow-y:scroll;position:fixed;border-radius: 0px 20px 20px 0px;background:#d9d0e0;float:left;margin-top:2px;margin-left:-1px;margin-right:0;z-index:99;">
<div style="display:block;padding-top:8px;padding-bottom:20px;border:1px solid #f0f0f0;">
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
		<img width="60px" height="50px"src="DATASET/<?php echo $dir;?>/front.jpg" style="padding-top:0px;"/>
		</a>
		<?php echo mb_substr($dir,0,5,$ENCODE).".";?>
		</div></li>
		<?php } ?>
		</ul></div>
		</div>


