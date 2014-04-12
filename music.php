<script>
var lastSong=0;
var setEmbed=function(i){
  if(i==0||i==lastSong) return;
 lastSong=i;
  music_div.innerHTML='<embed src="music/'+i+'.mp3" align="center" border="0" width="1" height="1" autostart="true" loop="true"> </embed>';
};
var randomSong=function(){
  setEmbed(Math.ceil(Math.random()*24));
};
setInterval(randomSong,300*1000);
</script>
<div id="music_div" style=""><embed src="music/<?php echo rand(1,24);?>.mp3" align="center" border="0" width="1" height="1" width="100" autostart="true" loop="true"> </embed></div>
</p>
</div>
