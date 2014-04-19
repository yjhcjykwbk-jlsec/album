<style>
#ph_lst div{
	//background:#000;
	// margin-left:0.16%;
	margin-right:5%;
	float:left;
	margin-top:8%;
	margin-bottom:2%;
}
#ph_lst img{
	display:block;
	margin-left:auto;
	margin-right:auto;
	padding:3px;
}
</style>
<div id="ph_lst" style="overflow-y:scroll;overflow-x:hidden;display:none;box-shadow:0px -5px 10px 3px rgba(255,255,255,0.4);background:rgba(0,0,0,0.9);width:4.5%;right:0.8%;z-index:101;position:fixed;bottom:0px;height:95%;">
</div>
<script>
function loadLst(){
	var img_div=$('#ph_lst');
	console.log(img_div);
	window.sss=img_div;
	img_div.empty();
	for(var i=0;i<items.length;i++){
		var img=$('<div style="height:8%;width:100%;"><img alt="" src="" style="max-width:98%;min-width:60%;max-height:100%;min-height:50%;" src="" onclick="s=this.alt;loadImg(s);"></img></div>');
		img.appendTo(img_div);
	}
	var imgs=$('#ph_lst img');
	for(var i=0;i<items.length;i++){
		var item=items[i];
		img=imgs[i];
		img.setAttribute("src",item.src);
		img.setAttribute("alt",i);
		// if(i==id) img.style.border="1px solid red";
	}
}
var old=-1;
function updateLst(cur){
	var imgs=$('#ph_lst img');
	if(imgs[old]!=undefined)
		imgs[old].style.border="";
	if(imgs[cur]!=undefined)
		imgs[cur].style.border="1px solid red";
	old=cur;
}
function showPhLst(){
	ph_lst.style.display="block";
}
function hidePhLst(){
	ph_lst.style.display="none";
}
</script>

