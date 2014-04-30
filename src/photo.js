//index.php  control views;
////////////////////////////
//utils
//
function style(s,t,e){
  s.style[t]=e;
}
// var fBtns=[goheader,goend,prev,next,bigger,smaller,darker,menus];
//
var scrolltop=0;
var waterfallLoadable=true;
var togglePhotoView=function(id){
  console.log("togglePhotoView:"+id+":"+dirInited);
  //show
	if(id>=0&&dirInited){
		// body.style.overflowY="hidden";
    darkerFun(0);
    scrolltop=body.scrollTop;
    body.style.height="100%";

		loadImg(id);
		photo_view.style.display="block";

    showCom();
    showPhLst();
    flashFun(menus,"red",2000);
    setTimeout(function(){
      hideMenus();
      menus.style.backgroundColor="#333";
    },2000);

    waterfallLoadable=false;

    header.style.display="none";
    // header.style.background="transparent";

		container.style.display="none";
    
    chengxuyuan.style.opacity="0.03";
    end.style.opacity="0.01";
	}else{
    //hide
    if(darkFlag<2) body.style.backgroundColor="#fff";
    else  body.style.backgroundColor="#333";

    body.style.height="200%";
    waterfallLoadable=true;

    header.style.display="block";

		photo_view.style.display="none";

    container.style.display="block";
    chengxuyuan.style.opacity="0.6";
    end.style.opacity="1";

		hidePhLst();
    fbuttons.style.right="0";
    body.scrollTop=scrolltop;
	}
}
function showCom(){
		comEnabled=true;
		if(img.alt!=comID) getCom();
		left_panel.style.width="70%";
		right_panel.style.display="block";//width="20%";
		photo_view.style.marginLeft="10.0%";
    photo_view.style.width="78%";
		// photo_view.style.height="92%";
		photo_view.style.marginTop="1.05%";
		right_panel.style.display="block";
		fbuttons.style.right="10.15%";
		toggle_com.innerHTML="切换大屏";
}
function hideCom(){
		comEnabled=false;
		left_panel.style.width="99%";
		right_panel.style.display="none";//width="20%";
		photo_view.style.marginLeft="12.0%";
		photo_view.style.width="78.5%";
    // photo_view.style.height="96.0%";
		photo_view.style.marginTop="1.05%";
		right_panel.style.display="none";
		fbuttons.style.right="8.5%";
		//photo_view.style.width="88%";
		//fbuttons.style.right="5.35%";
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

//box-shadow is darker than body
//photo_view.border color is darker than body, and should be close to photo_view.box-shadow
var darkFlag=3;
var darks=['白色','灰色','灰黑','黑色'];
function darker0(){
		img_panel.style.backgroundColor=comments_panel.style.backgroundColor="#fff";
    right_panel.style.backgroundColor="#fff";
		photo_view.style.backgroundColor="transparent";//rgba(240,246,245,1)";//"rgba(248,248,248,0.999)";

    img.style.boxShadow="";
		comment_area.style.backgroundColor=comment_author.style.backgroundColor="#eee";
		fbuttons.style.color="#212";
    $('.fButton').each(function(i,item){style(item,"color","#212");});
    $('.fButton').each(function(i,item){style(item,"backgroundColor","#ddd");});
    $('.fButton').each(function(i,item){style(item,"border","1px solid #eee");});
		right_panel.style.opacity="1";
};
function darker1(){
		img_panel.style.backgroundColor=comments_panel.style.backgroundColor=right_panel.style.backgroundColor="#fff";
		photo_view.style.backgroundColor="transparent";//rgba(240,246,245,1)";//"rgba(248,248,248,0.999)";
	  img.style.boxShadow="";//100px 0px 20px 150px #fff";
		comment_area.style.backgroundColor=comment_author.style.backgroundColor="#eee";
		comment_area.style.color=comment_author.style.color="#444";
		fbuttons.style.color="#212";
    $('.fButton').each(function(i,item){style(item,"color","#212");});
    $('.fButton').each(function(i,item){style(item,"backgroundColor","#ddd");});
    $('.fButton').each(function(i,item){style(item,"border","1px solid #eee");});
		right_panel.style.opacity="1";
};
function darker2(){
		img_panel.style.backgroundColor=comments_panel.style.backgroundColor=right_panel.style.backgroundColor="rgba(255,255,255,0.2)";
		photo_view.style.backgroundColor="transparent";//rgba(240,246,245,1)";//"rgba(248,248,248,0.999)";
		comment_area.style.backgroundColor=comment_author.style.backgroundColor="rgba(100,100,100,0.1)";
		comment_area.style.color=comment_author.style.color="#888";
    $('.fButton').each(function(i,item){style(item,"color","#ccc");});
    $('.fButton').each(function(i,item){style(item,"backgroundColor","#333");});
    $('.fButton').each(function(i,item){style(item,"border","1px solid #111");});
  };
function darker3(){
		img_panel.style.backgroundColor=comments_panel.style.backgroundColor=right_panel.style.backgroundColor="#040404";
		photo_view.style.backgroundColor="transparent";//rgba(240,246,245,1)";//"rgba(248,248,248,0.999)";
		comment_area.style.backgroundColor=comment_author.style.backgroundColor="rgba(3,4,3,0.01)";
		comment_area.style.color=comment_author.style.color="#888";
    $('.fButton').each(function(i,item){style(item,"color","#ccc");});
    $('.fButton').each(function(i,item){style(item,"backgroundColor","#333");});
    $('.fButton').each(function(i,item){style(item,"border","1px solid #222");});
		left_panel.style.borderRight="1px solid #111";
  }

var darkerFun=function(c){
	darkFlag=(darkFlag+c+4)%4;
  darkFlag=darkFlag%4;
  if(darkFlag<2){
    ph_lst.style.background="rgba(255,255,255,1)";
    img_table.style.backgroundImage="url(imgbg)";
    img_table.style.borderColor="white";
    // ph_lst.style.background="rgba(253,255,254,0.1)";
    // header.style.background="rgb(4, 177, 204)";//rgba(253,255,254,0.5)";
  }
  else{
    // ph_lst.style.backgroundColor="#111";
    // ph_lst.style.background="rgba(253,255,254,0.1)";
    ph_lst.style.background="rgba(0,0,0,0.5)";//rgba(255,254,255,0.5)";
    img_table.style.backgroundImage="";
    img_table.style.borderColor="rgba(0,0,0,0.03)";
    // header.style.background="#181818";
  }
	if(darkFlag%4==0){
    darker0();
	}else if(darkFlag%4==1){
    darker1();
	}else if(darkFlag%4==2){
    darker2();
	}else if(darkFlag%4==3){
    darker3();
	}
  darker.innerText=""+darks[darkFlag%4];
};
darkerFun(0);

var toggleMenus=function(){
  s=album_menu.style.display;
  if(s=="none"){
    album_menu.style.display="block";
  }else{
    album_menu.style.display="none";
  }
};
var togglePhlst=function(){
  s=ph_lst.style.display;
  if(s=="none"){
    ph_lst.style.display="block";
  }else{
    ph_lst.style.display="none";
  }
};
//////////////////////////////////////////////////////////////
//score
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
function submitAdvice(advice){
  advice=encodeURIComponent(advice);
  $.post("advice.php?advice="+advice,function(data){
    alert("您的意见已经被收录，谢谢您的支持:"+data);
  },"text");
	return;
}
///////////////////////////////////////////////////////////////////
//descripttion of img
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

///////////////////////////////////////////////////////////
var comEnabled=true;
var zoom=1.75;
var biggerFun=function(){
  cur=zoom;
  if(cur==""||cur==undefined) cur=1;
  if(cur>=5) return; 
  if(cur>=2) cur+=0.5;
  else cur+=0.25;
  zoom=cur;
  zoomer.innerHTML=""+zoom*100+"%";
  loadImg(img.alt);
};
var smallerFun=function(){
  cur=zoom;
  if(cur==""||cur==undefined) cur=1;
  if(cur>3) cur-=2;
  else if(cur>1) cur-=0.5;
  else if(cur<=0.25){
    if(cur<=0.125)
      return; 
    cur=0.125;
  }
  else cur-=0.25;
  zoom=cur;
  zoomer.innerHTML=""+zoom*100+"%";
  loadImg(img.alt);
};

////////////////////////////////////////////////////
//init dir
var allItems={};
var items;
var dirInited=false;
var initDir=function(callback){
  console.log("initDir:"+dirInited);
  //restore img size
  //
  // zoom=1.75;
  // if(typeof(waterfallLastID)!=undefined) 
  waterfallLastID=0;
  zoomer.innerHTML=""+zoom*100+"%";
  album.value=curDir;
  body.scrollTop=scrolltop=0;

  if(allItems[curDir]!=null) {
    items=allItems[curDir];
    dirInited=true;
    loadLst();
    loadRightLst();
    callback();
    return;
  }
  dirInited=false;

  items=null;
  $.get('more.php?dir='+curDir,
      function(data){
        //console.log(data.items);
        allItems[curDir]=items=data.items;
        dirInited=true;
        console.log("dir inited");
        loadLst();
        loadRightLst();
        callback();
      },'json');
};

/////////////////////////////////////////////////////////////////////
//load img
String.prototype.endWith=function(str){
  if(str==null||str==""||this.length==0||str.length>this.length)
    return false;
  if(this.substring(this.length-str.length)==str)
    return true;
  else
    return false;
  return true;
}
function guiyi(h){
  t=(h/10)+1;
  t=t>10?10:t;
  t=t<7?7:t;
  return t*10;
}
var loadImg=function(id){
  if(id<0||id>=items.length) return;
  body.scrollTop=0;
  img.alt=id;
  item=items[img.alt];
  //console.log(item.ref);
  if(item.ref.endWith(".swf")){
    img_table.style.height=""+screen.availHeight*0.80+"px"; 
    img_panel.style.height="";//+screen.availHeight*0.85+"px"; 
    img.style.display="none";
    
    if(contains(item.ref,"http")){
      movie.style.height="95%";
      movie.src=item.ref;
      flash.style.height="0%";
      flash.src="";
    }
    else{
      movie.style.height="0%";
      movie.src="";
      flash.style.height="95%";
      flash.src=item.ref;
    }
    img_desp.innerText=item.desp;
    img_desp.href=item.ref;
    setTimeout(function(){
      movie_div.style.display="none";
      setTimeout(function(){
        movie_div.style.display="block";
      },
      100);
    },10);
  }else{
    img_table.style.height="100%";
    img_panel.style.height="";
    img.style.opacity="0.1";
    img.style.display="block";
    img.src="view/"+curDir+"/"+item.href;
    img_desp.innerText=item.desp;
    img_desp.href=item.ref;
    //@changed 被minHeight=screen.height*0.5取代
    img_panel.style.height="90%"; 
    var k=screen.width/screen.height;
    oImg.href="DATASET/"+curDir+"/"+item.href;
    var h,w;
    var n=item.height/item.width;
    w=96*item.width/screen.width;
    w=zoom*w>96?96:zoom*w;
    h=(n*k)*w;
    h=guiyi(h);

    //手动调节marginTop/Left可能会画面不自然
    //if(h<85) h=guiyi(h+4);
    // img.style.marginLeft=""+(100-w)/2+"%";

    //img_table高度
    //注意img_table使得img_div竖直方向居中
    // img_div.style.height=""+h+"%"; 

    //避免直接修改Img的width，否则容易画面抖动
    //img_div在img_table中水平居中
    w1=guiyi(w);
    // photo_view.style.width=""+w1*0.80+"%";
    // photo_view.style.marginLeft=""+(100-w1*0.80)/2+"%";

    img.style.width=""+100*(w/w1)+"%"; 

    movie_div.style.display="none";
    setTimeout(function(){img.style.opacity="1"},0);
    // photo_view.style.opacity="1";
  }
  // photo_view.scrollTop=0;
  //since get comment must be called when comEnabled and img.alt changed
  //if(comEnabled) 
  getCom();
  updateRightLst(id);
  updatePhLst(id);

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
  console.log(com);
  if(contains(com,"\'")||contains(com,"$")) {
    alert("含有不合法字符\'%或$");
    return;
  }
  // com.replace("\n","     ");
  // com=encodeURIComponent(com);
  console.log(com);
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
          content=content.replace(new RegExp("\n","gm"),"<br/>");
          if(author==undefined||author=="") author="路人甲";
          comments_div.innerHTML+='<div id="comment_span" style="border:0px solid #fff;display:block;float:left;border-bottom:1px solid rgba(128,128,128,0.1);padding-top:2px;width:99%;font-size:80%;background:transparent;">'+'<span id="author">'+author+':   </span><span style="font-size:140%;color:rgba(80,80,80,0.7);text-decoration:none;">'+content+'</span><a onclick="delCom(\''+comment+'\')" style="display:block;float:right;background:transparent;color:rgba(120,120,120,0.3);border:1px solid rgba(128,128,128,0.2);font-size:70%;margin-top:-1px;"> 删除</a></div>';
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
  auto_play.innerText="自动播放";
  window.clearInterval(autoPlayInterval);
  autoPlayInterval="";
  return;
};
var toggleAutoPlay=function(){
  if(autoPlayInterval!="") {
    stopAutoPlay();
    return;
  }
  autoPlayInterval=setInterval(function(){
    if(photo_view.style.display!="block") 
    stopAutoPlay();
    else nextFun();
  },3000);
  auto_play.innerText="停止放映";
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

////////////////////////////////////////////////////////////////
//init waterfall
var colNum=4;
var waterfall=new MyWaterfall(dir,colNum);
var setDir=function(dir){
	togglePhotoView(-1);
  if(curDir==dir) return;
	curDir=dir;
	// waterfall=new MyWaterfall(dir,colNum);
  initDir(function(){
	if(waterfall!=undefined&&waterfall!=null) 
  {
    waterfall.refresh();
  }
  });
};
initDir(function(){});
//////////////////////////////////////////////////////////////
//init colNum select DomElement
selects.onclick=function(){
  if(colNum==this.value) return;
	colNum=this.value;
	waterfall.refresh(colNum);
}
