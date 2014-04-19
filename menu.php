<meta charset="utf-8">
<h4 style="display:block;float:left;"><font style="display:block;font-size:90%;position:fixed;font-weight:italic;color:#423;margin-top:-6px;z-index:90;margin-left:5px;">推荐您关注</font></h4>
<div style="max-height:90%;overflow-y:scroll;position:fixed;padding-right:5px;border:1px solid rgba(0,0,0,0.03);
border-radius: 0px 2px 2px 0px;background:rgba(255,255,255,0.9);float:left;margin-top:0.6%;margin-left:0.1%;margin-right:0;z-index:99;">
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
		<img width="50px" height="40px"src="<?php if(file_exists("DATASET/".$dir."/front.jpg")) echo "DATASET/".$dir."/front.jpg";else echo "default.jpg";?>"
	 	style="padding-top:0px;"/>
		</a>
		<?php echo mb_substr($dir,0,5,$ENCODE).".";?>
		</div></li>
		<?php } ?>
		</ul></div>
		</div>



