<?php 
$ENCODE="utf-8";//应该和文件系统保持一致
$curDir=isset($_REQUEST['dir'])?$_REQUEST['dir']:".";
?>
<html>
<head>
<meta charset="<?php echo $ENCODE;?>">
<title>红尘，一场漫天的尘埃</title>
<link rel="stylesheet" type="text/css" href="css/container.css" />
<link rel="stylesheet" type="text/css" href="css/item.css" />
<link rel="stylesheet" type="text/css" href="css/contextMenu.css" />

<!-- style related codes -->
<style>
::-webkit-scrollbar {width:5px;background-color:rgba(200,200,200,0.01);border-radius:1px;}
::-webkit-scrollbar-thumb {box-shadow: 0px 0px 0px 0px rgba(127,127,127,0.04); background-color:rgba(127,127,127,0.3);border-radius:1px;}
#photo_view{padding:0px;border-top:0px solid rgba(5,5,5,0.06);border-left:0px solid rgba(5,5,5,0.16);border-right:0px solid rgba(5,5,5,0.16);border-radius:0px;}
::-webkit-scrollbar-thumb:active {background-color:#f99;border-radius:2px;}
::-webkit-scrollbar-thumb:hover {background-color:#f99;border-radius:2px;}
#header select {
  background:transparent;color:#000;font-size:110%;font-weight:bold;border:0;border-left:0px solid rgba(128,128,128,0.5);height:100%;text-align:center;
}
</style>
<script>
function showCom(){
		comEnabled=true;
		if(img.alt!=comID) getCom();
		left_panel.style.width="79%";
		right_panel.style.display="block";//width="20%";
		photo_view.style.marginLeft="10%";
    photo_view.style.width="80%";
		// photo_view.style.height="92%";
		photo_view.style.marginTop="0.4%";
		right_panel.style.display="block";
		fbuttons.style.right="6.35%";
		toggle_com.innerHTML="切换大屏";
}
function hideCom(){
		comEnabled=false;
		left_panel.style.width="100%";
		right_panel.style.display="none";//width="20%";
		photo_view.style.marginLeft="10.0%";
		photo_view.style.width="80.0%";
    // photo_view.style.height="96.0%";
		photo_view.style.marginTop="0.5%";
		right_panel.style.display="none";
		fbuttons.style.right="6.35%";
		//photo_view.style.width="88%";
		//fbuttons.style.right="5.65%";
		//fbuttons.style.width="40px";
		toggle_com.innerHTML="切换宽屏";
}
var toggleCom=function(){
	if(right_panel.style.display=="none"){
		showCom();
	}else{
		hideCom();
	}
};
var scrolltop=0;
var waterfallLoadable=true;
var togglePhotoView=function(id){
	if(id>=0&&dirInited){
		// body.style.overflowY="hidden";
    scrolltop=body.scrollTop;
    body.style.height="100%";
		photo_view.style.display="block";
    showCom();
    darkerFun(0);
    waterfallLoadable=false;
    header.style.display="none";
    header.style.background="transparent";
		container.style.display="none";
		// container.style.opacity="0.02";
    chengxuyuan.style.opacity="0";
    end.style.opacity="0";
		loadImg(id);
		showPhLst();
	}else{
		// body.style.overflowY="scroll";
	//body.style.backgroundColor="#faf9ff";
    body.style.height="200%";
    console.log(scrolltop);
    waterfallLoadable=true;
    header.style.opacity="1";
    header.style.display="block";
    header.style.background="rgb(4,177,204)";
		photo_view.style.display="none";
    container.style.display="block";
		// container.style.opacity="1";
    chengxuyuan.style.opacity="1";
    end.style.opacity="0.6";
		hidePhLst();
    fbuttons.style.right="0";
    body.scrollTop=scrolltop;
	}
}

//box-shadow is darker than body
//photo_view.border color is darker than body, and should be close to photo_view.box-shadow
var darkFlag=0;
var darks=['白色','灰色','灰黑','黑色'];
var darkerFun=function(c){
	darkFlag=(darkFlag+c+4)%4;
  darkFlag=darkFlag%4;
  if(darkFlag<2){
    ph_lst.style.background="rgba(253,255,254,0.1)";
    // header.style.background="rgb(4, 177, 204)";//rgba(253,255,254,0.5)";
  }
  else{
    ph_lst.style.backgroundColor="#111";
    // header.style.background="#181818";
  }
	if(darkFlag%4==0){
		left_panel.style.backgroundColor="#fff";
		photo_view.style.backgroundColor="transparent";//rgba(240,246,245,1)";//"rgba(248,248,248,0.999)";
		body.style.backgroundColor="#fefefe";//"#f3f0f6";

    img.style.boxShadow="";
    // photo_view.style.boxShadow="rgba(150, 156, 155, 1) 0px 1px 1px 1px";//                     50px 10px 160px 125px rgb(180, 174, 190)";
		comment_area.style.backgroundColor=comment_author.style.backgroundColor="#eee";
		fbuttons.style.color="#212";
		zoomer.style.color=next.style.color= prev.style.color= darker.style.color= bigger.style.color= smaller.style.color="#212";
    zoomer.style.backgroundColor=next.style.backgroundColor= prev.style.backgroundColor= darker.style.backgroundColor= bigger.style.backgroundColor= smaller.style.backgroundColor="#ddd";
		zoomer.style.border=next.style.border= prev.style.border= darker.style.border= bigger.style.border= smaller.style.border="1px solid #eee";
		left_panel.style.borderRight="1px solid #eee";
		right_panel.style.opacity="1";
	}else if(darkFlag%4==1){
		left_panel.style.backgroundColor="#fff";
		photo_view.style.backgroundColor="#fafafa";//rgba(280,286,285,1)";//"rgba(288,288,288,0.999)";
		body.style.backgroundColor="#f0f0f0";//"#f3f0f6";
	  img.style.boxShadow="";//100px 0px 20px 150px #fff";
    // photo_view.style.boxShadow="rgb(5,8,5) 0px 1px 1px 1px";//-10px 10px 100px 20px";//                     50px 10px 160px 125px rgb(180, 174, 190)";
		comment_area.style.backgroundColor=comment_author.style.backgroundColor="#eee";
		comment_area.style.color=comment_author.style.color="#444";
		fbuttons.style.color="#212";
		zoomer.style.color=next.style.color= prev.style.color= darker.style.color= bigger.style.color= smaller.style.color="#212";
		zoomer.style.backgroundColor=next.style.backgroundColor= prev.style.backgroundColor= darker.style.backgroundColor= bigger.style.backgroundColor= smaller.style.backgroundColor="#ddd";
		zoomer.style.border=next.style.border= prev.style.border= darker.style.border= bigger.style.border= smaller.style.border="1px solid #eee";
		left_panel.style.borderRight="1px solid #eee";
		right_panel.style.opacity="1";
	}else if(darkFlag%4==2){
		left_panel.style.backgroundColor="#282828";
		photo_view.style.backgroundColor="#282828";//"rgba(2,0,5,0.999)";
		body.style.backgroundColor="#111";
		//photo_view.style.borderBottom=photo_view.style.borderLeft=photo_view.style.borderTop="4px solid #424e5e";
		// left_panel.style.boxShadow="100px 10px 160px 185px #000";
		// photo_view.style.boxShadow="100px 10px 160px 485px #111";
		comment_area.style.backgroundColor=comment_author.style.backgroundColor="#080808";
		comment_area.style.color=comment_author.style.color="#888";
		zoomer.style.color=next.style.color= prev.style.color= darker.style.color= bigger.style.color= smaller.style.color="#ccc";
		zoomer.style.backgroundColor=next.style.backgroundColor= prev.style.backgroundColor= darker.style.backgroundColor= bigger.style.backgroundColor= smaller.style.backgroundColor="#333";
		zoomer.style.border=next.style.border= prev.style.border= darker.style.border= bigger.style.border= smaller.style.border="1px solid #222";
		left_panel.style.borderRight="1px solid #111";
		right_panel.style.opacity="0.8";
	}else if(darkFlag%4==3){
		left_panel.style.backgroundColor="#040404";
		photo_view.style.backgroundColor="#040404";//"rgba(2,0,5,0.999)";
		body.style.backgroundColor="#000";
		// img.style.boxShadow="100px 10px 100px 55px #343739";
    // photo_view.style.boxShadow="-1px 1px 20px 2px #222";
		comment_area.style.backgroundColor=comment_author.style.backgroundColor="#030303";
		comment_area.style.color=comment_author.style.color="#888";
		zoomer.style.color=next.style.color= prev.style.color= darker.style.color= bigger.style.color= smaller.style.color="#ccc";
		zoomer.style.backgroundColor=next.style.backgroundColor= prev.style.backgroundColor= darker.style.backgroundColor= bigger.style.backgroundColor= smaller.style.backgroundColor="#333";
		zoomer.style.border=next.style.border= prev.style.border= darker.style.border= bigger.style.border= smaller.style.border="1px solid #222";
		left_panel.style.borderRight="1px solid #111";
		right_panel.style.opacity="0.8";
	}
  darker.innerText=""+darks[darkFlag%4];
};
</script>

</head>
<body id="body" style="height:200%;overflow-y:scroll;">

<script type="text/javascript" src="src/jquery.min.js"></script>
<script type="text/javascript" src="src/jquery.contextmenu.js"></script>
<script type="text/javascript" src="src/jquery.waterfall.js"></script>
<script type="text/javascript" src="src/index.js"></script>

<!-- //header -->
<!--<div style="display:block;width:100%;height:2%;margin-top:0px;z-index:101;"></div> -->
<?php include "photo.php";?>
<?php include "menu.php";?>

<div class="header" id="header" style="background:rgb(4, 177, 204);display:block;position:absolute;top:0;width:100%;height:3.0%;z-index:9999;">
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
<div 
style="float:left;display:;height:;font-weight:bold;
color:#8fa;">
时光静美，光影沉默.刹那韶华，留存感动>>>>>>>>>>>>>>
</div>
<div align="center">
<a id="index_href" href="albums.php" 
style="font-size:110%;display:;margin-top:8px;height:;font-weight:bold;
color:#8af;">
一夕一绽一缕芳,一生一叹一痕沙</a></div>
</p>
</div>
<?php include "music.php";?>

<script>
var scored=false;
var setScore=function(s){
	if(s=="0") return;
	if(scored){
		alert("您已经评价过了，谢谢！");
		return;
	}
	$.get("com_js.php?act=score&score="+s,function(data){
			alert("收到您的评分("+data+")如果觉得本站不错，请推荐给其他好友");
			scored=true;
			},"text");
};
var curDir="<?php echo $curDir;?>";
</script>


<!-- left-panel -->



<!--// <div style="display:none;position:fixed;bottom:0;width:100%;height:;background:rgba(250,250,250,0.8);z-index:100;opacity:0.5;border-top:0 1px 5px rgba(0,0,0,0.5);"></div>-->
<div style="position:relative;margin-left:60px;margin-top:0px;">
<div id="container" class="container" style="margin-top:25px;opacity:0.9;min-height:;background:rgba(21,20,23,0.01);border:25px solid rgba(255,255,255,0.02);border-top:15px solid rgba(255,255,255,0.02);border-bottom:15px solid rgba(255,255,255,0.02);border-radius:1px;box-shadow:0px 0px 10px 1px rgba(30,0,20,0.2)">
</div>
<div id="end" style="display:none;padding-top:100px;padding-bottom:50px; opacity:0.6; font:20px bold; margin:0 auto; text-align:center;">Final Version 3.0<br/>
<input type="text" id="advice" value="输入建议"/>
<button type="submit" id="submit_advice" onclick="submitAdvice(advice.value);">提交</button>
<h6>or email to zgxu2008@gmail.com</h6><br/>
 <!--iframe src="uploadview.php?dir=<?php echo $curDir;?>" style="z-index:0;position:relative;bottom:10px;width:400px;height:500px;box-shadow: 2px 2px 3px 2px rgb(0,0,0);font-size: 14px;background-color:rgb(222,222,222,0.8);opacity:0.8;border:0;padding:5px;border-radius:1px; line-height: 1;"></iframe--> 
<?php include_once "uploadview.php";?>
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
var colNum=4;
var waterfall=new MyWaterfall(dir,colNum);
initDir();
var setDir=function(dir){
	togglePhotoView(-1);
  if(curDir==dir) return;
	curDir=dir;
	initDir();
	if(waterfall!=undefined&&waterfall!=null) 
		waterfall.clear();
	waterfall=new MyWaterfall(dir,colNum);
};
selects.onclick=function(){
  if(colNum==this.value) return;
	colNum=this.value;
	waterfall.refresh(colNum);
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
function changeDespForm(button,dir,imgName,desp,ref){
	rect=button.getBoundingClientRect();
	window.button=button;
	img_dir.value=dir;
	img_name.value=imgName;
  desp_input.value=desp;
  ref_input.value=ref;
	desp_form.style.left=rect.left+"px";
	desp_form.style.top=rect.bottom-150-20+"px";
	desp_form.style.display="block";
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
