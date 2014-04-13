<!DOCTYPE HTML>
<!--单入口-->
<?php 
$ENCODE="utf-8";//应该和文件系统保持一致
?>
<html>
<head>
<meta charset="<?php echo $ENCODE;?>">
<title>瀑布流</title>
<link rel="stylesheet" type="text/css" href="css/container.css" />
<link rel="stylesheet" type="text/css" href="css/item.css" />
<link rel="stylesheet" type="text/css" href="css/contextMenu.css" />
<style>
</style>
</head>
<body style="background:url(body_bg) no-repeat center top #245a70">

<script type="text/javascript" src="src/jquery.min.js"></script>
<script type="text/javascript" src="src/jquery.contextmenu.js"></script>
<script type="text/javascript" src="src/jquery.waterfall.js"></script>
<script type="text/javascript" src="src/index.js"></script>

<!-- //header -->
<div style="background: center #f060f0;<!--#E8EDF1;--#303030;-->
display:block;width:100%;height:30px;margin-top:0px;">
<p>
<h1 align="center"><font color="#072" style="font-family:'微软雅黑,宋体';font-size:12px;">信 息 安 全 实 验 室 在 线 影 集</font></h1>
</p>
</div>
<style>
  .folders .li{
	float:middle;
	margin-left:auto;margin-right:auto;margin-top:50px;
    border:17px;padding:5px;border-color:#0f0f0f;padding-color:#202020;
    box-shadow: 0 1px 4px rgba(0,0,0,.15)
}
    .folders .li_border{
    boxshadow: 0 1px 4px rgba(0,0,0,.15)
}
</style>


<div class="folders" style="display:block;width:840px;height:600px;background:#74aac0;margin-left:auto;margin-right:auto;margin-top:205px;border-radius:7px;">
<?php
if ($handle = opendir("DATASET")) {
  while (false !== ($entry = readdir($handle))) {
    if(is_dir("DATASET/".$entry)&&$entry!=".."&&$entry!=".thumb") {?>
      <div class="li" style="display:block;float:left;margin:15px;margin-bottom:0;margin-top:25px;">
        <a href="index.php?dir=<?php echo $entry ?>"><?php echo $entry ?>/<br/>
        <img src="DATASET/<?php echo $entry?>/front.jpg" width="170" height="125" style="">
        </img></a>
        <div class="li_border">..</div>
        </div>
<?php
    }
  }
}
closedir($handle);
?>

</div>

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="600" height="600">
<param name="movie" value="music/huakai.swf">
<param name="quality" value="high">
<param name="wmode" value="transparent">
<embed src="music/huakai.swf" width="1" height="1" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="transparent"></embed>
</object>

  </html>


