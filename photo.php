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
<div id="chengxuyuan" style="display:none;width:180px;bottom:46%;right:46%;border-radius:5px;padding:20px;box-shadow:5px 10px 10px 2px #222;z-index:100;position:fixed;opacity:0.9;background:#eee;">
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
<script>
setTimeout(function(){
	chengxuyuan.style.right="40%";
	chengxuyuan.style.bottom="50%";
	chengxuyuan.style.width="200px";
	chengxuyuan.style.display="block";
	chengxuyuan.style.backgroundColor="#eee";
	setTimeout(function(){
		chengxuyuan.style.right="0px";
		chengxuyuan.style.bottom="-15px";
		chengxuyuan.style.width="80px";
		yuanIntro.innerHTML="hello world!<br/>any question<br/>click me!";
		yuanIntro.style.display="block";
	},2000);
},1000);
var chengxuyuanGoDie=function(){
	chengxuyuan.style.display="none";
	dubaiFlag=4;
	setTimeout(dubaijun,1000);
};
var _right=200;
var _top=200;
var rand=function(s){
	return Math.floor(Math.random()*s);
};
var randomMessagePos=function(){
/*	_left+=((Math.ceil(Math.random()*9)-3)*20);
_top+=((Math.ceil(Math.random()*9)-5)*20);
 */
	message.style.color="rgb("+rand(150)+","+rand(150)+","+rand(150)+")";
};
var dubaiFuns=function(){
	s0=function(){
		message.style.display="block";
		randomMessagePos();
		message_content.innerHTML="您造吗？鼠标快捷键ctrl+(上下左右)可以快速浏览滚动以及缩放，点击灯光或pageup/down切换不同显示效果,enter留言!赶快试试吧!";
    end.style.opacity="0.05";
		message_pre_content.innerHTML="";
	};
	s1=function(){	
		message.style.display="block";
		randomMessagePos();
		message_content.innerHTML="说完这些，本码农就要水论文去了。。代码容易，论文不易，且水且珍惜T T";
		message_pre_content.innerHTML="";
	};
	s2=function(){
		message.style.display="block";
		randomMessagePos();
		message_content.innerHTML="@_@~机器学习，svm，算法，MSER..@#@#@#!@%$@#!语言乱码中，请勿扰...";
		message_pre_content.innerHTML="";
	};
	s3=function(){	
		message.style.display="block";
		randomMessagePos();
		message_content.innerHTML="";
		message_pre_content.innerHTML=
			"for(;;){ \n"+
			"	if(!i.isWateringCode())\n"+
			"		i.water(article);\n"+
			"}";
	};
	die=function(){
		message.style.display="block";
		randomMessagePos();
		message_content.innerHTML="";
		message_pre_content.innerHTML="\ni.am.died.in.extremal.south.moutain();\nexit();\n//...";
	};
	return [s0,s1,s2,s3,die];
}();
var lastMsgTime=0;
var curTime=function(){
	return new Date().getSeconds();
};
var endFun=function(){
	if(curTime()-lastMsgTime>1){
		message.style.display="none";
	}
}	
var dubaiFlag=0;
var dubaijun=function(){
	lastMsgTime=curTime();
	dubaiFuns[dubaiFlag]();
	setTimeout(endFun,3000);
	dubaiFlag=(dubaiFlag+rand(2)+1)%4;
};
</script>
<div id="photo_view" style="display:none;overflow-x:hidden;overflow-y:overlay;box-shadow:rgba(130, 126, 135, 1) 0px 0px 100px 20px;background:#fefdff;;z-index:100;position:fixed;height:84%;margin-left:7%;margin-right:auto;">

