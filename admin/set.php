<?php
	/*
		FSKYPHP-Note
		
		模块 : 后台设置保存
		时间 : 2018/11/30
		环境 : LNMP PHP7.1
		编写 : FlyingSky
		检查 : FlyingSky
		版本 : Release 3.0
		
		Copyright 2018 FlyingSky .
	*/
	
		include("common.php");
	
		if ($_GET['mod'] == "delete") {
			if ($_GET['class'] == "message") {
				mysqli_query($mysql_conn,"DELETE FROM ".$mysql_tag."list WHERE `Id` = ".$_GET['id'].";");
				exit ('<script type="text/javascript">window.location.href="message.php";</script>');
			} 
			if ($_GET['class'] == "menu") {
				mysqli_query($mysql_conn,"DELETE FROM ".$mysql_tag."menu WHERE `Id` = ".$_GET['id'].";");
				exit ('<script type="text/javascript">window.location.href="menu.php";</script>');
			}
		}
		if ($_GET['mod'] == "add") {
			if ($_GET['class'] == "menu") {
				mysqli_query($mysql_conn,"INSERT INTO ".$mysql_tag."menu (`id`,`name` ,`link`) VALUES ('".$_POST['id']."','".$_POST['name']."',  '".$_POST['link']."');");
				exit ('<script type="text/javascript">window.location.href="menu.php";</script>');
			}
		}
		if ($_GET['mod'] == "setting") {
			if ($_GET['class'] == "name") {
				mysqli_query($mysql_conn,"
					UPDATE `".$mysql_tag."config` SET
					`name` =  '".$_POST['name']."',
					`title` =  '".$_POST['title']."',
					`loglog` =  '".$_POST['loglog']."',
					`copyright` =  '".htmlspecialchars_decode($_POST['copyright'])."'
					WHERE  `".$mysql_tag."config`.`id` =1;
				");
				exit ('<script type="text/javascript">window.location.href="setting.php";</script>');
			}
			if ($_GET['class'] == "style") {
				mysqli_query($mysql_conn,"
					UPDATE `".$mysql_tag."config` SET
					`ico` =  '".$_POST['ico']."',
					`style` =  '".$_POST['style']."',
					`template` =  '".$_POST['template']."',
					`background` =  '".$_POST['background']."',
					`ico` =  '".$_POST['ico']."',
					`headimage` =  '".$_POST['headimage']."'
					WHERE  `".$mysql_tag."config`.`id` =1;
				");
				exit ('<script type="text/javascript">window.location.href="setting.php";</script>');
			}
			if ($_GET['class'] == "other") {
				mysqli_query($mysql_conn,"
					UPDATE `".$mysql_tag."config` SET
					`sendt` =  '".$_POST['sendt']."',
					`hikotoko` =  '".$_POST['hikotoko']."',
					`toclock` =  '".$_POST['toclock']."',
					`googleanalytics` =  '".$_POST['googleanalytics']."',
					`readnumber` =  '".$_POST['readnumber']."'
					WHERE  `".$mysql_tag."config`.`id` =1;
				");
				exit ('<script type="text/javascript">window.location.href="setting.php";</script>');
			}
			if ($_GET['class'] == "admin") {
				if ($_POST['password']) {
					mysqli_query($mysql_conn,"
						UPDATE `".$mysql_tag."config` SET
						`adminuser` =  '".$_POST['adminuser']."',
						`password` =  '".md5($_POST['password'])."'
						WHERE  `".$mysql_tag."config`.`id` =1;
					");
					exit ('<script type="text/javascript">window.location.href="setting.php";</script>');
				} else {
					mysqli_query($mysql_conn,"
						UPDATE `".$mysql_tag."config` SET
						`adminuser` =  '".$_POST['adminuser']."'
						WHERE  `".$mysql_tag."config`.`id` =1;
					");
					exit ('<script type="text/javascript">window.location.href="setting.php";</script>');
				}
			}
		}
?>