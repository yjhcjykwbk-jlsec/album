<html>
<?php 
$ENCODE="utf-8";
$dir=$_REQUEST['dir']?$_REQUEST['dir']:'';
?>
<meta charset="utf-8">
  <form enctype="multipart/form-data" action="upload.php" method="post" name="upform" style="font-size:70%">
    <b>上传图片(所有输入都不是必填,引用可填为为图片来源，或视频地址):</b><br>
  <input name="upfile0" type="file" style="width:85%"><br>
  描述<input name="desp0" type="text" style="width:85%"><br>
  引用<input name="ref0" type="text" style="width:85%"><br>
  <hr>

  <input name="upfile1" type="file" style="width:85%"><br>
  描述<input name="desp1" type="text" style="width:85%"><br>
  引用<input name="ref1" type="text" style="width:85%"><br>
  <hr>

  <input name="upfile2" type="file" style="width:85%"><br>
  描述<input name="desp2" type="text" style="width:85%"><br>
  引用<input name="ref2" type="text" style="width:85%"><br>
  <hr>

  <input name="upfile3" type="file" style="width:85%"><br>
  描述<input name="desp3" type="text" style="width:85%"><br>
  引用<input name="ref3" type="text" style="width:85%"><br>
  <hr>

  <input name="upfile4" type="file" style="width:85%"><br>
  描述<input name="desp4" type="text" style="width:85%"><br>
  引用<input name="ref4" type="text" style="width:85%"><br>

  <span>相册(默认当前相册，输入相册名可能会新建):</span><br/><input type="text" id="album" name="class" value="<?php echo $dir;?>"/>
  <select type="select" name="albumname" onclick="album.value=this.value;">
<?php 
include_once "util.php";
if($ENCODE=="utf-8") 
  $dirs=getSubDir();
else $dirs=getSubDirGBK();
foreach($dirs as $i=>$dir){?>
  <option value="<?php echo $dir;?>"><?php echo $dir;?></option>
  <?php }?>
</select>
  <input type="submit" value="上传"><br>
    </form>
    <!-- <?=implode(', ',$uptypes)?> -->
    </html>
