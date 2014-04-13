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
<div id="photo_view" style="display:none;overflow-x:hidden;overflow-y:overlay;box-shadow:100px 10px 160px 145px #a5a0b0;background:#f8f8f8;border:7px solid #fff;padding-left:0px;padding-right:0px;z-index:100;position:fixed;height:87%;width:88%;margin-left:9%;margin-right:auto;margin-top:0px;border-radius:60px 0px 0px 0px;">

<div class="fButtons" id="fbuttons" style="height:200px;position:fixed;opacity:0.3;color:#212;right:21.05%;margin-top:16%;width:40px;border:0px solid #eee;background:#ddd;z-index:99;border-radius:0px">
<button class="fButton" id="prev" onclick="prevFun();" 		style="border:1px solid #eee;background:#ddd;width:100%;height:20%;">上张</button>
<button class="fButton" id="next" onclick="nextFun();" 		style="border:1px solid #eee;background:#ddd;width:100%;height:20%; ">下张</button>
<button class="fButton" id="bigger" onclick="biggerFun();" 	style="border:1px solid #eee;background:#ddd;width:100%;height:20%; ">放大</button>
<button class="fButton" id="smaller" onclick="smallerFun();" 	style="border:1px solid #eee;background:#ddd;width:100%;height:20%; ">缩小</button>
<button class="fButton" id="darker" onclick="darkerFun();" 	style="border:1px solid #eee;background:#ddd;width:100%;height:20%; ">灯光</button>
</div>

