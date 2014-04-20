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
<div id="ph_lst" style="overflow-y:overlay;opacity:0.7;display:none;box-shadow:0px -5px 10px 3px rgba(128,128,128,0.1);background:rgba(0,0,0,0.08);width:6%;right:0.0%;z-index:101;position:fixed;bottom:0px;height:95%;">
      <div style="width:90%;height:8%;">
<img alt="-10" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="-9" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="-8" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="-7" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="-6" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="0" style="border:1px solid red;max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="4" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="7" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="9" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="width:90%;height:8%;">
<img alt="10" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div>
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
function loadLst(id){
  console.log(id);
  var j=id-10>0?id-10:0;
  var img_div=$("#ph_lst");
  if(items==undefined) return;
  img_div.empty();
  for(i=0;i<items.length;i++){
    var img=$('<div style="width:90%;height:8%;"><img alt="10" style="max-width:65%;min-width:50%;max-height:100%;min-height:80%;" src="" onclick="s=this.alt;loadImg(s);"></img></div>');
    img.appendTo(img_div);
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
function updateLst(id){
  var imgs=$('#ph_lst img');
  if(imgs[old]!=undefined) imgs[old].style.border="0";
  if(imgs[id]!=undefined) {
    imgs[id].style.border="1px solid red";
    ph_lst.scrollTop=imgs[id].offsetTop-350;
  }
  old=id;
}
function showPhLst(){
  ph_lst.style.display="block";
}
function hidePhLst(){
  ph_lst.style.display="none";
}
</script>

