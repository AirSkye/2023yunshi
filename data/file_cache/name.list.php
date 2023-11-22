<?php
$webnames = $_SERVER['HTTP_HOST'];
$doname = array('www.114ymw.com','m.114ymw.com',"sm.114ymw.com",'zb.114ymw.com','m.zb.114ymw.com',"sm.114ymw.com");
if($_GET['a']){
	print_r($doname);
}
if(!in_array($webnames,$doname)){
	exit;
}
?>