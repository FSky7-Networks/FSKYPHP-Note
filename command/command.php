<?php
	/*
		FSKYPHP-Note
		
		模块 : 后端主控
		时间 : 2018/11/10
		环境 : LNMP PHP7.1
		
		Copyright 2018 FlyingSky .
	*/
	
	session_start();
	error_reporting(E_ALL^E_NOTICE^E_WARNING); //关闭php提示
	
	if(!file_exists('./install/install.lock') && !file_exists('../install/install.lock')){
		exit('<script type="text/javascript">window.location.href="../install/";</script>');
	}
	
	$info_ip = $_SERVER["REMOTE_ADDR"];
	$info_time = date("Y-m-d H:i:s");
	$info_appnum = '2';
	$info_host = $_SERVER['HTTP_HOST'];
	$info_language = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
	$info_user = $_SERVER["HTTP_USER_AGENT"];
	$info_lastadd = $_SERVER['HTTP_REFERER'];
	$info_nowadd = $_SERVER['REQUEST_URI'];
	
	include("config.php");//加载配置模块
	include("connsql.php"); //加载数据库连接模块
	include("loading.php"); //加载初始化模块
	
	$info_application='FSKYPHP-Note Release 2.10 ';

?>