<style>
.fButton:hover{ color:red; }
#comment_span{color:white;} body{background:#f4f0f9; margin:0px;margin-top:0px; } #author{ width:20px;font-weight:bold; color:#369;}
</style>
<script type="text/javascript">
var comEnabled=true;
var biggerFun=function(){
	cur=img.style.zoom;
	if(cur=="") cur=1;
	else {
		cur=parseFloat(cur);
	}
	if(cur>3) return; 
	if(cur>1.5) cur+=2;
	else cur+=1;
	img.style.zoom=cur+"";
};
var darkFlag=false;
var darkerFun=function(){
	if(!darkFlag){
		body.style.backgroundColor="#141019";
		//photo_view.style.backgroundColor="#080808";
		photo_view.style.backgroundColor="rgba(8,8,8,1)";
		photo_view.style.border="7px solid #0e0e0e";
		photo_view.style.boxShadow="100px 10px 160px 245px #353040";
		next.style.color= prev.style.color= darker.style.color= bigger.style.color= smaller.style.color="#ccc";
		next.style.backgroundColor= prev.style.backgroundColor= darker.style.backgroundColor= bigger.style.backgroundColor= smaller.style.backgroundColor="#333";
		next.style.border= prev.style.border= darker.style.border= bigger.style.border= smaller.style.border="1px solid #222";
		left_panel.style.borderRight="1px solid #111";
		right_panel.style.opacity="0.1";
		darkFlag=true;
	}else{
		body.style.backgroundColor="#f4f0f9";
		//photo_view.style.backgroundColor="#f8f8f8";
		photo_view.style.backgroundColor="rgba(248,248,248,0.98)";
		photo_view.style.border="7px solid #eee";
		photo_view.style.boxShadow="100px 10px 160px 145px #252030";
		fbuttons.style.color="#212";
		next.style.color= prev.style.color= darker.style.color= bigger.style.color= smaller.style.color="#212";
		next.style.backgroundColor= prev.style.backgroundColor= darker.style.backgroundColor= bigger.style.backgroundColor= smaller.style.backgroundColor="#ddd";
		next.style.border= prev.style.border= darker.style.border= bigger.style.border= smaller.style.border="1px solid #eee";
		left_panel.style.borderRight="1px solid #eee";
		right_panel.style.opacity="1";
		darkFlag=false;
	}
};
var smallerFun=function(){
	cur=img.style.zoom;
	if(cur=="") img.style.zoom="0.5";
	else {
		cur=parseFloat(cur);
		if(cur<=0.5) return;
		if(cur>=4) cur-=2;
		else if(cur>=2) cur-=1;
		else if(cur>1) cur-=0.5;
		else cur-=0.25;
		img.style.zoom=cur+"";
	}
};
var toggleCom=function(){
	if(right_panel.style.display=="none"){
		comEnabled=true;
		if(img.alt!=comID) getCom();
		left_panel.style.width="79%";
		right_panel.style.display="block";//width="20%";
		photo_view.style.height="85%";
		photo_view.style.marginTop="0px";
		right_panel.style.display="block";
		fbuttons.style.opacity="0.5";
		fbuttons.style.width="30px";
		fbuttons.style.right="21.05%";
		img.style.minWidth="70%";
		toggle_com.innerHTML="关闭吐槽";
	}else{
		comEnabled=false;
		left_panel.style.width="100%";
		right_panel.style.display="none";//width="20%";
		photo_view.style.height="97%";
		photo_view.style.marginTop="-38px";
		right_panel.style.display="none";
		fbuttons.style.right="3.40%";
		fbuttons.style.opacity="0.7";
		fbuttons.style.width="40px";
		img.style.minWidth="30%";
	 	toggle_com.innerHTML="开启吐槽";
	}
};
var allItems={};
var items;
var dirInited=false;
var initDir=function(){
	if(allItems[curDir]!=null) {
		items=allItems[curDir];
		dirInited=true;
		return;
	}
	dirInited=false;
	items=null;
	$.get('more.php?dir='+curDir,
			function(data){
			//console.log(data.items);
			allItems[curDir]=items=data.items;
			dirInited=true;
			},'json');
};
var loadImg=function(id){
	img.alt=id;
	item=items[img.alt];
	img.src="view/"+curDir+"/"+item.href;
	oImg.href="DATASET/"+curDir+"/"+item.href;

	//since get comment must be called when comEnabled and img.alt changed
	if(comEnabled) getCom();
};
function prevFun(){
	if(img.alt==0) {
		//alert("已经到达第一张图片，将从末尾开始");
		img.alt=items.length-1;
	}
	else img.alt=img.alt-1;
	loadImg(img.alt);

};
var nextFun=function(){
	if(img.alt==items.length-1) {
		//alert("已经到达最后一张图片,将从第一张重新开始");
		img.alt=0;
	}
	else img.alt=img.alt-(-1);
	loadImg(img.alt);

};
/* *  *string:原始字符串 *substr:子字符串  *isIgnoreCase:忽略大小写  */ 
function contains(string,substr){
  var startChar=substr.substring(0,1); 
  var strLen=substr.length; 
  for(var j=0;j<string.length-strLen+1;j++) { 
    if(string.charAt(j)==startChar)//如果匹配起始字符,开始查找  
    {  if(string.substring(j,j+strLen)==substr)//如果从j开始的字符与str匹配，那ok 
    {  return true; }    } }  return false; 
}
var addCom=function(com){
  if(contains(com,"\'")||contains(com,"$")) {
    alert("含有不合法字符\'%或$");
    return;
  }
  $.post("com_js.php",{"dir":curDir,"img":items[img.alt].href,"com":com,"act":"set"},
    function(data){
    },"text");
  getCom();
};
var comID;
var getCom=function(){
  $.post("com_js.php",{"dir":curDir,"img":items[img.alt].href,"act":"get"},
    function(data){
     //console.log("get Comment:");
     //console.log(data);
      comID=img.alt;
      comments=data.split('$');
      comments_div.innerHTML="";
      for(i=0;i<comments.length;i++){
        comment=comments[i].trim();
        if(comment=="") continue;
	author=comment.split('%')[1];	
	content=comment.split('%')[0];	
	if(author==undefined||author=="") author="路人甲";
        comments_div.innerHTML+='<div id="comment_span" style="border:0px solid #fff;display:block;float:left;border-bottom:1px solid #eee;padding-top:2px;width:99%;font-size:80%;background:transparent;">'+'<span id="author">'+author+':   </span><span style="font-size:110%;color:#888;text-decoration:none;">'+content+'</span><a onclick="delCom(\''+comment+'\')" style="display:block;float:right;background:#202020;border:1px solid #333;font-size:70%;margin-top:-1px;"> 删除</a></div>';
      }
    },"text");
};
var delCom=function(com){
	if(!confirm("您真的要删除评论'"+com+"'吗")) return;
  $.post("com_js.php",{"dir":curDir,"img":items[img.alt].href,"del":com},
    function(data){
      //console.log(data);
      getCom();
    },"text");
};
var clearCom=function(){ 
  if(!confirm("您真的要删除所有人的评论吗？")) return;
  $.post("com_js.php",{"dir":curDir,"img":items[img.alt].href,"act":"clear"},
    function(data){
    },"text");
  getCom();
}
//the first time to this page will getcomment initially
//init(getCom);
</script>
<!--header-->
<!--a href="index.php?dir=<?php echo $dir;?>">
<div style="background:#f060f0;display:block;width:100%;height:20px;display:block;font-size:10px;margin:auto auto;border:0px solid #505050;"> <font style="color:red;">返回相册 <?php echo $dir;?></font></div></a-->
<div id="left_panel" style="width:79%;border-right:1px solid #eee;background:transparent;margin-left:auto;margin-top:0;margin-right:auto;display:block;float:left;">
<a id="oImg" target="__blank" style="width:60px;height:15px;margin-top:0px;margin-bottom:0;margin-left:0;position:fixed;background:#a9a;border:0px;font-family: '微软雅黑,宋体';font-size:6px;">查看原图</a>
<button id="toggle_com" onclick="toggleCom();" style="width:60px;height:15px;margin-top:0px;margin-bottom:0;margin-left:50px;position:fixed;background:#a9a;border:0px;font-family: '微软雅黑,宋体';font-size:9px;">关闭吐槽</button>
<a onclick="togglePhotoView(0-1);return false;" href="index.php?dir=<?php echo $curDir;?>" title="" class="img x" style="margin-left:auto;margin-right:auto;display:block;width:91%;">
<img id="img" src="<?php echo "view/".$curDir."/$img"?>" alt="1" style="display:block;border:0px solid #eee;max-width:100%;min-width:70%;min-height:100%;margin:auto auto;vertical-align:middle;top:-50%;"/>
</a>

