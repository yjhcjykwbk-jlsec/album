<div id="upload_div" style="display:none;text-align:left;margin-left:auto;margin-right:auto;z-index:0;position:relative;bottom:10px;width:60%;padding:10px;box-shadow: 0px 0px 1px 0px rgb(0,0,0);font-size: 14px;background-color:white;opacity:1;border:2px solid #f0f0f0;border-radius:0px; line-height: 1" >
<?php 
$ENCODE="utf-8";
$dir=$_REQUEST['dir']?$_REQUEST['dir']:'';
?>
<style>
#upload_form input{
background:transparent;
border:1px solid rgba(120,120,120,0.3);
}
#upload_form button{
background:transparent;
}
</style>
<meta charset="utf-8">
<form id="upload_form" enctype="multipart/form-data" action="upload.php?username=<?php echo $username?>" method="post" name="upform" style="opacity:0.7;padding:12px;background:white;font-size:70%">
    <b>上传图片(所有输入都不是必填,引用可填为为图片来源，或视频地址):</b><br>
  <input name="upfile0" type="file" style="width:45%">
  地址<input name="uplink0" type="text"><br>
  描述<input name="desp0" type="text" style="width:85%"><br>
  引用<input name="ref0" type="text" style="width:85%"><br>

  <input name="upfile1" type="file" style="width:45%">
  地址<input name="uplink1" type="text"><br>
  描述<input name="desp1" type="text" style="width:85%"><br>
  引用<input name="ref1" type="text" style="width:85%"><br>

  <input name="upfile2" type="file" style="width:45%">
  地址<input name="uplink2" type="text"><br>
  描述<input name="desp2" type="text" style="width:85%"><br>
  引用<input name="ref2" type="text" style="width:85%"><br>

  <input name="upfile3" type="file" style="width:45%">
  地址<input name="uplink3" type="text"><br>
  描述<input name="desp3" type="text" style="width:85%"><br>
  引用<input name="ref3" type="text" style="width:85%"><br>

  <input name="upfile4" type="file" style="width:45%">
  地址<input name="uplink4" type="text"><br>
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
<button style="background:transparent;border:0;position:relative;color:red;right:0;" onclick="toggleUploadForm()">close</button>
    <!-- <?//=implode(', ',$uptypes)?> -->
</div>
