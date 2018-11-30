<?php
	/*
		FSKYPHP-Note
		
		模块 : 后台通用文件
		时间 : 2018/11/30
		环境 : LNMP PHP7.1
		编写 : FlyingSky
		检查 : FlyingSky
		版本 : Release 3.0
		
		Copyright 2018 FlyingSky .
	*/
	
	//Include
	include("../command/common.php");

	if ($_COOKIE['adminuser'] != $config['adminuser']) {
		exit ('<script type="text/javascript">window.location.href="login.php";</script>');
	} else if (md5($_COOKIE['password']) != $config['password']) {
		exit ('<script type="text/javascript">window.location.href="login.php";</script>');
	}