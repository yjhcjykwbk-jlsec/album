
var comEnabled=true;
var zoom=1;
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
  else if(cur<=0.25) return; 
  else cur-=0.25;
  zoom=cur;
  zoomer.innerHTML=""+zoom*100+"%";
  loadImg(img.alt);
};
var allItems={};
var items;
var dirInited=false;
var initDir=function(){
  //restore img size
  zoom=1;
  zoomer.innerHTML="100%";
  album.value=curDir;

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
function guiyi(h){
  t=(h/10)+1;
  t=t>10?10:t;
  t=t<9?9:t;
  return t*10;
}
var loadImg=function(id){
  if(id<0||id>=items.length) return;
  img.alt=id;
  item=items[img.alt];
  //console.log(item.ref);
  if(item.ref.endWith(".swf")){
    // photo_view.style.width="80%";
    // photo_view.style.marginLeft="10%";
    // photo_view.style.height="90%";
    // photo_view.style.marginTop="0.3%";
    movie.src=item.ref;
    img_div.style.display="none";
   // img_table.style.height="100%"; 
    setTimeout(function(){
      movie.style.display="none";
      setTimeout(function(){
        movie.style.display="block";
      },
      100);
    },10);
  }else{
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
    img_div.style.height=""+h+"%"; 

    //避免直接修改Img的width，否则容易画面抖动
    //img_div在img_table中水平居中
    img_div.style.width=""+w+"%";

    img.src="view/"+curDir+"/"+item.href;
    img_div.style.display="block";
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
  console.log(com);
  if(contains(com,"\'")||contains(com,"$")) {
    alert("含有不合法字符\'%或$");
    return;
  }
  com.replace("\n","     ");
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
          if(author==undefined||author=="") author="路人甲";
          comments_div.innerHTML+='<div id="comment_span" style="border:0px solid #fff;display:block;float:left;border-bottom:1px solid rgba(128,128,128,0.1);padding-top:2px;width:99%;font-size:80%;background:transparent;">'+'<span id="author">'+author+':   </span><span style="font-size:140%;color:#444;text-decoration:none;">'+content+'</span><a onclick="delCom(\''+comment+'\')" style="display:block;float:right;background:transparent;border:1px solid rgba(128,128,128,0.2);font-size:70%;margin-top:-1px;"> 删除</a></div>';
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
