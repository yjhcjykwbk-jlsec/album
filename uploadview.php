<html>
<?php 
$dir=$_REQUEST['dir']?$_REQUEST['dir']:'';
?>
<meta charset="utf-8">
	<form enctype="multipart/form-data" action="upload.php" method="post" name="upform">
		<b>上传文件:</b><br>
	<input name="upfile0" type="file" style="width:150px"><br>
	描述<input name="desp0" type="text" style="width:150px"><br>
	引用<input name="ref0" type="text" style="width:150px"><br>

	<input name="upfile1" type="file" style="width:150px"><br>
	描述<input name="desp1" type="text" style="width:150px"><br>
	引用<input name="ref1" type="text" style="width:150px"><br>

	<input name="upfile2" type="file" style="width:150px"><br>
	描述<input name="desp2" type="text" style="width:150px"><br>
	引用<input name="ref2" type="text" style="width:150px"><br>

	<input name="upfile3" type="file" style="width:150px"><br>
	描述<input name="desp3" type="text" style="width:150px"><br>
	引用<input name="ref3" type="text" style="width:150px"><br>

	<input name="upfile4" type="file" style="width:150px"><br>
	描述<input name="desp4" type="text" style="width:150px"><br>
	引用<input name="ref4" type="text" style="width:150px"><br>

	<span style="font-size:70%;">相册(默认当前相册，输入相册名可能会新建):</span><input type="text" name="class" value="<?php echo $dir;?>"/><br/>
	<input type="submit" value="上传"><br>
	</form>
	<!-- <?=implode(', ',$uptypes)?> -->
</html>
