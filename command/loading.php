<?php
	/*
		FSKYPHP-Note
		
		模块 : 加载数据
		时间 : 2018/11/30
		环境 : LNMP PHP7.1
		编写 : FlyingSky
		检查 : FlyingSky
		版本 : Release 3.0
		
		Copyright 2018 FlyingSky .
	*/
	
	//Loading Setting
	$mysql_result=mysqli_query($mysql_conn,"select * from ".$mysql_tag."config");
	$config=mysqli_fetch_array($mysql_result);
	
	//Loading Data
	$data_list = mysqli_query($mysql_conn,"select * from ".$mysql_tag."list");
	$data_nemu = mysqli_query($mysql_conn,"select * from ".$mysql_tag."menu");
	
	//Log Vistor Information
	if ($config['loglog']=="on") {
		mysqli_query($mysql_conn,"INSERT INTO ".$mysql_tag."logs (`text` ,`time` ,`ip` ,`language` ,`nowadd` ,`hostname` ,`lastadd`) VALUES ('Visit',  '".$info_time."',  '".$info_ip."',  '".$info_language."',  '//".$info_host."".$info_nowadd."',  '".$info_user."',  '".$info_lastadd."');");
	}
	
?>