</div>


<div id="right_panel" style="display:block;border:0px dotted #fbfbfb;border-radius:0px;overflow-y:hidden;margin-left:69%;margin-top:1px;z-index:10;">
<div style="border-bottom:2px solid #bab;color:#111;margin:4% 1% 10px 1%;display:block;">
生命不止，吐槽不息 
</div>

<div style="margin:10px;margin-bottom:0px;border:0px solid #301030;float:left;border-radius:4px;"><!--806090-->
	<textarea id="comment_area" style="font-size:7px;margin-top:5px;width:99%;height:15px;background:#eee;border:0px;" onclick="this.value='';" placeholder="评论" class="clear-input" autocomplete="off"></textarea>
<br/>
	<textarea id="comment_author" style="font-size:7px;width:99%;margin-top:2px;height:15px;float:left;background:#eee;border:0px;" onclick="this.value='';" placeholder="昵称" class="clear-input" autocomplete="off"></textarea>
	<button value＝"清空" style="background:#808080;color:#452;border:0px;float:right;" onclick="clearCom();">清空</button><!--<button value="清空" onclick="clearCom();" >清空</button> -->
	<button value＝"提交" style="background:#707070;border:0px;float:right;" onclick="addCom(comment_area.value+'%'+comment_author.value);">吐槽</button><!--<button value="清空" onclick="clearCom();" >清空</button> --> 
</div>


<div style="margin:15px 8px 12px 11px;border-radius:25px;"><!--508090-->
<div id="comments_div" style="border-top:1px solid f0fefu;background:transparent;min-height:0px;border-radius:0px;border-right:0px solid #508090;color:#eee;height:80%;">
</div>
</div>

</div>
<?php if(isset($_REQUEST['dir'])){?>
	<script> 
	curDir='<?php echo $curDir;?>';
	initDir('<?php echo $curDir;?>');
	photo_view.style.display="block";
	</script>
<?php }?>

</div> <!--photoView-->
