<?php
	/*
		FSKYPHP-Note
		
		模块 : 通用文件
		时间 : 2018/11/30
		环境 : LNMP PHP7.1
		编写 : FlyingSky
		检查 : FlyingSky
		版本 : Release 3.0
		
		Copyright 2018 FlyingSky .
	*/
	
	session_start();
	error_reporting(E_ALL^E_NOTICE^E_WARNING); //关闭php提示
	
	//Installed or not
	if(!file_exists('./install/install.lock') && !file_exists('../install/install.lock')){
		exit('<script type="text/javascript">window.location.href="./install/";</script>');
	}
	
	//Get Information
	$info_ip = $_SERVER["REMOTE_ADDR"];
	$info_time = date("Y-m-d H:i:s");
	$info_appnum = '2';
	$info_host = $_SERVER['HTTP_HOST'];
	$info_language = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
	$info_user = $_SERVER["HTTP_USER_AGENT"];
	$info_lastadd = $_SERVER['HTTP_REFERER'];
	$info_nowadd = $_SERVER['REQUEST_URI'];
	$info_application='FSKYPHP-Note Release 3.00 ';
	
	//Include
	include("./function.php");
	include("./config.php");
	include("./connsql.php");
	include("./loading.php");

?>