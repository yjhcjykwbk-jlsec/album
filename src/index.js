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
            item.href=decodeURIComponent(item.href);
            item.desp=decodeURIComponent(item.desp);
            item.ref=decodeURIComponent(item.ref);
            if(inserted.hasOwnProperty(''+item.id)) return;
            isMovie=item.ref.endWith(".swf");
            res.push(
              '<div class="item masonry_brick masonry-brick" style="background:rgba(255,255,255,0.1);position: absolute; top: 0px; left: 0px;">'+
              '<div class="item_t">'+ 
              // '<div class="img">'+// style="background:#000"> '+
              '<a onclick="togglePhotoView('+item.id+');return false;" href="photo.php?dir='+dir+'&id='+item.id+'&img='+item.href+'">'+  //target="__blank'+i
              '<img  width="'+240+'" height="'+item.height/item.width*240+'" src="'+item.src+'" data-pinit="registered">'+
              '</a> '+
              '<div class="class" style="color:#fff;opacity:0.2;padding:5px;margin-bottom:1px;font-size:80%;margin-left:0px;margin-top:-25px;">'+item.href.split('.')[0].substring(0,20)+'</div> '+
              '</div> '+
              '<div class="desp" style="background:rgba(255,255,255,0.7);color:#444;padding:3px;border-bottom:1px solid '+(isMovie?'red':'rgba(100,100,100,0.1)')+';">'+
              (item.desp!=""?item.desp+
                '<button onclick="changeDespForm(this,'+'\''+dir+'\',\''+item.href+'\',\''+item.desp+'\',\''+item.ref+'\');" style="background:transparent;border:0;color:#aaa">修改</button>'
                :'<button onclick="showDespForm(this,'+'\''+dir+'\',\''+item.href+'\');" style="background:transparent;border:1px solid rgba(220,220,220,0.05);color:rgba(160,160,160,0.5)">添加描述</button>')+'</div>'+
              '<div class="ref" style="color:#9E7E6B;background:rgba(200,200,200,0.1);padding:5px;">引用自<a href="'+item.ref+'">'+item.ref.substring(0,25)+'..</a></div> '+
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
      { container: $('#container'), colWidth: 240, maxCol: colNum,preDistance: 0,
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

