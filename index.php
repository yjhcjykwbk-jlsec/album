<?php 
$ENCODE="utf-8";//应该和文件系统保持一致
$curDir=isset($_REQUEST['dir'])?$_REQUEST['dir']:".";
?>
<html>
<head>
<meta charset="<?php echo $ENCODE;?>">
<title>知识库</title>
<link rel="stylesheet" type="text/css" href="css/container.css" />
<link rel="stylesheet" type="text/css" href="css/item.css" />
<link rel="stylesheet" type="text/css" href="css/contextMenu.css" />

<!-- style related codes -->
<style>
//::-webkit-scrollbar { background-color:#444;border-right:2px solid #555 }
//::-webkit-scrollbar-thumb {background-color:#111;border:2px solid #333;box-shadow:0px 0px 3px #fff;border-radius:2px;}
::-webkit-scrollbar {width:5px;background-color:rgba(200,200,200,0.01);border-radius:1px;}
::-webkit-scrollbar-thumb {box-shadow: 0px 0px 0px 0px #393040; background-color:#89809f;border-radius:2px;}
#photo_view{padding:0px;border:2px solid rgba(5,5,5,0.16);border-right:3px solid rgba(5,5,5,0.16);border-radius:0px;} //border-left:3px solid rgba(5,5,5,0.01);}
::-webkit-scrollbar-thumb:active {background-color:#f99;border-radius:2px;}
::-webkit-scrollbar-thumb:hover {background-color:#f99;border-radius:2px;}
#header,select {
	background:#fff;border:0;border-left:1px solid #eee;height:100%;text-align:center;
}
</style>
<script>
function showCom(){
		comEnabled=true;
		if(img.alt!=comID) getCom();
		left_panel.style.width="79%";
		right_panel.style.display="block";//width="20%";
		photo_view.style.marginLeft="7.5%";
		photo_view.style.width="91%";
		photo_view.style.height="80%";
		photo_view.style.marginTop="0.80%";
		right_panel.style.display="block";
		fbuttons.style.opacity="0.7";
		fbuttons.style.right="20.40%";
		img.style.minWidth="13%";
		toggle_com.innerHTML="切换大屏";
}
function hideCom(){
		comEnabled=false;
		left_panel.style.width="100%";
		right_panel.style.display="none";//width="20%";
		photo_view.style.marginLeft="7.5%";
		photo_view.style.width="87%";
		photo_view.style.height="82%";
		photo_view.style.marginTop="0.30%";
		right_panel.style.display="none";
		fbuttons.style.right="1.95%";
		//photo_view.style.width="88%";
		//fbuttons.style.right="5.65%";
		fbuttons.style.opacity="0.7";
		//fbuttons.style.width="40px";
		img.style.minWidth="15%";
		toggle_com.innerHTML="切换宽屏";
}
var toggleCom=function(){
	if(right_panel.style.display=="none"){
		showCom();
	}else{
		hideCom();
	}
};
var togglePhotoView=function(id){
	if(id>=0&&dirInited){
		body.style.overflowY="hidden";
    header.style.background="#000";
		photo_view.style.display="block";
		hideCom();
		darkerFun(0);
		container.style.opacity="0.02";
    chengxuyuan.style.opacity="0.0";
    end.style.opacity="0.05";
		loadImg(id);
		showPhLst();
	}else{
		body.style.backgroundColor="#faf9ff";
    header.style.background="#fff";
		body.style.overflowY="scroll";
		photo_view.style.display="none";
		container.style.opacity="1";
    chengxuyuan.style.opacity="0.9";
    end.style.opacity="0.3";
		hidePhLst();
	}
}

//box-shadow is darker than body
//photo_view.border color is darker than body, and should be close to photo_view.box-shadow
var darkFlag=0;
var darkerFun=function(c){
	darkFlag=(darkFlag+c+4)%4;
	console.log("darkerFun:"+darkFlag);
	if(darkFlag%4==0){
		left_panel.style.backgroundColor="#fff";
		left_panel.style.boxShadow="100px 0px 20px 150px #fff";
		photo_view.style.backgroundColor="transparent";//rgba(240,246,245,1)";//"rgba(248,248,248,0.999)";
		body.style.backgroundColor="#faf9ff";//"#f3f0f6";
		photo_view.style.boxShadow="rgba(130, 126, 135, 1) 0px 0px 50px 10px";//                     50px 10px 160px 125px rgb(180, 174, 190)";
		comment_area.style.backgroundColor=comment_author.style.backgroundColor="#eee";
		fbuttons.style.color="#212";
		next.style.color= prev.style.color= darker.style.color= bigger.style.color= smaller.style.color="#212";
		next.style.backgroundColor= prev.style.backgroundColor= darker.style.backgroundColor= bigger.style.backgroundColor= smaller.style.backgroundColor="#ddd";
		next.style.border= prev.style.border= darker.style.border= bigger.style.border= smaller.style.border="1px solid #eee";
		left_panel.style.borderRight="1px solid #eee";
		right_panel.style.opacity="1";
	}else if(darkFlag%4==1){
		left_panel.style.backgroundColor="#fff";
		left_panel.style.boxShadow="100px 0px 20px 150px #fff";
		photo_view.style.backgroundColor="transparent";//rgba(240,246,245,1)";//"rgba(248,248,248,0.999)";
		body.style.backgroundColor="#faf9ff";//"#f3f0f6";
		photo_view.style.boxShadow="rgb(15,15,15) -10px 10px 100px 20px";//                     50px 10px 160px 125px rgb(180, 174, 190)";
		comment_area.style.backgroundColor=comment_author.style.backgroundColor="#eee";
		fbuttons.style.color="#212";
		next.style.color= prev.style.color= darker.style.color= bigger.style.color= smaller.style.color="#212";
		next.style.backgroundColor= prev.style.backgroundColor= darker.style.backgroundColor= bigger.style.backgroundColor= smaller.style.backgroundColor="#ddd";
		next.style.border= prev.style.border= darker.style.border= bigger.style.border= smaller.style.border="1px solid #eee";
		left_panel.style.borderRight="1px solid #eee";
		right_panel.style.opacity="1";
	}else if(darkFlag%4==2){
		left_panel.style.backgroundColor="#000";
		photo_view.style.backgroundColor="#111";//"rgba(2,0,5,0.999)";
		body.style.backgroundColor="#343039";
		//photo_view.style.borderBottom=photo_view.style.borderLeft=photo_view.style.borderTop="4px solid #424e5e";
		left_panel.style.boxShadow="100px 10px 160px 185px #000";
		photo_view.style.boxShadow="100px 10px 160px 85px #323035";
		comment_area.style.backgroundColor=comment_author.style.backgroundColor="#768";
		next.style.color= prev.style.color= darker.style.color= bigger.style.color= smaller.style.color="#ccc";
		next.style.backgroundColor= prev.style.backgroundColor= darker.style.backgroundColor= bigger.style.backgroundColor= smaller.style.backgroundColor="#333";
		next.style.border= prev.style.border= darker.style.border= bigger.style.border= smaller.style.border="1px solid #222";
		left_panel.style.borderRight="1px solid #111";
		right_panel.style.opacity="0.8";
	}else if(darkFlag%4==3){
		left_panel.style.backgroundColor="#080808";
		left_panel.style.boxShadow="100px 10px 100px 55px #343739";
		photo_view.style.backgroundColor="#000";//"rgba(2,0,5,0.999)";
		photo_view.style.boxShadow="0px 7px 30px 2px #222";
		body.style.backgroundColor="#000";
		comment_area.style.backgroundColor=comment_author.style.backgroundColor="#222";
		next.style.color= prev.style.color= darker.style.color= bigger.style.color= smaller.style.color="#ccc";
		next.style.backgroundColor= prev.style.backgroundColor= darker.style.backgroundColor= bigger.style.backgroundColor= smaller.style.backgroundColor="#333";
		next.style.border= prev.style.border= darker.style.border= bigger.style.border= smaller.style.border="1px solid #222";
		left_panel.style.borderRight="1px solid #111";
		right_panel.style.opacity="0.8";
	}
};
</script>

</head>
<body id="body" style="height:130%;overflow-x:hidden;">

<script type="text/javascript" src="src/jquery.min.js"></script>
<script type="text/javascript" src="src/jquery.contextmenu.js"></script>
<script type="text/javascript" src="src/jquery.waterfall.js"></script>
<script type="text/javascript" src="src/index.js"></script>

<!-- //header -->
<div style="display:block;width:100%;height:5%;margin-top:0px;z-index:101;"></div>
<?php include "photo.php";?>
<?php include "menu.php";?>

<div class="header" id="header" style="background:rgba(250,250,250,1);opacity:1; <!--#E8EDF1;--#303030;-->
display:block;position:fixed;top:0;width:100%;box-shadow: 0 1px 3px rgba(0,0,0,0.2);height:5%;z-index:100;">
<p>
<select style="float:right;opacity:0.5;margin-top:0px;" align="left" id="selects" onclick="">
<option value="3">每页三列</option>
<option value="4">每页四列</option>
<option value="5">每页五列</option>
<option value="6">每页六列</option>
<option value="7">每页七列</option>
</select>
<select id="music_select" onclick="setMusic(this.value);"style="float:right;opacity:0.5">
<option value="0">请选择背景音乐</option>
<option value="stop">关闭音乐</option>
</select>
<select onclick="setScore(this.value);"style="float:right;opacity:0.5">
<option value="0">请给本网站打分</option>
<option value="1">1星 20分</option>
<option value="2">2星 40分</option>
<option value="3">3星 60分</option>
<option value="4">4星 80分</option>
<option value="5">5星 100分</option>
</select>
<div align="center">
<a href="albums.php" 
style="font-size:110%;display:block;margin-top:8px;height:30px;font-weight:bold;
color:#8af;">一夕一绽一缕芳,一生一叹一痕沙</a></div>
<?php include "music.php";?>
</p>
</div>

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
</script>


<!-- left-panel -->



<div style="display:none;position:fixed;bottom:0;width:100%;height:40px;background:rgba(250,250,250,0.8);z-index:100;opacity:0.5;border-top:0 1px 5px rgba(0,0,0,0.5);"></div>
<div style="position:relative;margin-left:60px;margin-top:0px;">
<div id="container" class="container" style="opacity:0.9;background:rgba(21,20,23,0.05);border:25px solid rgba(255,255,255,0.55);border-top:15px solid rgba(255,255,255,0.55);border-bottom:15px solid rgba(255,255,255,0.55);border-radius:10px;box-shadow:0px 0px 220px 10px rgba(30,0,20,0.2)">
</div>

<div id="end" style="display:none;padding-top:300px;padding-bottom:50px; opacity:0.2; font:20px bold; margin:0 auto; text-align:center;">Final Version 3.0<br/>
<input type="text" id="advice" value="输入建议"/>
<button type="submit" id="submit_advice" onclick="submitAdvice(advice.value);">提交</button>
<h6>or email to zgxu2008@gmail.com</h6><br/>
<iframe src="uploadview.php?dir=<?php echo $curDir;?>" style="z-index:0;position:relative;bottom:10px;width:400px;height:500px;box-shadow: 2px 2px 3px 2px rgb(0,0,0);font-size: 14px;background-color:rgb(222,222,222,0.8);opacity:0.8;border:0;padding:5px;border-radius:1px; line-height: 1;"></iframe> 
</div>
</div>

<script>
function submitAdvice(advice){
  advice=encodeURIComponent(advice);
  $.post("advice.php?advice="+advice,function(data){
    alert("您的意见已经被收录，谢谢您的支持:"+data);
  },"text");
	return;
}
var dir=<?php echo "\"".$curDir."\"";?>;
var colNum=3;
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
function setDesp(dir,img,desp,ref){
	dir=encodeURIComponent(dir);
	img=encodeURIComponent(img);
	desp=encodeURIComponent(desp);
	ref=encodeURIComponent(ref);
	$.post("desp_js.php?dir="+curDir+"&name="+img+"&desp="+desp+"&ref="+ref,function(data){
			alert("添加描述成功");
			//items[id].desp=desp;
			desp_form.style.display="none";
			//刷新
			waterfall.refresh(colNum);
			},'text');
}
function showDespForm(button,dir,imgName){
	rect=button.getBoundingClientRect();
	window.button=button;
	// if(button.offsetParent!=null) {
		// offset.top-=$(button.offsetParent).offset().top;
	// }
	img_dir.value=dir;
	img_name.value=imgName;
	desp_form.style.left=rect.left+"px";
	desp_form.style.top=rect.bottom-150-20+"px";
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
background: #fafafa;
top: 100px;
display:none;
padding:10px;
opacity:0.95;
border-radius:5px;
">
<textarea id="img_dir" style="display:none"></textarea><br/>
<textarea id="img_name" style="display:none"></textarea><br/>
描述<textarea id="desp_input"></textarea><br/>
引用<textarea id="ref_input"></textarea>
<button onclick="setDesp(img_dir.value,img_name.value,desp_input.value,ref_input.value);">提交描述</button>
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
</body>
</html>
