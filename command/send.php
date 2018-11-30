<?php
	/*
		FSKYPHP-Note
		
		模块 : 发送留言
		时间 : 2018/11/30
		环境 : LNMP PHP7.1
		编写 : FlyingSky
		检查 : FlyingSky
		版本 : Release 3.0
		
		Copyright 2018 FlyingSky .
	*/
	
	$send_fromname = addslashes(htmlspecialchars($_POST['fromname']));
	$send_toname = addslashes(htmlspecialchars($_POST['toname']));
	$send_mail = addslashes(htmlspecialchars($_POST['mail']));	
	$send_content = addslashes(nl2br(htmlspecialchars($_POST['content'])));
	$send_lastdate = $info_time;
	$send_ip = $info_ip;
	
	if ($config['loglog']) {
		mysqli_query($mysql_conn,"INSERT INTO ".$mysql_tag."logs (`text` ,`time` ,`ip` ,`language` ,`nowadd` ,`hostname` ,`lastadd`) VALUES ('Send',  '".$info_time."',  '".$info_ip."',  '".$info_language."',  '//".$info_host."".$info_nowadd."',  '".$info_user."',  '".$info_lastadd."');");
	}
	
	if ($send_fromname && $send_toname && $send_content && $send_mail) {
		if ($_COOKIE['sendt']!="clock") {
			setcookie("sendt", "clock", time()+$config['sendt']);
			mysqli_query($mysql_conn,"INSERT INTO ".$mysql_tag."list (`fromname` ,`toname` ,`content` ,`lastdate` ,`ip`) VALUES ('".$send_fromname."',  '".$send_toname."',  '".$send_content."',  '".$send_lastdate."',  '".$send_ip."');");
			echo '<script type="text/javascript">window.location.href="./";</script>';
		} else {
			echo '<script type="text/javascript">window.location.href="./?warning='.urlencode('<b>留言发送失败</b> 留言发送间隔 : '.$config['sendt'].' 秒').'";</script>';
		}
	} else {
		echo '<script type="text/javascript">window.location.href="./?warning='.urlencode('<b>留言发送失败</b> 缺少内容 ( 发送方 / 接收方 / 邮箱 / 内容 ) ').'";</script>';
	}
?>