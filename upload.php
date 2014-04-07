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

$class=isset($_REQUEST['class'])?$_REQUEST['class']:'.';
$destination_folder="DATASET/".$class."/";

$max_file_size=20000000;     //上传文件大小限制, 单位BYTE
$imgpreview=1;      //是否生成预览图(1为生成,其他为不生成);
$imgpreviewsize=1/4;    //缩略图比例
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
print_r($_FILES);
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!is_uploaded_file($_FILES["upfile"]['tmp_name']))
    //是否存在文件
    {
         echo "图片不存在!";
         exit;
    }

    $file = $_FILES["upfile"];
    if($max_file_size < $file["size"])
    //检查文件大小
    {
        echo "文件太大!"; exit;
    }

    // if(!in_array($file["type"], $uptypes))
    // //检查文件类型
    // {
        // myLog( "文件类型不符!".$file["type"]);
        // exit;
    // }

    if(!file_exists($destination_folder))
    {
        if(!mkdir($destination_folder,0777)){
 	     echo "创建相册失败";
	     return;
	}
	chmod($destination_folder, 0777);
    }

    $tmpFilename=$file["tmp_name"];
    $image_size = getimagesize($tmpFilename);
    $filename=$file["name"];
    $destination = $destination_folder.$filename;
    if (file_exists($destination))
    {
	$pi=pathinfo($filename);
	$ftype=$pi["extension"];
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

    echo "上传成功:".$destination;

    echo " <font color=red>已经成功上传</font><br>文件名:  <font color=blue>".$destination_folder.$fname."</font><br>";
    echo " 宽度:".$image_size[0];
    echo " 长度:".$image_size[1];
    echo "<br> 大小:".$file["size"]." bytes";
		echo "<script> setTimeout(function(){window.location.href='uploadpage.html';},3000);</script>";



    if($imgpreview==1)
    {
    echo "<br>图片预览:<br>";
    echo "<img src=\"".$destination."\" width=".($image_size[0]*$imgpreviewsize)." height=".($image_size[1]*$imgpreviewsize);
    echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
    }
}
?>
</body>
</html>
