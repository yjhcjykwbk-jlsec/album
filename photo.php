<?php
//if(!isset($_REQUEST['img'])||!isset($_REQUEST['dir'])) return;
//$img=$_REQUEST['img'];
//$dir=$_REQUEST['dir'];
//$id=$_REQUEST['id'];
$dir=$curDir;
$img="front.jpg";
$id=0;
?>
<div id="photo_view" style="overflow:overlay;box-shadow:0px 10px 120px 45px #555;background:#fff;padding-right:20px;padding-left:5px;z-index:100;display:none;position:fixed;width:80%;height:95%;margin-left:12%;margin-top:-5px;">
<style> #comment_span{color:white;} body{background:#f8f8f8; margin:0px;margin-top:0px; } #author{ width:20px;font-weight:bold; color:#369;}
</style>
<script type="text/javascript">
var comEnabled=false;
var toggleCom=function(){
	if(right_panel.style.display=="none"){
		comEnabled=true;
		if(img.alt!=comID) getCom();
		left_panel.style.width="81%";
		right_panel.style.display="block";
//		next.style.marginLeft="58%";
		toggle_com.innerHTML="关闭吐槽";
	}else{
		left_panel.style.width="100%";
		right_panel.style.display="none";
//		next.style.marginLeft="73%";
		toggle_com.innerHTML="开启吐槽";
		comEnabled=false;
	}
};
var items;
var dirInited=false;
var initDir=function(){
console.log("...........initdi");
	dirInited=false;
	console.log(curDir);
	items=null;
	$.get('more.php?dir='+curDir,
			function(data){
			//console.log(data.items);
			items=data.items;
			dirInited=true;
			},'json');
};
var loadImg=function(id){
	img.alt=id;
	item=items[img.alt];
	img.src="view/"+curDir+"/"+item.href;
	oImg.href="DATASET/"+curDir+"/"+item.href;
};
function prevFun(){
	if(img.alt==0) {
		//alert("已经到达第一张图片，将从末尾开始");
		img.alt=items.length-1;
	}
	else img.alt=img.alt-1;
	loadImg(img.alt);

	//since get comment must be called when comEnabled and img.alt changed
	if(comEnabled) getCom();
};
var nextFun=function(){
	if(img.alt==items.length-1) {
		//alert("已经到达最后一张图片,将从第一张重新开始");
		img.alt=0;
	}
	else img.alt=img.alt-(-1);
	loadImg(img.alt);

	//since get comment must be called when comEnabled and img.alt changed
	if(comEnabled) getCom();
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
        comments_div.innerHTML+='<div id="comment_span" style="border:0px solid #fff;display:block;float:left;border-bottom:1px solid #f8f8f8;padding-top:5px;width:99%;font-size:80%;background:#edeff4;">'+'<span id="author">'+author+':   </span><span style="font-size:100%;color:#333;text-decoration:none;">'+content+'</span><a onclick="delCom(\''+comment+'\')" style="display:block;float:right;background:#202020;border:1px solid #707070;font-size:70%;margin-top:-1px;"> 删除</a></div>';
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
<button id="toggle_com" onclick="toggleCom();" style="width:100%;height:15px;margin-top:-10px;margin-bottom:0;background:#f060f0;border:0px;font-family: '微软雅黑,宋体';font-size:10px;">开启吐槽</button>
<div id="left_panel" style="width:100%;border-right:0px solid #fff;background:#f8f8f8;margin-left:auto;margin-top:0;margin-right:auto;display:block;float:left;">
<button id="prev" onclick="prevFun();" style="float:left;margin-left:0%;margin-top:20%;width:6%;height:120px;border:1px solid #fe8efe;background:#fef;opacity:1;">上张</button>
<a onclick="togglePhotoView(0-1);return false;" title="" class="img x" style="float:left;display:block;width:87%;">
<img id="img" src="view/"+curDir+"/front.jpg" alt="1" style="display:block;border:5px solid #eee;padding:3px;max-width:100%;margin:auto auto;margin-top:10px;max-height:96%;min-height:90%;vertical-align:middle;top:-50%;"/>
</a>
<button id="next" onclick="nextFun();" style="float:right;margin-top:20%;margin-right:0%;width:6%;height:120px;border:1px solid #fe8efe; background:#fef;opacity:1;">下张</button>
<br/>
</a>

<div id="desp" style="color:#444;font-size:10px;margin-bottom:5px;margin-left:20px;font-weight:bold;display:block;">
<a href="DATASET/" target="__blank" id="oImg" style="color:red"> 原图</a>
</div>
</div>


<div id="right_panel" style="display:none;position:absolute;background:#f8f8f8;border:1px dotted #f0f0f0;border-radius:0px;width:20%;min-height:96%;float:right;margin-left:80%;margin-top:1px;">
<div style="border:0px dotted #210;border-bottom:2px solid #a8afa0;background:;opacity:0.6;"><div id="desp" style="color:#111;margin:4% 1% 2% 1%;display:block;">
吐槽它是一种态度^_^ <br/>
不管你信不信，反正..</div>
</div>

<div style="margin:10px;margin-bottom:0px;height:25px;border:0px solid #301030;float:left;border-radius:4px;"><!--806090-->
	<textarea id="comment_author" style="width:60%;height:25px;float:left;background:#eee;border:0px;" onclick="this.value='';" placeholder="昵称" class="clear-input" autocomplete="off"></textarea>
	<button value＝"清空" style="background:#808080;color:#452;border:0px;float:right;" onclick="clearCom();">清空</button><!--<button value="清空" onclick="clearCom();" >清空</button> -->
	<button value＝"提交" style="background:#707070;border:0px;float:right;" onclick="addCom(comment_area.value+'%'+comment_author.value);">吐槽</button><!--<button value="清空" onclick="clearCom();" >清空</button> --> 
	<textarea id="comment_area" style="margin-top:5px;width:95%;height:25px;background:#eee;border:0px;" onclick="this.value='';" placeholder="评论" class="clear-input" autocomplete="off"></textarea>
</div>

<div style="margin:75px 8px 32px 11px;border-radius:25px;"><!--508090-->
<div id="comments_div" style="background:#edeff4;min-height:0px;border-radius:2px;border:0px solid #508090;color:#0e0e0e"></div>
</div>

</div>

</div> <!--photoView-->
