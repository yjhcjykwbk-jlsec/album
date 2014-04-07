<!DOCTYPE HTML>
<!--单入口-->
<?php 
$ENCODE="utf-8";//应该和文件系统保持一致
$curDir=isset($_REQUEST['dir'])?$_REQUEST['dir']:".";
?>
<html>
<head>
<meta charset="<?php echo $ENCODE;?>">
<title>实验室相集</title>
<link rel="stylesheet" type="text/css" href="css/container.css" />
<link rel="stylesheet" type="text/css" href="css/item.css" />
<link rel="stylesheet" type="text/css" href="css/contextMenu.css" />
</head>
<body>

<script type="text/javascript" src="src/jquery.min.js"></script>
<script type="text/javascript" src="src/jquery.contextmenu.js"></script>
<script type="text/javascript" src="src/jquery.waterfall.js"></script>
<script type="text/javascript" src="index.js"></script>


<!-- //header -->
<div style="background: center #f0e0f0;<!--#E8EDF1;--#303030;-->
display:block;width:100%;height:20px;margin-top:0px;z-index:100;position:fixed;">
<p>
<select style="float:right;opacity:0.2;margin-top:0px;" align="left" id="selects" onclick="">
<option value="3">每页三列</option>
<option value="4">每页四列</option>
<option value="5">每页五列</option>
<option value="6">每页六列</option>
<option value="7">每页七列</option>
</select>
<select onclick="setEmbed(this.selectedIndex);"style="float:right;opacity:0.2">
<option value="0">请选择背景音乐</option>
<option value="1">英雄的黎明</option>
<option value="2">回梦游仙</option>
<option value="3">你那么美</option>
<option value="4">御剑江湖</option>
<option value="5">雨的印记</option>
<option value="6">天地孤影任我行</option>
<option value="7">乱红</option>
<option value="8">tears</option>
<option value="9">bustling-time</option>
<option value="10">with-memories</option>
<option value="11">醉瑶瑟</option>
<option value="12">琵琶语</option>
<option value="13">泡沫</option>
<option value="100">关闭音乐</option>
</select>
<div align="center"><font color="white" style="font-family:'微软雅黑,宋体';font-size:8px;">信息安全实验室影集   请使用<font color="yellow"> google浏览器</font>查看</font>  <a href="albums.php" style="font-size:110%;font-weight:bold;color:#8af;text-decoration:underline;">相册首页从此进入</a></div>
<script>
var lastSong=0;
var setEmbed=function(i){
  if(i==0||i==lastSong) return;
 lastSong=i;
  music_div.innerHTML='<embed src="music/'+i+'.mp3" align="center" border="0" width="1" height="1" autostart="true" loop="true"> </embed>';
}
</script>
<div id="music_div" style=""><embed src="music/5.mp3" align="center" border="0" width="1" height="1" width="100" autostart="true" loop="true"> </embed></div>
</p>
</div>

<div id="xxx" style="display:block;height:20px;"></div>


<?php include "photo.php";?>
<script>
var curDir="<?php echo $curDir;?>";
var togglePhotoView=function(id){
	if(id>=0&&dirInited){
		photo_view.style.display="block";
		loadImg(id);
	}else{
		photo_view.style.display="none";
	}
}
</script>


<!-- left-panel -->
<h4 style="display:block;float:left;"><font style="display:block;position:fixed;font-weight:normal;color:white;margin-top:-15px;z-index:101;margin-left:10px;">推荐您关注</font></h4>
<div style="background:#f0f0f0;max-height:750px;overflow-y:scroll;position:fixed;float:left;margin-top:0px;margin-left:0px;margin-right:0;z-index:99;">
<div style="display:block;padding-top:8px;padding-bottom:20px;border:1px solid #f0f0f0;">
<ul style="list-styles:none" style="">
<?php
include_once "util.php";
if($ENCODE=="utf-8") 
$dirs=getSubDir();
else $dirs=getSubDirGBK();
foreach($dirs as $i=>$dir){
	?>
<li> <div style="padding:3px 15px 23px 12px;float:bottom;font-size:10px;color:#944;font-family:'微软雅黑,宋体';">
	     <a  style="display:block;float:bottom;padding-bottom:-15px;"  
		href="index.php?dir=<?php echo $dir;?>" onclick="setDir('<?php echo $dir?>');return false;">
		<img width="60px" height="50px"src="DATASET/<?php echo $dir;?>/front.jpg" style="padding-top:0px;"/>
	     </a>
	<?php echo mb_substr($dir,0,5,$ENCODE);?>
	</div></li>
	<?php } ?>
	</ul></div>
</div>




<iframe src="uploadview.php?dir=<?php echo $curDir;?>" style="z-index:0;position:fixed;bottom:10px;right:10px;width:220px;box-shadow: 2px 2px 3px 2px rgba(0,0,0,0.3);font-size: 14px;background-color:rgb(222,222,222,0.1);opacity:0.1;border:0;padding:5px;border-radius:1px; line-height: 1;"></iframe> 





<div style="position:relative;margin-left:100px;margin-top:20px;">
	<div id="container" class="container" style="">
		</div>

	<div id="end" style="display:none; opacity:0.2; font:20px bold; margin:0 auto; text-align:center;">意见收集栏目<br/>
	<hr>
        <input type="text" id="advise" value="输入建议"/>
	<button type="submit" id="submit_advise" onclick="submitAdvise();">提交</button>
	<h6>or email to author xzg</h6>
	<h6> zgxu2008@gmail.com </h6>
	</div>

	<script>
	function submitAdvise(){
		alert("您的意见已经被收录，谢谢您的支持");
		return;
	}
	</script>

	<script type="text/javascript">
	var dir=<?php echo "\"".$curDir."\"";?>;
	var waterfall=new MyWaterfall(dir,4);
	initDir();
	var setDir=function(dir){
		curDir=dir;
		if(waterfall!=undefined&&waterfall!=null) 
			waterfall.clear();
		waterfall=new MyWaterfall(dir,4);
		initDir();
	};
	selects.onclick=function(){
	waterfall.refresh(3+this.selectedIndex);
}
</script>
</div>

<!-- 下面是右键菜单1 -->
<div class="contextMenu" id="menu"> 
<ul> 
<li id="del">删除</li><ul> 
</div> 

<!-- <iframe src="uploadpage.html" -->
<!-- style="position:fixed;top:200px;right:20px;width:300px;height:200px;box-shadow: 2px 2px 3px 2px rgba(0,0,0,0.3); -->
<!-- font-size: 14px;background-color:rgb(222,222,222,0.1);opacity:0.6;border:0;padding:10px;border-radius:2px; -->
<!-- line-height: 1;"> -->
<!-- </iframe> -->


<br/><br/><br/> <br/><br/><br/> <br/><br/><br/> <br/><br/><br/> <br/><br/><br/>
<br/><br/><br/> <br/><br/><br/> <br/><br/><br/> <br/><br/><br/> <br/><br/><br/>
<br/><br/><br/> <br/><br/><br/> <br/><br/><br/> <br/><br/><br/> <br/><br/><br/>

</body>
</html>
