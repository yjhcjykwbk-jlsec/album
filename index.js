function MyWaterfall(dir,colNum){ // console.log("waterfall:"); 
// 测试用技术器 // 调用瀑布流 
var n = 0; var m = 0; 
$('#end').hide();
this.wf = new Waterfall(
{ container: $('#container'), colWidth: 230, maxCol: colNum,preDistance: 0,
	     load: function(){
		     // 触发滚动加载时的具体操作
		     // 当前作用域下，this指向正创建的对象
		     var self = this;
		     // console.log('..load');
		     //m is the start of image num
		     $.get('more.php?m='+m+"&dir="+dir, function(data) {
				     // console.log("m:"+m);
				     //记录刷新次数
				     if(dir!=curDir) return;//失效的数据
				     n++;
				     m+= data.items.length;

				     var res = [];
				     if(data.items.length==0){
				     self.end();		 // 终止滚动load
				     $('#end').show();
				     }
				     else
				     $.each(data.items, 
					     function(i, item){
					     // console.log("waterfall:");
					     res.push(
						     '<div class="item masonry_brick masonry-brick" style="position: absolute; top: 0px; left: 0px;">'+
						     '<div class="item_t">'+ 
						     '<div class="img"> '+
						     '<a onclick="togglePhotoView('+item.id+');return false;" href="photo.php?dir='+dir+'&id='+item.id+'&img='+item.href+'">'+  //target="__blank'+i
						     '<img width="'+220+'" height="'+item.height/item.width*220+'" src="'+item.src+'" data-pinit="registered">'+
						     '</a> '+
						     '<span class="class" color="#f0f0f0">'+item.href.substring(0,12)+'..</span> '+
						     '<div class="btns"> '+
						     '</div> '+
						     '</div> '+
//						     '<div class="desp"><span>图片还没有添加描述</span></div> '+
						     '</div> '+
						     '<div class="item_b clearfix"> '+
						     '<div class="items_likes fl">  </a> '+
						     '<em class="bold">0赞</em> '+
						     '</div> '+
						     '<div class="items_comment fr">'+
						     '<a>评论</a>'+
						     '<em class="bold">(0)</em>'+
						     '</div> '+
						     '</div> '+
						     '</div>');
					     });
		     self.success(res);

		     //添加右键菜单
//		     $('div.item img').each(function(){
//				     $(this).contextMenu('menu',menuAdapter);
//				     });
		     }, 'json');
	     }
});

this.refresh=function(colNum){
	m=0;
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

