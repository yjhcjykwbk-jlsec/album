<html>
<?php 
$dir=$_REQUEST['dir']?$_REQUEST['dir']:'';
?>
<meta charset="utf-8">
	<form enctype="multipart/form-data" action="upload.php" method="post" name="upform">
		<b>上传文件:</b><br>
	<input name="upfile0" type="file" style="width:150px"><br>
	<input name="upfile1" type="file" style="width:150px"><br>
	<input name="upfile2" type="file" style="width:150px"><br>
	<input name="upfile3" type="file" style="width:150px"><br>
	<input name="upfile4" type="file" style="width:150px"><br>
	<input name="upfile5" type="file" style="width:150px"><br>
	<input name="upfile6" type="file" style="width:150px"><br>
	<input name="upfile7" type="file" style="width:150px"><br>
	<input name="upfile8" type="file" style="width:150px"><br>
	<input name="upfile9" type="file" style="width:150px"><br>
	<span style="font-size:70%;">相册名(没有会新建,以front.jpg做封面):</span><input type="text" name="class" value="<?php echo $dir;?>"/><br/>
	<input type="submit" value="上传"><br>
	</form>
	<!-- <?=implode(', ',$uptypes)?> -->
</html>
