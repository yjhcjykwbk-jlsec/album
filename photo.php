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
<div id="photo_view" style="display:none;overflow-x:hidden;overflow-y:overlay;min-height:100%;background:#fefdff;;z-index:100;position:absolute;padding-bottom:5px;margin-left:7%;margin-right:auto;margin-bottom:15px;">
<style>
.fButton:hover{ color:red; }
#comment_span{color:white;} body{ margin:0px;margin-top:0px; } #author{ width:20px;font-weight:bold; color:#369;}
</style>
<!--header-->
<!--a href="index.php?dir=<?php echo $dir;?>">
<div style="background:#f060f0;display:block;width:100%;height:20px;display:block;font-size:10px;margin:auto auto;border:0px solid #505050;"> <font style="color:red;">返回相册 <?php echo $dir;?></font></div></a-->
<div id="left_panel" style="float:right;width:85%;height:100%;border-right:1px solid #eee;background:transparent;margin-left:auto;margin-top:0;margin-right:auto;display:block;">
<div id="img_panel" style="width:99%;margin-bottom:10px;border:1px solid rgba(120,120,120,0.3)">
<div id="top_buttons" style="z-index:100;top:0px;right:0;position:relative;">
<a id="oImg" target="__blank" style="display:block;width:60px;height:10px;margin-top:2px;float:right;position:;background:rgba(100,100,100,0.1);color:rgba(150,150,150,0.4);border:0px;font-family: '微软雅黑,宋体';font-size:11px;">查看原图</a>
<button id="toggle_com" onclick="toggleCom();" style="width:60px;height:15px;margin-top:0;float:right;position:;background:rgba(100,100,100,0.1);color:rgba(150,150,150,0.4);border:0px;font-family: '微软雅黑,宋体';font-size:11px;">切换大屏</button>
<button id="auto_play" onclick="toggleAutoPlay();" style="width:60px;height:15px;margin-top:0;float:right;position:;background:rgba(100,100,100,0.1);color:rgba(150,150,150,0.4);border:0px;font-family: '微软雅黑,宋体';font-size:11px;">自动播放</button>
<button id="refresh_btn" onclick="togglePhlst();" style="width:60px;height:15px;margin-top:0;float:right;position:;background:rgba(100,100,100,0.1);color:rgba(150,150,150,0.4);border:0px;font-family: '微软雅黑,宋体';font-size:11px;">导航</button>
<button id="toggle_view" onclick="togglePhotoView(-1);" style="width:60px;height:15px;margin-top:0;float:right;position:;background:rgba(100,100,100,0.1);color:rgba(150,150,150,0.4);border:0px;font-family: '微软雅黑,宋体';font-size:11px;">返回页面</button>
</div>
<table id="img_table" width="100%" height="100%" align="center" valign="middle" style="
background: url(imgbg) 0 0 repeat;
border-width:10px 20px 20px 20px;
border-color:rgba(255,255,255,0.3);
border-style:solid;
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
<div id="comments_div" style="width:94%;margin-left:4%;border-bottom:0px solid #888;max-width:100%;overflow-y:scroll;overflow-x:hidden;border-top:1px solid f0fefu;margin-top:20px;margin-bottom:10px;
background:transparent;min-height:0px;border-radius:0px;border-right:0px solid #508090;color:#eee;"></div>
<div style="margin-left:3%;width:95%;margin-top:0%:height:1px;padding-bottom:50px;border:0px solid #301030;border-radius:4px;">
  <textarea id="comment_area" style="font-size:100%;margin-top:2%;width:99%;height:55px;border:0px;" onclick="" placeholder="评论" class="clear-input"></textarea>
<br/>
  <textarea id="comment_author" style="font-size:100%;width:99%;margin-top:2px;height:15px;float:left;border:0px;" onclick="this.value='';" placeholder="昵称" class="clear-input" autocomplete="off"></textarea>
  <button value＝"清空" style="width:30px;float:right;background:rgba(120,120,120,0.2);color:rgba(120,120,120,0.4);border:0px;" onclick="clearCom();">清空</button><!--<button value="清空" onclick="clearCom();" >清空</button> -->
  <button value＝"提交" style="width:30px;float:right;background:rgba(120,120,120,0.2);color:rgba(120,120,120,0.4);border:0px;" onclick="addCom(comment_area.value+'%'+comment_author.value);">评论</button><!--<button value="清空" onclick="clearCom();" >清空</button> --> 
</div>
</div>
</div>


<div id="right_panel" style="float:right;margin-right:2.2%;width:25%;display:block;border:1px solid rgba(120,120,120,0.3);border-radius:0px;overflow-y:hidden;overflow-x:hidden;position:;z-index:10;">
<div style="border-bottom:0px solid #bab;color:#111;margin:4% 1% 10px 1%;display:block;">
<a target="__blank" id="img_desp" href=''style="display:block;margin:10px;"></a>
</div>
<div id="right_lst" style="height:100%;overflow-y:overlay;margin:10px;"></div>
</div>
</div> <!--photoView-->
</div>

<script>
//调整图片框的大小
img_panel.style.minHeight=""+screen.availHeight*0.55+"px";
right_panel.style.height=""+screen.availHeight*0.75+"px";
img_table.style.minHeight=""+screen.availHeight*0.5+"px";
var rightLstFlag="";
function loadRightLst(){
  if(curDir==rightLstFlag) return;
  rightLstFlag=curDir;
  var img_div=$("#right_lst");
  img_div.empty();
  if(items==undefined) return;
  for(i=0;i<items.length;i++){
    var img=$('<div style="min-height:3%;max-height:20%;max-width:25%;overflow-x:;float:left;border:2px solid rgba(200,100,120,0.3);padding:3px;"><img alt="" style="height:100%;" src="" onclick="s=this.alt;loadImg(s);"></img></div>');
    img_div.append(img);
  }
  var imgs=$('#right_lst img');
  for(i=0;i<=items.length;i++){
    var img=imgs[i];
    if(img==undefined||img==null) {
      continue;
    }
    img.setAttribute("alt",i);
    // img.style.display="block";
    var item=items[i];
    img.setAttribute("src",item.src);
  }
}
var old=-1;
function updateRightLst(id){
  loadRightLst();
  var imgs=$('#right_lst img');
  if(imgs[old]!=undefined) imgs[old].style.border="0";
  if(imgs[id]!=undefined) {
    imgs[id].style.border="1px solid red";
    right_lst.scrollTop=imgs[id].offsetTop-150;
  }
  old=id;
}
</script>

<?php if(isset($_REQUEST['id'])){?>
<script> 
// curDir='<?php echo $curDir;?>';
// setDir('<?php echo $curDir;?>');
// photo_view.style.display="block";
</script>
<?php }?>
