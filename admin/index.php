<?php
	/*
		FSKYPHP-Note
		
		模块 : 自定义函数
		时间 : 2018/11/30
		环境 : LNMP PHP7.1
		编写 : FlyingSky
		检查 : FlyingSky
		版本 : Release 3.0
		
		Copyright 2018 FlyingSky .
	*/
	
	include("../command/common.php");
	
	if ($_COOKIE['adminuser'] != $config['adminuser']) {
		exit ('<script type="text/javascript">window.location.href="login.php";</script>');
	} else if ($_COOKIE['password'] != $config['password']) {
		exit ('<script type="text/javascript">window.location.href="login.php";</script>');
	} else {
		include("template/header.html");
		include("template/index.html");
		include("template/footer.html");
	}
?>