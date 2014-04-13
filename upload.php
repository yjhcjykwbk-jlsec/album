<?php
//上传文件类型列表
$uptypes=array(
		'image/jpg',
		'image/jpeg',
		'image/png',
		'image/pjpeg',
		'image/gif',
		'image/bmp',
		'image/x-png'
	      );

?>
<html>
<head>
<title>图片上传程序</title>
<style type="text/css">
<!--
body
{
	font-size: 9pt;
}
input
{
	background-color: #66CCFF;
	border: 1px inset #CCCCCC;
}
-->
</style>
</head>

<body>
<?php
//print_r($_FILES);
$class=isset($_REQUEST['class'])?$_REQUEST['class']:'.';
$destination_folder="DATASET/".$class."/";
echo "<script> setTimeout(function(){window.location.href='uploadview.php?dir=$class';},3000);</script>";
if(!file_exists($destination_folder))
{
	if(!mkdir($destination_folder,0777)){
		echo "创建相册失败";
		return;
	}
	chmod($destination_folder, 0777);
}
$uploadedFiles=array();
function upload($file){
	$max_file_size=20000000;     //上传文件大小限制, 单位BYTE
	global $destination_folder;
	if($file['size']==""||$file['tmp_name']=="") return;
	if($max_file_size < $file["size"])
		//检查文件大小
	{
		echo "文件太大!"; exit;
	}
	$filename=$file["name"];
	global $uploadedFiles;
	if(in_array($filename,$uploadedFiles)){
		echo "重复上传的文件已经被过滤:".$filename."<hr>";
		exit;
	}
	else $uploadedFiles[]=$filename;
	$tmpFilename=$file["tmp_name"];
	$image_size = getimagesize($tmpFilename);
	$pi=pathinfo($filename);
	$ftype=$pi["extension"];
	$destination = $destination_folder.$filename.".".$ftype;
	if (file_exists($destination))
	{
		$time=time();
		$destination = $destination_folder.$time.".".$ftype;
		if (file_exists($destination)){
			echo "同名文件已经存在了";
			exit;
		}
	}

	if(!move_uploaded_file ($tmpFilename, $destination))
	{
		echo "移动文件出错<br/>".$destination;
		echo "请确定当前相册文件夹开启了写入权限<br/>如果没有请通过ftp修改，方法见上传教程相册";
		exit;
	}

	echo "上传成功:".$tmpFileName;

	echo " <font color=red>已经成功上传</font><br>";
	echo "<br> 大小:".$file["size"]." bytes";

	echo "<br>图片预览:<br>";
	echo "<img src=\"".$destination."\" width=\"100px\"";
	echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\"><hr>";


}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	for($i=0;$i<10;$i++){
		if(isset($_FILES["upfile".$i])){//&&isset($_FILES["upfile".$i]['tmp_file'])){
				$file=$_FILES["upfile".$i];
				upload($file);
		}
	}
}
?>
</body>
</html>
