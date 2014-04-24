function mark(url,album){
  url=encodeURIComponent(url);
  album=encodeURIComponent(album);
  $.get("mark_js.php?imgurl="+url+"&class="+album,
    function(data){ alert("采集成功"); return;},
    "text");
}
