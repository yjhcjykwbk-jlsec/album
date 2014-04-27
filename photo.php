<?php
//if(!isset($_REQUEST['img'])||!isset($_REQUEST['dir'])) return;
$img=isset($_REQUEST['img'])?$_REQUEST['img']:"front.jpg";
$curDir=isset($curDir)?$curDir:$_REQUEST['dir'];
$id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
//$dir=$curDir;
//$img="front.jpg";
//$id=0;
?>
<meta charset="utf-8">
<script src="src/jquery.min.js"></script>
<script src="src/photo.js"></script>
<script src="src/dubai.js"></script>
<div id="chengxuyuan" style="display:none;width:180px;bottom:46%;right:46%;border-radius:1px;padding:20px;box-shadow:5px 10px 10px 2px #222;z-index:1;position:fixed;opacity:0.9;background:#eee;">
<img src="yuan.gif" width="100%" style="margin-left:auto;margin-right:auto" onclick="dubaijun();return false;"/><br/>
<div id="yuanIntro" style="margin-left:5px">
程序猿来了！大家快跑！
</div>
<a onclick="chengxuyuanGoDie();return false;">让程序猿去死</a>
</div>
<div id="message" onclick="endFun();" style="right:120px;bottom:90px;border-radius:20px;padding:20px;width:300px;box-shadow:6px 6px 10px 2px #312;z-index:101;position:fixed;opacity:0.9;background:#eee;color:#333;display:none;">
<div id="message_content"></div>
<pre id="message_pre_content" style="font-size:13px;font-weight:bold;"></pre>
</div>
<div class="fButtons" id="fbuttons" style="position:fixed;opacity:0.7;right:0;color:#212;top:12%;width:25px;border:0px solid #eee;background:#ddd;z-index:103;border-radius:0px">
<button class="fButton" id="prev" onclick="prevFun();" 		style="border:1px solid #eee;background:#ddd;width:100%;height:40px;">上张</button>
<button class="fButton" id="next" onclick="nextFun();" 		style="border:1px solid #eee;background:#ddd;width:100%;height:40px; ">下张</button>
<button class="fButton" id="bigger" onclick="biggerFun();" 	style="border:1px solid #eee;background:#ddd;width:100%;height:40px; ">放大</button>
<button class="fButton" id="smaller" onclick="smallerFun();" 	style="border:1px solid #eee;background:#ddd;width:100%;height:40px; ">缩小</button>
<button class="fButton" id="darker" onclick="darkerFun(1);" 	style="border:1px solid #eee;background:#ddd;width:100%;height:40px;font-size:70%; ">灯光</button>
<button class="fButton" id="menus" onclick="toggleMenus();" 	style="border:1px solid #eee;background:#ddd;width:100%;height:40px;font-size:70%; ">nav</button>
<button class="fButton" id="zoomer" style="border:1px solid #eee;background:#ddd;width:100%;height:40px; ">zoom</button>
</div>
<div id="photo_view" style="display:none;overflow-x:hidden;overflow-y:overlay;min-height:100%;background:#fefdff;;z-index:100;position:absolute;padding-bottom:5px;margin-left:7%;margin-right:auto;margin-bottom:15px;">
<style>
.fButton:hover{ color:red; }
#comment_span{color:white;} body{ margin:0px;margin-top:0px; } #author{ width:20px;font-weight:bold; color:#369;}
</style>
<!--header-->
<!--a href="index.php?dir=<?php echo $dir;?>">
<div style="background:#f060f0;display:block;width:100%;height:20px;display:block;font-size:10px;margin:auto auto;border:0px solid #505050;"> <font style="color:red;">返回相册 <?php echo $dir;?></font></div></a-->
<div id="left_panel" style="float:left;width:79%;height:100%;border-right:1px solid #eee;background:transparent;margin-left:auto;margin-top:0;margin-right:auto;display:block;">
<div id="img_panel" style="width:99%;margin-bottom:10px;border:1px solid rgba(120,120,120,0.3)">
<div style="background:white;z-index:100;margin-top:0%;position:relative;">
<button id="oImg" target="__blank" style="width:60px;height:20px;margin-top:0;margin-left:;position:;background:rgba(50,50,50,0.05);border:0px;font-family: '微软雅黑,宋体';font-size:11px;">查看原图</button>
<button id="toggle_com" onclick="toggleCom();" style="width:60px;height:20px;margin-top:0;margin-left:;position:;background:rgba(50,50,50,0.05);border:0px;font-family: '微软雅黑,宋体';font-size:11px;">切换大屏</button>
<button id="auto_play" onclick="toggleAutoPlay();" style="width:60px;height:20px;margin-top:0;margin-left:;position:;background:rgba(50,50,50,0.05);border:0px;font-family: '微软雅黑,宋体';font-size:11px;">自动播放</button>
<button id="refresh_btn" onclick="togglePhlst();" style="width:60px;height:20px;margin-top:0;margin-left:;position:;background:rgba(50,50,50,0.05);border:0px;font-family: '微软雅黑,宋体';font-size:11px;">导航</button>
<button id="toggle_view" onclick="togglePhotoView(-1);" style="width:60px;height:20px;margin-top:0;margin-left:;position:;background:rgba(50,50,50,0.05);border:0px;font-family: '微软雅黑,宋体';font-size:11px;">返回页面</button>
</div>
<table id="img_table" width="100%" height="100%" align="center" valign="middle" style="
border: 20px solid white;
background: url(imgbg) 0 0 repeat;
border-top: 5px solid white;
border-bottom: 20px solid white;
<!--border-bottom:1px dotted rgba(128,128,128,0.4)-->
"><tr><td>
<a onclick="togglePhotoView(0-1);return false;" title="" style="">
<div id="movie_div" style="width:95%;height:100%;margin-left:auto;margin-right:auto;">
<?php include_once "movie.php";?>
</div>
<div id="img_div" style="width:;border-top:0px solid transparent;border-bottom:15px solid transparent;margin-left:auto;margin-right:auto;">
<img id="img" src="<?php echo "view/".$curDir."/$img"?>" alt="1" style="width:100%;border:0px solid rgba(128,128,128,0.4);display:block;margin-left:auto;margin-right:auto;vertical-align:middle;"/>
</div>
</a>
</td></tr></table>
</div>
<div id="comments_panel" style="width:99%;margin-top:5px;border:1px solid rgba(128,128,128,0.2);">
<div id="comments_div" style="width:94%;margin-left:4%;border-bottom:0px solid #888;max-width:100%;overflow-y:scroll;overflow-x:hidden;border-top:1px solid f0fefu;
background:transparent;min-height:0px;border-radius:0px;border-right:0px solid #508090;color:#eee;"></div>
<div style="margin-left:3%;width:95%;margin-top:0%:height:1px;padding-bottom:50px;border:0px solid #301030;border-radius:4px;">
  <textarea id="comment_area" style="font-size:100%;margin-top:2%;width:99%;height:125px;border:0px;" onclick="" placeholder="评论" class="clear-input"></textarea>
