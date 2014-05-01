function getRandom(min,max){//return [min,max)
  return Math.floor(Math.random()*(max-min)+min);
}
var rand=function(s){
	return Math.floor(Math.random()*s);
};
var waterfallLastID=0;
function MyWaterfall(dir,colNum){ // console.log("waterfall:"); 
  // 测试用技术器 // 调用瀑布流 
  var n = 0; var m = 0; 
  $('#end').css("opacity","0.01");//hide();
  var mwf=this;
  var inserted=[];
  this.insertImgs=function(waterfall,imgItems){
    if(typeof(waterfallLoadable)!=undefined&&waterfallLoadable==false){
      console.log("MyWaterfall.insertImgs:cannot load");
      return;
    }
    var res = [];
    if(imgItems.length==0){
      waterfall.end();		 // 终止滚动load
      $('#end').css("opacity","1");
      // $('#end').show();
    }
    else{
      $.each(imgItems, 
          function(i, item){
            // console.log("waterfall:");
            item.href=decodeURIComponent(item.href);
            item.desp=decodeURIComponent(item.desp);
            item.ref=decodeURIComponent(item.ref);
            k=item.height/item.width;
            k=k>1.5?1.5:k;
            if(inserted.hasOwnProperty(''+item.id)) return;
            isMovie=item.ref.endWith(".swf");
            res.push(
              '<div class="item masonry_brick masonry-brick" style="background:rgba(255,255,255,0.1);position: absolute; top: 0px; left: 0px;">'+
              '<div class="item_t">'+ 
              // '<div class="img">'+// style="background:#000"> '+
              '<a onclick="togglePhotoView('+item.id+');return false;" href="photo.php?dir='+dir+'&id='+item.id+'&img='+item.href+'">'+  //target="__blank'+i
              '<img  width="'+210+'" height="'+(item.height/item.width*210+rand(30))+'" oncontextmenu="$(this).contextMenu(\'menu\',menuAdapter);" src="'+item.src+'" data-pinit="registered">'+
              '</a> '+
              '<div class="class" style="color:#fff;opacity:0.2;padding:5px;margin-bottom:1px;font-size:80%;margin-left:0px;margin-top:-25px;">'+item.href.split('.')[0].substring(0,20)+'</div> '+
              '</div> '+
              '<div class="desp" style="background:rgba(255,255,255,0.9);color:#444;padding:6px;padding-top:'+(k*12)+'px;padding-bottom:'+(k*2)+'px;border-bottom:'+';">'+
              (item.desp!=""?item.desp+
                '<button onclick="changeDespForm(this,'+'\''+dir+'\',\''+item.href+'\',\''+item.desp+'\',\''+item.ref+'\');" style="background:transparent;border:0;color:#aaa">修改</button>'
                :'<button onclick="showDespForm(this,'+'\''+dir+'\',\''+item.href+'\');" style="background:transparent;border:1px solid rgba(220,220,220,0.05);color:rgba(160,160,160,0.5)">添加描述......</button>')+'</div>'+
                          '<div class="item_b clearfix" style="padding-bottom:10px;border-bottom:1px dotted '+(isMovie?'rgba(200,10,100,0.2)':'rgba(50,50,50,0.1)')+';"> '+
                          '<div class="items_likes fl" style="height:0px"> '+
                          '<em class="bold" style="background:#ff74a1;color:white;padding:1px 14px lpx 14px;">0赞</em> '+
                          '</div> '+
                          '<div class="items_comment fr">'+
                  '<a>评论</a>'+
                  '<em class="bold">(0)</em>'+
                  '</div> '+
                          '</div> '+
              '<div class="ref" style="color:#9E7E6B;background:#fcfcfc;padding-left:7px;padding-bottom:'+(k*17)+'px;padding-top:'+(k*10)+'px;font-size:80%;">引用自<br><a href="'+item.ref+'" style="padding-left:6px;color:#888">'+item.ref.substring(0,25)+'..</a></div> '+
              //   '</div> '+
              '</div>');
            inserted[item.id+'']=true;
          });
    }
    waterfall.success(res);
  };
  this.wf = new Waterfall(
      { container: $('#container'), colWidth: 210, maxCol: colNum,preDistance: 0,
        load: function(){
          // if(waterfallLoadable!=undefined&&waterfallLoadable==false) return;
          // 触发滚动加载时的具体操作
          // 当前作用域下，this指向正创建的对象
          // console.log('..load');
          //m is the start of image num
          var self = this;
          var imgItems=[];
          if(m<waterfallLastID) return;
          if(items!=null){
            data=[];
            console.log("pushing:"+m+":"+items.length);
            num=6;
            if(waterfallLastID==0)  num=20;
            for(i=m;i<m+num&&i<items.length;i++){
              data.push(items[i]); 
            }
            m=i;
            mwf.insertImgs(self,data);
          }
          else
          $.get('more.php?m='+m+"&dir="+dir, function(data) {
            //console.log("get imgs from m:"+m+" to..");
            //记录刷新次数
            if(dir!=curDir) return;//失效的数据
            n++;
            m+= data.items.length;

            mwf.insertImgs(self,data.items);

            //添加右键菜单
            //change to add inside img
            // $('div.item img').each(function(){
              // $(this).contextMenu('menu',menuAdapter);
            // });
          }, 'json');
          waterfallLastID=m;
        }
      });

  this.refresh=function(colNum){
    m=0;
    console.log("refresh waterfall");
    waterfallLastID=0;
    inserted=[];
    n=0;
    this.wf.refresh({maxCol:colNum});
  };
  // this.clear=function(){
    // this.wf.clear();
  // };
}



//右键菜单 删除图片
function getImg(img){
  href.location="photo.php?dir="+dir+"img="+img;
}
function delImg(element,img){
  if(!confirm("您真的要删除图片"+curDir+"/"+img+"吗?")) return;
  $.ajax({
    url:"img_js.php", 
    data:"action=del&class="+curDir+"&img="+img, type:'post', dataType:'text', 
    success:function(result){
      // alert(result);
      element.src="";
    }
  });
};
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
        if(ss.length<6) {
          alert("解析图片地址出错");
          return;
        }
        if(ss.length==6){
          img=ss[5];
        }
        else img=ss[6];
        delImg(t,img);
      }
  }, 
  onShowMenu: function(e, menu) { 
    return menu; 
  } 
};

