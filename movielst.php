<iframe id="movie_div" class="video_src_wrapper" style="height:80%;width:70%;margin-left:auto;margin-right:auto;">
<!--
<embed id="movie" type="application/x-shockwave-flash" 
class="BDE_Flash" 
src="" 
width="100%" height="95%" scale="noborder" margin-top="5%"; margin-left="auto";margin-right="auto";
allowscriptaccess="never" menu="true" loop="loop" 
play="false" womode="transparent" 
pluginspage="http://www.macromedia.com/go/getflashplayer" 
allowfullscreen="true" 
flashvars="playMovie=false&amp;auto=0&amp;adss=0&amp;
isAutoPlay=false" 
style="visibility: visible; display: block;"></embed>

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="100%" height="">
<param name="movie" value="">
<param name="quality" value="high">
<param name="wmode" value="transparent">
<embed id="flash" src="" width="100%" height="" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="transparent"></embed>
</object>
-->
</iframe>
<script>
function loadMovie(src){
  document.getElementById('movie_div').src="movie/"+src;
  // flash.src="movie/"+src;
}
</script>
<ul>
<?php 
if($handle=opendir("movie")){
  while (false !== ($entry =readdir($handle))) {
    if($entry!="."&&$entry!=".."){
?>
<li>
  <a onclick="console.log(this);loadMovie(this.innerText);return false;" href="movie/<?php echo $entry;?>"><?php echo $entry;?></a>
</li>
<?php }}} ?>
</ul>
<!--

<div id="video" style="display:block;" class="video_src_wrapper">
<embed allowfullscreen="true" 
pluginspage="http://www.macromedia.com/go/getflashplayer" 
type="application/x-shockwave-flash" 
wmode="transparent" play="true" loop="false" menu="false" 
allowscriptaccess="never" scale="noborder" 
src="http://www.tudou.com/v/-SEuJIiaDbY/&amp;resourceId=0_06_02_99/v.swf" 
class="BDE_Flash" width="500" height="450" 
  vsrc="http://www.tudou.com/programs/view/-SEuJIiaDbY/?resourceId=0_06_02_99" 
  vpic="http://i4.tdimg.com/164/862/537/p.jpg" 
  pkey="5dc85a246bbcc5bc55b6ba42f8ea2730">
<span class="apc_src_wrapper">视频来自：<a href="http://jump.bdimg.com/safecheck/index?url=x+Z5mMbGPAuaZg/pveuNyh7rKgvGJVSukVjk7JyUlSLlFfhoNaI+ly8iq6k9t0UZPpvRhSQano8rp5ViDSZSRSPm7E45ObuEsDeAZtpiqr6Q8BUsFABCNcoUrSQzMjQk+/anyutL5br/mKLhTd7M9zA8Zu4mdgY0" target="_blank">音悦台</a>
</span>
  </div>
-->
