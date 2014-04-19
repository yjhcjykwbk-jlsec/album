<div id="music_div" style=""><embed src="" align="center" border="0" width="1" height="1" width="100" autostart="true" loop="true"> </embed></div>
<script>
var musics=[];
<?php
function utf8_array_asort(&$array)
{
	if(!isset($array) || !is_array($array))
	{
		return false;
	}
	foreach($array as $k=>$v)
	{
		$array[$k] = iconv('UTF-8', 'GBK//IGNORE',$v);
	}
	asort($array);
	foreach($array as $k=>$v)
	{
		$array[$k] = iconv('GBK', 'UTF-8//IGNORE', $v);
	}
	return true;
}

$lst=array();
if ($handle = opendir("music")) {
	$i=0;
	while (false !== ($entry = readdir($handle))) {
		$pi=pathinfo("music/".$entry);
		if($pi['extension']!="mp3") continue;
		else $lst[]=$entry;
	}
	utf8_array_asort($lst);
	foreach($lst as $i=>$entry){
?>
		musics.push("<?php echo $entry;?>");
		$("#music_select").append("<option value='<?php echo $entry;?>'><?php echo $entry;?></option>")
<?php
	}
	closeDir($handle);
}
?>
var lastSong=0;
var interval;
var setMusic=function(music){
	if(music==lastSong) return;
	clearInterval(interval);
	if(music!="stop") interval=setInterval(randomSong,300*1000);
	lastSong=music;
	music_div.innerHTML='<embed src="music/'+music+'" align="center" border="0" width="1" height="1" autostart="true" loop="true"> </embed>';
  if(index_href!=undefined){
    index_href.innerText=" "+music.split('.')[0]+" 播放中";
  }
};
var setEmbed=function(i){
	music_div.innerHTML='<embed src="music/'+musics[i]+'" align="center" border="0" width="1" height="1" autostart="true" loop="true"> </embed>';
  if(index_href!=undefined){
    index_href.innerText=" "+musics[i].split('.')[0]+" 播放中";
  }
};
var randomSong=function(){
	n=musics.length;
	setEmbed(Math.ceil(Math.random()*n));
};
</script>