<br/>
  <textarea id="comment_author" style="font-size:100%;width:99%;margin-top:2px;height:15px;float:left;border:0px;" onclick="this.value='';" placeholder="昵称" class="clear-input" autocomplete="off"></textarea>
  <button value＝"清空" style="width:30px;float:right;background:rgba(120,120,120,0.2);color:rgba(120,120,120,0.4);border:0px;" onclick="clearCom();">清空</button><!--<button value="清空" onclick="clearCom();" >清空</button> -->
  <button value＝"提交" style="width:30px;float:right;background:rgba(120,120,120,0.2);color:rgba(120,120,120,0.4);border:0px;" onclick="addCom(comment_area.value+'%'+comment_author.value);">评论</button><!--<button value="清空" onclick="clearCom();" >清空</button> --> 
</div>
</div>
</div>


<div id="right_panel" style="width:18%;display:block;border:0px dotted #fbfbfb;border-radius:0px;overflow-y:hidden;overflow-x:hidden;position:;margin-top:5px;z-index:10;">
<div style="border-bottom:0px solid #bab;color:#111;margin:4% 1% 10px 1%;display:block;">
<a target="__blank" id="img_desp" href=''></a>
</div>
</div>
</div> <!--photoView-->
</div>

<?php include "photolst.php";?>
<script>
//调整图片框的大小
img_panel.style.minHeight=""+screen.availHeight*0.75+"px";
img_table.style.minHeight=""+screen.availHeight*0.7+"px";
</script>

<?php if(isset($_REQUEST['id'])){?>
<script> 
curDir='<?php echo $curDir;?>';
initDir('<?php echo $curDir;?>');
photo_view.style.display="block";
</script>
<?php }?>