<div class="fButtons" id="fbuttons" style="height:240px;position:fixed;opacity:0.7;color:#212;margin-top:20%;width:40px;border:0px solid #eee;background:#ddd;z-index:102;border-radius:0px">
<button class="fButton" id="prev" onclick="prevFun();" 		style="border:1px solid #eee;background:#ddd;width:100%;height:40px;">上张</button>
<button class="fButton" id="next" onclick="nextFun();" 		style="border:1px solid #eee;background:#ddd;width:100%;height:40px; ">下张</button>
<button class="fButton" id="bigger" onclick="biggerFun();" 	style="border:1px solid #eee;background:#ddd;width:100%;height:40px; ">放大</button>
<button class="fButton" id="smaller" onclick="smallerFun();" 	style="border:1px solid #eee;background:#ddd;width:100%;height:40px; ">缩小</button>
<button class="fButton" id="darker" onclick="darkerFun(1);" 	style="border:1px solid #eee;background:#ddd;width:100%;height:40px; ">灯光</button>
<button class="fButton" id="zoomer" style="border:1px solid #eee;background:#ddd;width:100%;height:40px; ">zoom</button>
</div>

<style>
.fButton:hover{ color:red; }
#comment_span{color:white;} body{background:#e9ece0; margin:0px;margin-top:0px; } #author{ width:20px;font-weight:bold; color:#369;}
</style>
<script type="text/javascript">
var comEnabled=true;
var biggerFun=function(){
	cur=img.style.zoom;
	if(cur=="") cur=1;
	else {
		cur=parseFloat(cur);
	}
	if(cur>=8) return; 
	if(cur>=4) cur=8;
	else if(cur>=1.75) cur=4;
	else if(cur>=1) cur+=0.5;
	else cur=1;
	//	console.log("zoom:"+cur);
	if(cur<8) zoomer.innerHTML=(cur*100)+"%";
	else zoomer.innerHTML="800%";
	img.style.zoom=cur+"";
};
var smallerFun=function(){
	cur=img.style.zoom;
	if(cur=="") cur=1;
	else {
		cur=parseFloat(cur);
	}
	if(cur<=0.125) return;
	if(cur>=6) cur-=4;
	else if(cur>=4) cur-=2;
	else if(cur>=2) cur-=1;
	else if(cur>1) cur-=0.5;
	else if(cur>0.25)cur-=0.25;
	else cur-=0.125;
	//console.log("zoom:"+cur);
	zoomer.innerHTML=(cur*100)+"%";
	//zoomer.innerHTML=cur;
	img.style.zoom=cur+"";
};
var allItems={};
var items;
var dirInited=false;
var initDir=function(){
	//restore img size
	img.style.zoom="8";
	zoomer.innerHTML="800%";

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
String.prototype.endWith=function(str){
if(str==null||str==""||this.length==0||str.length>this.length)
  return false;
if(this.substring(this.length-str.length)==str)
  return true;
else
  return false;
return true;
}
var loadImg=function(id){
	if(id<0||id>=items.length) return;
	img.alt=id;
	item=items[img.alt];
	//console.log(item.ref);
	if(item.ref.endWith(".swf")){
		movie.src=item.ref;

		img.style.display="none";
		movie.style.display="block";
	}else{
		img.src="view/"+curDir+"/"+item.href;
		oImg.href="DATASET/"+curDir+"/"+item.href;

		img.style.display="block";
		movie.style.display="none";
	}

	//since get comment must be called when comEnabled and img.alt changed
	if(comEnabled) getCom();

	loadLst(id);
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
};
var autoPlayInterval="";
var stopAutoPlay=function(){
	clearInterval(autoPlayInterval);
	autoPlayInterval="";
	auto_play.innerHTML="自动播放";
	return;
};
var toggleAutoPlay=function(){
	if(autoPlayInterval!="") {
		stopAutoPlay();
	}
	img.style.zoom="8";
	autoPlayInterval=setInterval(function(){
		if(photo_view.style.display!="block") 
			stopAutoPlay();
		else nextFun();
	},3000);
	auto_play.innerHTML="停止放映";
};
document.onkeydown=function(event){
	if(photo_view.style.display=="block"){
		t=event.keyCode;
		if(event.ctrlKey){
			if(t==38) biggerFun();
			else if(t==40) smallerFun();
			return;
		}
		if(t==37) prevFun();
		else if(t==38) photo_view.scrollTop-=350;
		else if(t==39) nextFun();
		else if(t==40) photo_view.scrollTop+=350;
		//pageup pagedown
		else if(t==33) darkerFun(-1);
		else if(t==34) darkerFun(1);
		//enter
		else if(t==13) toggleCom();
		//esc
		else if(t==27) togglePhotoView();
	}
};

//the first time to this page will getcomment initially
//init(getCom);
</script>
<!--header-->
<!--a href="index.php?dir=<?php echo $dir;?>">
<div style="background:#f060f0;display:block;width:100%;height:20px;display:block;font-size:10px;margin:auto auto;border:0px solid #505050;"> <font style="color:red;">返回相册 <?php echo $dir;?></font></div></a-->
<div id="left_panel" style="width:79%;border-right:1px solid #eee;background:transparent;margin-left:auto;margin-top:0;margin-right:auto;display:block;float:left;">
<a id="oImg" target="__blank" style="width:60px;height:15px;margin-top:-0%;margin-bottom:0;margin-left:0;position:fixed;background:#a9a;border:0px;font-family: '微软雅黑,宋体';font-size:6px;">查看原图</a>
<button id="toggle_com" onclick="toggleCom();" style="width:60px;height:15px;margin-top:-0%;margin-bottom:0;margin-left:50px;position:fixed;background:#a9a;border:0px;font-family: '微软雅黑,宋体';font-size:9px;">切换大屏</button>
<button id="auto_play" onclick="toggleAutoPlay();" style="width:60px;height:15px;margin-top:-0%;margin-bottom:0;margin-left:110px;position:fixed;background:#a9a;border:0px;font-family: '微软雅黑,宋体';font-size:9px;">自动播放</button>
<a onclick="togglePhotoView(0-1);return false;" href="index.php?dir=<?php echo $curDir;?>" title="" class="img x" 
style="margin-left:auto;margin-right:auto;display:block;">
<img id="img" src="<?php echo "view/".$curDir."/$img"?>" alt="1" style="zoom:8;display:block;border:0px solid #eee;max-width:100%;min-width:20%;min-height:100%;margin:auto auto;vertical-align:middle;top:-50%;"/>
<?php include_once "movie.php";?>
</a>

</div>

<div id="right_panel" style="width:16%;display:block;border:0px dotted #fbfbfb;border-radius:0px;overflow-y:hidden;overflow-x:hidden;margin-left:72%;position:fixed;margin-top:1px;z-index:10;">
<div style="border-bottom:0px solid #bab;color:#111;margin:4% 1% 10px 1%;display:block;">
生命不止，吐槽不息 
</div>

<div style="margin:10px;margin-bottom:0px;border:0px solid #301030;float:left;border-radius:4px;"><!--806090-->
	<textarea id="comment_area" style="font-size:50%;margin-top:5px;width:99%;height:15px;background:#eee;border:0px;" onclick="this.value='';" placeholder="评论" class="clear-input" autocomplete="off"></textarea>
<br/>
	<textarea id="comment_author" style="font-size:50%;width:99%;margin-top:2px;height:15px;float:left;background:#eee;border:0px;" onclick="this.value='';" placeholder="昵称" class="clear-input" autocomplete="off"></textarea>
	<button value＝"清空" style="background:#808080;color:#452;border:0px;float:right;" onclick="clearCom();">清空</button><!--<button value="清空" onclick="clearCom();" >清空</button> -->
	<button value＝"提交" style="background:#707070;border:0px;float:right;" onclick="addCom(comment_area.value+'%'+comment_author.value);">吐槽</button><!--<button value="清空" onclick="clearCom();" >清空</button> --> 
</div>


<div style="margin:15px 8px 12px 11px;border-radius:25px;"><!--508090-->
<div id="comments_div" style="width:98%;max-width:100%;max-height:450px;overflow-y:scroll;overflow-x:hidden;border-top:1px solid f0fefu;
background:transparent;min-height:0px;border-radius:0px;border-right:0px solid #508090;color:#eee;height:80%;">
</div>
</div>

</div>
</div> <!--photoView-->

<?php include "photolst.php";?>


<?php if(isset($_REQUEST['id'])){?>
<script> 
curDir='<?php echo $curDir;?>';
initDir('<?php echo $curDir;?>');
photo_view.style.display="block";
</script>
<?php }?>
