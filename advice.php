<?php
if(!isset($_REQUEST["advice"])) echo "fail";
$advice=$_REQUEST['advice'];
$advice=str_replace("\n"," ",$advice);
file_put_contents("advice.txt",$advice."\n",FILE_APPEND|LOCK_EX);
echo "ok";
?>

