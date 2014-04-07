<html>
<?php 
$dir=$_REQUEST['dir']?$_REQUEST['dir']:'';
?>
<meta charset="utf-8">
	<form enctype="multipart/form-data" action="upload.php" method="post" name="upform">
		<b>上传文件:</b><br>
	<!-- <select name="class"> -->
		<!-- <option value="hospital">hospital</option> -->
		<!-- <option value="weixin">weixin</option> -->
		<!-- <option value="url">url</option> -->
	<!-- </select> -->
	<input name="upfile" type="file" style="width:150px"><br>
	<span style="font-size:70%;">相册名(没有会新建,以front.jpg做封面):</span><input type="text" name="class" value="<?php echo $dir;?>"/><br/>
	<input type="submit" value="上传"><br>
	</form>
	<!-- <?=implode(', ',$uptypes)?> -->
</html>
