<div id="music_div" style=""><embed src="" align="center" border="0" width="1" height="1" width="100" autostart="true" loop="true"> </embed></div>
<script>
var musics=[];
<?php
if ($handle = opendir("music")) {
    $i=0;
    while (false !== ($entry = readdir($handle))) {
	$pi=pathinfo("music/".$entry);
	if($pi['extension']!="mp3") continue;
?>
	musics.push("<?php echo $entry;?>");
	$("#music_select").append("<option value='<?php echo $entry;?>'><?php echo $entry;?></option>")
<?php
    }
    closeDir($handle);
}
?>
var lastSong=0;
var setMusic=function(music){
	if(music==lastSong) return;
	lastSong=music;
  music_div.innerHTML='<embed src="music/'+music+'" align="center" border="0" width="1" height="1" autostart="true" loop="true"> </embed>';
};
var setEmbed=function(i){
  music_div.innerHTML='<embed src="music/'+musics[i]+'" align="center" border="0" width="1" height="1" autostart="true" loop="true"> </embed>';
};
var randomSong=function(){
  n=musics.length;
  setEmbed(Math.ceil(Math.random()*n));
};
setMusic("太多.mp3");
setInterval(randomSong,300*1000);
</script>
