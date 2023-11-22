/* 
	Theme Name:SIKAONIU
	Theme URL:https://www.huzhan.com/ishop15931/
	Description:https://www.huzhan.com/ishop15931/
	Author:Loome思考NIU网络工作室
	Author URI:https://www.huzhan.com/ishop15931/
	Tags:运势测试V4.0（无双源码）
	Version:4.0
*/
<?php
require 'curl.php';
echo $_COOKIE["openid"];
echo $_GET['code'];
define("redirect_uri", "https://www.114ymw.com/?ac=qiming&teacher=lyl");
$redirect_uri=urlencode(redirect_uri);

  MyCurl::user_login(client_id,client_secret,$redirect_uri,$_GET['code']);