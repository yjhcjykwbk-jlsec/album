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
<style>
//::-webkit-scrollbar { background-color:#444;border-right:2px solid #555 }
//::-webkit-scrollbar-thumb {background-color:#111;border:2px solid #333;box-shadow:0px 0px 3px #fff;border-radius:2px;}
::-webkit-scrollbar {width:7px;background-color:#fff;border-radius:1px;}
::-webkit-scrollbar-thumb {box-shadow: 0px 0px 0px 0px #393040; background-color:#e9e0f0;border-radius:2px;}
::-webkit-scrollbar-thumb:active {background-color:#fbb;border-radius:2px;}
::-webkit-scrollbar-thumb:hover {background-color:#fbb;border-radius:2px;}
</style>

</head>
<body id="body" style="height:130%">

<script type="text/javascript" src="src/jquery.min.js"></script>
<script type="text/javascript" src="src/jquery.contextmenu.js"></script>
<script type="text/javascript" src="src/jquery.waterfall.js"></script>
<script type="text/javascript" src="src/index.js"></script>

<!-- //header -->
<div style="background: center rgba(#807080,0.2);<!--#E8EDF1;--#303030;-->
display:block;width:100%;height:40px;margin-top:0px;z-index:100;">
<p>
<select style="float:right;opacity:0.2;margin-top:0px;" align="left" id="selects" onclick="">
<option value="3">每页三列</option>
<option value="4">每页四列</option>
<option value="5">每页五列</option>
<option value="6">每页六列</option>
<option value="7">每页七列</option>
</select>
<select id="music_select" onclick="setMusic(this.value);"style="float:right;opacity:0.2">
<option value="0">请选择背景音乐</option>
<option value="stop">关闭音乐</option>
</select>
<select onclick="setScore(this.value);"style="float:right;opacity:0.2">
<option value="0">请给本网站打分</option>
<option value="1">1星</option>
<option value="2">2星</option>
<option value="3">3星</option>
<option value="4">4星</option>
<option value="5">5星</option>
</select>
<div align="center"><font color="white" style="font-family:'微软雅黑,宋体';font-size:8px;">信息安全实验室影集   请使用<font color="yellow"> google浏览器</font>查看</font>  <a href="albums.php" style="font-size:110%;font-weight:bold;color:#8af;text-decoration:underline;">相册首页从此进入</a></div>
<?php include "music.php";?>
</p>
</div>
<?php include "photo.php";?>
<?php include "menu.php";?>

<script>
var scored=false;
var setScore=function(s){
	if(s=="0") return;
	if(scored){
		alert("您已经评价过了，谢谢！");
		return;
	}
	$.get("com_js.php?act=score&score="+s,function(data){
			alert("谢谢您的支持，反馈已经被记录:"+data);
			scored=true;
			},"text");
};
var curDir="<?php echo $curDir;?>";
var togglePhotoView=function(id){
	if(id>=0&&dirInited){
		body.style.overflowY="hidden";
		photo_view.style.display="block";
		container.style.opacity="0.2";
		loadImg(id);
	}else{
		body.style.backgroundColor="#f4f0f9";
		body.style.overflowY="scroll";
		photo_view.style.display="none";
		container.style.opacity="1";
	}
}
</script>


<!-- left-panel -->


<div style="position:relative;margin-left:100px;margin-top:0px;">
<div id="container" class="container" style="opacity:0.9">
</div>

<div id="end" style="display:none;padding-top:80px; opacity:0.7; font:20px bold; margin:0 auto; text-align:center;">Final Version 3.0<br/>
<hr>
<input type="text" id="advise" value="输入建议"/>
<button type="submit" id="submit_advise" onclick="submitAdvise();">提交</button>
<h6>or email to zgxu2008@gmail.com</h6><br/>
<iframe src="uploadview.php?dir=<?php echo $curDir;?>" style="z-index:0;position:relative;bottom:10px;width:600px;height:400px;box-shadow: 2px 2px 3px 2px rgb(0,0,0);font-size: 14px;background-color:rgb(222,222,222,0.8);opacity:0.5;border:0;padding:5px;border-radius:1px; line-height: 1;"></iframe> 
</div>
</div>

<script>
function submitAdvise(){
	alert("您的意见已经被收录，谢谢您的支持");
	return;
}
var dir=<?php echo "\"".$curDir."\"";?>;
var colNum=5;
var waterfall=new MyWaterfall(dir,colNum);
initDir();
var setDir=function(dir){
	togglePhotoView(-1);
	curDir=dir;
	initDir();
	if(waterfall!=undefined&&waterfall!=null) 
		waterfall.clear();
	waterfall=new MyWaterfall(dir,colNum);
};
selects.onclick=function(){
	colNum=3+this.selectedIndex;
	waterfall.refresh(3+this.selectedIndex);
}
function setDesp(img,desp,ref){
	img=encodeURIComponent(img);
	desp=encodeURIComponent(desp);
	ref=encodeURIComponent(ref);
	$.post("desp_js.php?name="+img+"&desp="+desp+"&ref="+ref,function(data){
			alert("添加描述成功");
			//items[id].desp=desp;
			desp_form.style.display="none";
			//刷新
			waterfall.refresh(colNum);
			},'text');
}
function showDespForm(button,imgName){
	console.log(button);
	rect=button.getBoundingClientRect();
	window.button=button;
	// if(button.offsetParent!=null) {
		// offset.top-=$(button.offsetParent).offset().top;
	// }
	img_name.value=imgName;
	desp_form.style.left=rect.left+"px";
	desp_form.style.bottom=rect.bottom+"px";
	desp_form.style.display="block";
}
</script>
<div id="desp_form" style="
width: 220px;
height:130px;
box-shadow:4px 5px 10px 3px #888;
position: fixed;
z-index: 101;
left: 100px;
background: #f0f0f0;
top: 100px;
display:none;
padding:10px;
opacity:0.95;
border-radius:5px;
">
<textarea id="img_id" style="display:none"></textarea><br/>
<textarea id="img_name" style="display:none"></textarea><br/>
描述<textarea id="desp_input"></textarea><br/>
引用<textarea id="ref_input"></textarea>
<button onclick="setDesp(img_name.value,desp_input.value,ref_input.value);">提交描述</button>
<button onclick="desp_form.style.display='none';">取消</button>
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
<script>
togglePhotoView(1);
//darkerFun();
</script>
</body>
</html>
