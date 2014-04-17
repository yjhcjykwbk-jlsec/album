<style>
#ph_lst div{
	//background:#000;
	margin-left:0.5%;
	float:left;
	margin-top:0.5%;
}
#ph_lst img{
	display:block;
	margin-left:auto;
	margin-right:auto;
}
</style>
<div id="ph_lst" style="background:rgba(0,0,0,0.9);width:100%;z-index:101;position:fixed;bottom:0px;height:8%;">
			<div style="height:70%;width:5%;">
<img alt="-8" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="border:1px solid red;height:70%;width:5%;">
<img alt="0" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;min-height:50%;max-width:100%;min-width:50%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;max-width:100%;min-width:40%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;max-width:100%;min-width:40%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;max-width:100%;min-width:40%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;max-width:100%;min-width:40%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;max-width:100%;min-width:40%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="" style="max-height:100%;max-width:100%;min-width:40%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div><div style="height:70%;width:5%;">
<img alt="9" style="max-height:100%;max-width:100%;min-width:40%;" src="" onclick="s=this.alt;loadImg(s);"></img>
</div>
</div>
<script>
function loadLst(id){
	console.log(id);
	var imgs=$('#ph_lst img');
	for(var i=id-8;i<=id-(-9);i++){
		var img=imgs[i-id-(-8)];
		img.setAttribute("alt",i);
		if(i<0||i>=items.length) {img.setAttribute("src","");continue;}
		var item=items[i];
		img.setAttribute("src","thumb/"+curDir+"/"+item.href);
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

