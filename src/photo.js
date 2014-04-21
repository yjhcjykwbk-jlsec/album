
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
  img.style.zoom="2";
  zoomer.innerHTML="800%";

  if(allItems[curDir]!=null) {
    items=allItems[curDir];
    dirInited=true;
    loadLst();
    return;
  }
  dirInited=false;

  items=null;
  $.get('more.php?dir='+curDir,
      function(data){
        //console.log(data.items);
        allItems[curDir]=items=data.items;
        loadLst();
        dirInited=true;
        loadLst();
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
function guiyi(w){
  if(w>70) return 90;
   return 75;
}
var loadImg=function(id){
  if(id<0||id>=items.length) return;
  img.alt=id;
  item=items[img.alt];
  //console.log(item.ref);
  if(item.ref.endWith(".swf")){
    photo_view.style.width="80%";
    photo_view.style.marginLeft="10%";
    // photo_view.style.height="90%";
    // photo_view.style.marginTop="0.3%";
    movie.src=item.ref;
    img_table.style.display="none";
    setTimeout(function(){
      movie.style.display="none";
      setTimeout(function(){
        movie.style.display="block";
      },
      100);
    },10);
    //movie.style.display="block";
  }else{
    var k=screen.width/screen.height;
    oImg.href="DATASET/"+curDir+"/"+item.href;
    // img.style.display="none";
    var h,w;
    var n=item.height/item.width;
    //adjust size
    // if(item.width<screen.width/2&&item.height<screen.height/2){
      // item.width=screen.width/2;
      // item.height=n*item.width;
    // }
    if(item.width>screen.width){//w<=90
      w=90;
      h=(n*k)*90;
    }
    else{
      //cal width
      w=90*item.width/screen.width;
      w=guiyi(w);
      h=(n*k)*w; 
    }
    // console.log("original width:"+item.width+",height:"+item.height);
    // console.log("display  width:"+w+"%,height:"+h+"%");
    photo_view.style.width=""+(w/1.1)+"%";
    photo_view.style.marginLeft=""+(100-w/1.1)/2+"%";

    if(h<70){
        photo_view.style.height=""+h+"%"; 
        photo_view.style.marginTop=""+(94-h)/4+"%"; 
    }
    else{
        photo_view.style.height="94%"; 
        photo_view.style.marginTop="-0.2%";
    }
    // img.style.minHeight=""+(h/1.1)+"%";
    //
    // @changed
    // if(h>70)
    // img.style.marginTop=h/1.1>86?"0.2%":""+(86-h/1.1)/2+"%";
    // else img.style.marginTop="";
    // if(h<75)
      // img.style.marginTop=""+(100-h)/2.5-10+"%";
    // else 
      // img.style.marginTop="0.5%";
    img.src="view/"+curDir+"/"+item.href;
    img_table.style.display="block";
    movie.style.display="none";
  }
  photo_view.scrollTop=0;
  //since get comment must be called when comEnabled and img.alt changed
  //if(comEnabled) 
  getCom();
  updateLst(id);

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
          comments_div.innerHTML+='<div id="comment_span" style="border:0px solid #fff;display:block;float:left;border-bottom:1px solid rgba(230,230,230,0.3);padding-top:2px;width:99%;font-size:80%;background:transparent;">'+'<span id="author">'+author+':   </span><span style="font-size:140%;color:#444;text-decoration:none;">'+content+'</span><a onclick="delCom(\''+comment+'\')" style="display:block;float:right;background:transparent;border:1px solid rgba(128,128,128,0.2);font-size:70%;margin-top:-1px;"> 删除</a></div>';
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
