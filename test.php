<?php
function myLog($str){
	file_put_contents("log.txt",$str,FILE_APPEND);
}
?>
