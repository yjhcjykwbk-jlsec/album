<style>
#ph_lst div{
  //background:#000;
  margin-bottom:12%;
  float:right;
  // margin-top:0.9%;
}
#ph_lst img{
  display:block;
  margin-left:auto;
  margin-right:auto;
}
</style>
<div id="ph_lst" style="overflow-y:overlay;opacity:;display:none;box-shadow:-1px 0px 2px 1px rgba(250,250,250,0.2);border:0px solid rgba(120,120,120,0.5); background:;width:7%;right:0.0%;z-index:90;top:0%;padding-top:25px;position:fixed;bottom:0px;height:98%;">
</div>
<script>
function temp(){
  var imgs=$('#ph_lst img');
  for(var i=-10;i<=10;i++){
    var s=2*i;
    s=s<0?0-s:s;
    imgs[i+7].style.marginTop=""+(s+5)+'%';
    imgs[i+7].style.height=""+(88-2*s)+'%';
    console.log('"'+s+'%"');
  }
}
var lstFlag="";
function loadLst(){
  if(curDir==lstFlag) return;
  lsgFlag=curDir;
  var img_div=$("#ph_lst");
  img_div.empty();
  if(items==undefined) return;
  for(i=0;i<items.length;i++){
    var img=$('<div style="width:90%;height:8%;"><img alt="10" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img></div>');
    img_div.append(img);
  }
  var imgs=$('#ph_lst img');
  for(i=0;i<=items.length;i++){
    var img=imgs[i];
    if(img==undefined||img==null) {
      continue;
    }
    img.setAttribute("alt",i);
    img.style.display="block";
    var item=items[i];
    img.setAttribute("src",item.src);
  }
}
var old=-1;
function updatePhLst(id){
  loadLst();
  var imgs=$('#ph_lst img');
  if(imgs[old]!=undefined) imgs[old].style.border="0";
  if(imgs[id]!=undefined) {
    imgs[id].style.border="1px solid red";
    ph_lst.scrollTop=imgs[id].offsetTop-350;
  }
  old=id;
}
function showPhLst(){
  loadLst();
  ph_lst.style.display="block";
}
function hidePhLst(){
  ph_lst.style.display="none";
}
</script>

