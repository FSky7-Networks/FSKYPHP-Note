<?php
	/*
		FSKYPHP-Note
		
		模块 : 前端入口
		时间 : 2018/11/30
		环境 : LNMP PHP7.1
		编写 : FlyingSky
		检查 : FlyingSky
		版本 : Release 3.0
		
		Copyright 2018 FlyingSky .
	*/
	
	//Installed or not
	if(!file_exists('./install/install.lock')){
		exit('<script type="text/javascript">window.location.href="./install/";</script>');
	}
	
	//Common
	include("./command/common.php");
	
	if ($_GET['send']=='true') {
		//Loading Send Part
		include("command/send.php");
	} else {
		//Loading Template
		include("./template/".$config['template']."/index.php");
	}

?>