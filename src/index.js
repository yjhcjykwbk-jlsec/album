function getRandom(min,max){//return [min,max)
	return Math.floor(Math.random()*(max-min)+min);
}

function MyWaterfall(dir,colNum){ // console.log("waterfall:"); 
	// 测试用技术器 // 调用瀑布流 
	var n = 0; var m = 0; 
	$('#end').hide();
	var mwf=this;
	var inserted=[];
	this.insertImgs=function(waterfall,imgItems){
		var res = [];
		if(imgItems.length==0){
			waterfall.end();		 // 终止滚动load
			$('#end').show();
		}
		else{
			$.each(imgItems, 
					function(i, item){
					// console.log("waterfall:");
					if(inserted.hasOwnProperty(''+item.id)) return;
					res.push(
						'<div class="item masonry_brick masonry-brick" style="background:#fff;position: absolute; top: 0px; left: 0px;">'+
						'<div class="item_t">'+ 
						// '<div class="img">'+// style="background:#000"> '+
						'<a onclick="togglePhotoView('+item.id+');return false;" href="photo.php?dir='+dir+'&id='+item.id+'&img='+item.href+'">'+  //target="__blank'+i
						'<img  width="'+230+'" height="'+item.height/item.width*230+'" src="'+item.src+'" data-pinit="registered">'+
						'</a> '+
						    '<div class="class" style="color:#444;padding:5px;margin-top:1px;margin-left:5px;">'+item.href.split('.')[0].substring(0,30)+'</div> '+
						'</div> '+
												     '<div class="desp" style="color:#aaa;padding:10px;border-top:1px solid #eee;"><span>219.223.195.113/'+item.src.substring(0,10)+'</span></div> '+
						//   '</div> '+
						//						'<div class="item_b clearfix"> '+
						//						'<div class="items_likes fl" style="height:0px"> '+
						//						'<em class="bold">0赞</em> '+
						//						'</div> '+
						//				//		'<div class="items_comment fr">'+
						//		'<a>评论</a>'+
						//		'<em class="bold">(0)</em>'+
						//		'</div> '+
						//						'</div> '+
						'</div>');
					inserted[item.id+'']=true;
					});
		}
		waterfall.success(res);
	};
	this.wf = new Waterfall(
			{ container: $('#container'), colWidth: 230, maxCol: colNum,preDistance: 0,
load: function(){
// 触发滚动加载时的具体操作
// 当前作用域下，this指向正创建的对象
// console.log('..load');
//m is the start of image num
var self = this;
var imgItems=[];

$.get('more.php?m='+m+"&dir="+dir, function(data) {
	//console.log("get imgs from m:"+m+" to..");
	//记录刷新次数
	if(dir!=curDir) return;//失效的数据
	n++;
	m+= data.items.length;

	mwf.insertImgs(self,data.items);

	//添加右键菜单
	//		     $('div.item img').each(function(){
	//				     $(this).contextMenu('menu',menuAdapter);
	//				     });
	}, 'json');
}
});

this.refresh=function(colNum){
	m=0;
	inserted=[];
	n=0;
	this.wf.refresh({maxCol:colNum});
};
this.clear=function(){
	this.wf.clear();
};
}


//右键菜单 删除图片
function getImg(img){
	href.location="photo.php?dir="+dir+"img="+img;
}
function delImg(element,img){
	if(!confirm("您真的要删除图片"+img+"吗?")) return;
	$.ajax({
url:"img_js.php", 
data:"action=delImg&img="+img, type:'get', dataType:'text', 
success:function(result){
if(result=="true"){
alert("图片已经被删除");
element.src="";
}
else alert(result);
}
});
}
var menuAdapter={
	//菜单样式
menuStyle: {
border: '2px solid #000'
	   },
	   //菜单项样式
itemStyle: {
fontFamily : 'verdana',
	     font: '12px',
	     backgroundColor : 'white',
	     color: 'black',
	     border: 'none',
	     padding: '1px'
	   },
	   //菜单项鼠标放在上面样式
itemHoverStyle: {
color: 'blue',
       backgroundColor: 'red',
       border: 'none'
		},
bindings: 
		{ 
			'del': 
				function(t, target) { 
					var str=t.src;
					ss=str.split('/');
					if(ss.length<7) {
						alert("解析图片地址出错");
						return;
					}
					img=ss[5]+'/'+ss[6];
					delImg(t,img);
				}
		}, 
onShowMenu: function(e, menu) { 
		    return menu; 
	    } 
};

