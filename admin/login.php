<?php
	/*
		FSKYPHP-Note
		
		模块 : 后台登录
		时间 : 2018/11/30
		环境 : LNMP PHP7.1
		编写 : FlyingSky
		检查 : FlyingSky
		版本 : Release 3.0
		
		Copyright 2018 FlyingSky .
	*/
	
	include("../command/common.php");

	if ($_POST['adminuser'] && $_POST['password']) {
		setcookie("adminuser",$_POST['adminuser'], time()+3600);
		setcookie("password",$_POST['password'], time()+3600);
		if ($config['loglog']=="on") {
			mysqli_query($mysql_conn,"INSERT INTO ".$mysql_tag."logs (`text` ,`time` ,`ip` ,`language` ,`nowadd` ,`hostname` ,`lastadd`) VALUES ('Login',  '".$info_time."',  '".$info_ip."',  '".$info_language."',  'http://".$info_host."".$info_nowadd."',  '".$info_user."',  '".$info_lastadd."');");
		}
		exit ('<script type="text/javascript">window.location.href="./login.php";</script>');
	}
	if ($_COOKIE['adminuser'] == $config['adminuser'] && md5($_COOKIE['password']) == $config['password']) {
		exit ('<script type="text/javascript">window.location.href="./";</script>');
	}
?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>管理登陆 - FSKYPHP-Note</title>
		<link rel="stylesheet" href="<?=$config['cdn']?>Others/fskyphp-note-cover.css">
		<link rel="stylesheet" href="<?=$config['cdn']?>Others/fskyphp-note-icon.css">
		<link rel="stylesheet" href="<?=$config['cdn']?>GoogleMDL/material.<?=$config['style']?>.min.css">
		<script src="<?=$config['cdn']?>GoogleMDL/material.min.js"></script>
	</head>
	<body>
		<div class="site-wrapper">
			<div class="site-wrapper-inner">
				<div class="cover-container">
					<div class="inner cover" align="center">
						<h4>FSKYPHP-Note</h4>
						<div class="demo-card-wide mdl-card mdl-shadow--2dp" style="min-height:50px !important;max-width:500px;">
							<div class="mdl-card__supporting-text">
								<form action="#" method="post" onSubmit="return chkinput(this)" style="width:100%;">  
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
										<input class="mdl-textfield__input" type="text" name="adminuser" id="adminuser" value="">
										<label class="mdl-textfield__label" for="adminuser">管理员账号</label>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
										<input class="mdl-textfield__input" type="password" name="password" id="password" value="">
										<label class="mdl-textfield__label" for="password">管理员密码</label>
									</div>
									<input type="submit" name="submit" value="登陆" style="width:100%;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" /></td>  
								</form>
							</div>
						</div>
					</div>
					<div class="mastfoot">
						<p>
							Copyright &copy; 2018 <a href="http://flyingsky.gq/" target="_blank">FlyingSky</a> . <?=$info_application ?> .
						</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>