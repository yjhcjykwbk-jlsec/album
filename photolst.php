<style>
#ph_lst div{
  //background:#000;
  margin-left:0.25%;
  float:left;
  // margin-top:0.9%;
}
#ph_lst img{
  display:block;
  margin-left:auto;
  margin-right:auto;
}
</style>
<div id="ph_lst" style="opacity:0.7;display:none;box-shadow:0px -5px 10px 3px rgba(128,128,128,0.1);background:rgba(0,0,0,0.08);width:70%;left:18.5%;z-index:101;position:fixed;bottom:0px;height:5.5%;">
      <div style="height:90%;width:4%;">
<img alt="-10" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4%;">
<img alt="-9" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4%;">
<img alt="-8" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4%;">
<img alt="-7" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4%;">
<img alt="-6" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>

</div><div style="height:90%;width:6%;">
<img alt="0" style="border:1px solid red;max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>

</div><div style="height:90%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:5%;">
<img alt="4" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4%;">
<img alt="7" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4%;">
<img alt="9" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4%;">
<img alt="10" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
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
// temp();
function loadLst(id){
  console.log(id);
  var imgs=$('#ph_lst img');
  for(var i=id-10;i<=id-(-10);i++){
    var img=imgs[i-id-(-10)];
    img.setAttribute("alt",i);
    if(i<0||i>=items.length) {
      img.setAttribute("src","black.jpg");
      continue;
    }
    var item=items[i];
    img.setAttribute("src",item.src);
    if(i==id) img.style.backgroundColor="red";
  }
}
function showPhLst(){
  ph_lst.style.display="block";
}
function hidePhLst(){
  ph_lst.style.display="none";
}
</script>

