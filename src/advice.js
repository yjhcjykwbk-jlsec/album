function submitAdvice(advice){
  advice=encodeURIComponent(advice);
  $.post("advice.php?advice="+advice,function(data){
    alert("您的意见已经被收录，谢谢您的支持:"+data);
  },"text");
	return;
}
