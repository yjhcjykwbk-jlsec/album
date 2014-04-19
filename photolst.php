<style>
#ph_lst div{
  //background:#000;
  margin-left:0.50%;
  float:left;
  // margin-top:0.9%;
}
#ph_lst img{
  display:block;
  margin-left:auto;
  margin-right:auto;
}
</style>
<div id="ph_lst" style="display:none;box-shadow:0px -5px 10px 3px rgba(255,255,255,0.4);background:rgba(0,0,0,0.9);width:70%;left:16.5%;z-index:101;position:fixed;bottom:0px;height:8%;">
      <div style="height:90%;width:4%;">
<img alt="-7" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4.5%;">
<img alt="-6" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:6%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:7%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:7%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:7.5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>

</div><div style="height:90%;width:9%;">
<img alt="0" style="border:1px solid red;max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>

</div><div style="height:90%;width:7.5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:7%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:7%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:6%;">
<img alt="4" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:5%;">
<img alt="" style="max-height:100%;max-width:100%;min-width:40%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4.5%;">
<img alt="6" style="max-height:100%;max-width:100%;min-width:40%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:90%;width:4%;">
<img alt="7" style="max-height:100%;max-width:100%;min-width:40%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div>
</div>
<script>
function temp(){
  var imgs=$('#ph_lst img');
  for(var i=-7;i<=7;i++){
    var s=5*i;
    s=s<0?0-s:s;
    imgs[i+7].style.marginTop=""+s+'%';
    imgs[i+7].style.height=""+(100-2*s)+'%';
    console.log('"'+s+'%"');
  }
}
temp();
function loadLst(id){
  console.log(id);
  var imgs=$('#ph_lst img');
  for(var i=id-7;i<=id-(-7);i++){
    var img=imgs[i-id-(-7)];
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

