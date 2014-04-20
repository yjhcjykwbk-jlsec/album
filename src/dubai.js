setTimeout(function(){
	chengxuyuan.style.right="40%";
	chengxuyuan.style.bottom="50%";
	chengxuyuan.style.width="200px";
	chengxuyuan.style.display="block";
	chengxuyuan.style.backgroundColor="#eee";
	setTimeout(function(){
		chengxuyuan.style.right="0px";
		chengxuyuan.style.bottom="-15px";
		chengxuyuan.style.width="80px";
		yuanIntro.innerHTML="hello world!<br/>any question<br/>click me!";
		yuanIntro.style.display="block";
	},2000);
},1000);
var chengxuyuanGoDie=function(){
	chengxuyuan.style.display="none";
	dubaiFlag=4;
	setTimeout(dubaijun,1000);
};
var _right=200;
var _top=200;
var rand=function(s){
	return Math.floor(Math.random()*s);
};
var randomMessagePos=function(){
/*	_left+=((Math.ceil(Math.random()*9)-3)*20);
_top+=((Math.ceil(Math.random()*9)-5)*20);
 */
	message.style.color="rgb("+rand(150)+","+rand(150)+","+rand(150)+")";
};
var dubaiFuns=function(){
	s0=function(){
		message.style.display="block";
		randomMessagePos();
		message_content.innerHTML="您造吗？鼠标快捷键ctrl+(上下左右)可以快速浏览滚动以及缩放，点击灯光或pageup/down切换不同显示效果,enter留言!赶快试试吧!";
    end.style.opacity="0.05";
		message_pre_content.innerHTML="";
	};
	s1=function(){	
		message.style.display="block";
		randomMessagePos();
		message_content.innerHTML="说完这些，本码农就要水论文去了。。代码容易，论文不易，且水且珍惜T T";
		message_pre_content.innerHTML="";
	};
	s2=function(){
		message.style.display="block";
		randomMessagePos();
		message_content.innerHTML="@_@~机器学习，svm，算法，MSER..@#@#@#!@%$@#!语言乱码中，请勿扰...";
		message_pre_content.innerHTML="";
	};
	s3=function(){	
		message.style.display="block";
		randomMessagePos();
		message_content.innerHTML="";
		message_pre_content.innerHTML=
			"for(;;){ \n"+
			"	if(!i.isWateringCode())\n"+
			"		i.water(article);\n"+
			"}";
	};
	die=function(){
		message.style.display="block";
		randomMessagePos();
		message_content.innerHTML="";
    message_pre_content.innerHTML=""+
      "//本人已葬身终南山下，有事烧纸...\n"+
      "i.am.died.in.extremal.south.moutain();\n"+
      "exit();\n"+
      "\n"
      ;
	};
	return [s0,s1,s2,s3,die];
}();
var lastMsgTime=0;
var curTime=function(){
	return new Date().getSeconds();
};
var endFun=function(){
	if(curTime()-lastMsgTime>1){
		message.style.display="none";
	}
}	
var dubaiFlag=0;
var dubaijun=function(){
	lastMsgTime=curTime();
	dubaiFuns[dubaiFlag]();
	setTimeout(endFun,3000);
	dubaiFlag=(dubaiFlag+rand(2)+1)%4;
};
