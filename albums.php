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
<body style="background:url(DATASET/bg.jpg) repeat-y center top #245a70">

<script type="text/javascript" src="src/jquery.min.js"></script>
<script type="text/javascript" src="src/jquery.contextmenu.js"></script>
<script type="text/javascript" src="src/jquery.waterfall.js"></script>
<script type="text/javascript" src="src/index.js"></script>

<!-- //header -->
<div style="background: center #f060f0;<!--#E8EDF1;--#303030;-->
display:block;width:100%;height:40px;margin-top:0px;
background:url(http://l.bst.126.net/rsc/img/x.png) repeat-x 999px 9999px;
">
<p>
<h1 align="center"><font color="#072" style="font-family:'微软雅黑,宋体';font-size:12px;">信 息 安 全 实 验 室 在 线 影 集</font></h1>
</p>
</div>
<style>
  .folders .li{
 display:block; margin-left:auto;margin-right:auto;margin-top:50px;
    box-shadow: 0 1px 4px rgba(0,0,0,.15)
}
    .folders .li_border{
    boxshadow: 0 1px 4px rgba(0,0,0,.15)
}
</style>


<div class="folders" style="display:block;width:540px;height:;background:#222;margin-left:auto;margin-right:auto;margin-top:115px;padding-bottom:20px;border-radius:0px;border:3px solid #333">
<?php
if ($handle = opendir("DATASET/$user")) {
  while (false !== ($entry = readdir($handle))) {
    if(is_dir("DATASET/$user/".$entry)&&$entry!=".."&&$entry!=".thumb") {?>
      <div class="li" style="display:block;margin-left:3%;width:94%;margin-right:auto;margin-top:25px;">
        <a href="index.php?dir=<?php echo $entry ?>">
        <?php $front=file_exists("DATASET/$user/".$entry."/front.jpg")?"DATASET/$user/".$entry."/front.jpg":"default.jpg";?>
        <img src="<?php echo $front;?>" width="100%" style="margin:auto auto;overflow:hidden">
        </img><br/>
        <?php echo $entry ?>/
        </a>
        </div>
<?php
    }
  }
}
closedir($handle);
?>


<div style="clear:both;"></div>
</div>

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="0" height="0">
<param name="movie" value="music/huakai.swf">
<param name="quality" value="high">
<param name="wmode" value="transparent">
<embed src="music/huakai.swf" width="1" height="1" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="transparent"></embed>
</object>

  </html>


