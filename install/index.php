<?php
	/*
		FSKYPHP-Note
		
		模块 : 安装程序
		时间 : 2018/11/30
		环境 : LNMP PHP7.1
		编写 : FlyingSky
		检查 : FlyingSky
		版本 : Release 3.0
		
		Copyright 2018 FlyingSky .
	*/

	session_start();

	//Check step
	$do=isset($_GET['do'])?$_GET['do']:'0';
	if(file_exists('install.lock')){
		//Installed
		$installed=true;
		$do='0';
	}
	
	//Function
	function checkfunc($f,$m = false) {
		if (function_exists($f)) {
			return '<font color="green">可用</font>';
		} else {
			if ($m == false) {
				return '<font color="black">不支持</font>';
			} else {
				return '<font color="red">不支持</font>';
			}
		}
	}
	function checkclass($f,$m = false) {
		if (class_exists($f)) {
			return '<font color="green">可用</font>';
		} else {
			if ($m == false) {
				return '<font color="black">不支持</font>';
			} else {
				return '<font color="red">不支持</font>';
			}
		}
	}

?>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>安装程序 | FSKYPHP-Note</title>
		<link rel="stylesheet" href="https://github.cdn.fsky7.com/GoogleMDL/icon.css">
		<link rel="stylesheet" href="https://github.cdn.fsky7.com/GoogleMDL/material.blue-light_blue.min.css">
		<script src="https://github.cdn.fsky7.com/GoogleMDL/material.min.js"></script>
		<style>
			#view-source {
				position: fixed;
				display: block;
				right: 0;
				bottom: 0;
				margin-right: 40px;
				margin-bottom: 40px;
				z-index: 900;
			}
			.demo-card-wide.mdl-card {
				width: 100%;
				max-width:725px;
				opacity:0.95;
				min-height:10px;!important
			}
			.demo-card-wide > .mdl-card__title {
				color: #fff;
				height: 176px;
				background: #afafaf;
			}
			.demo-card-wide > .mdl-card__menu {
				color: #fff;
			}
			.mdl-radio {
				margin:8px;
			}
		</style>
	</head>
	<body>
		<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
			<header class="mdl-layout__header">
				<div class="mdl-layout__header-row" style="padding-left: 32px;">
					<span class="mdl-layout-title">安装程序</span>
					<div class="mdl-layout-spacer"></div>
					<a class="mdl-navigation__link">FSKYPHP-Note</a>
					<a href="https://studio.fsky7.com/project/FSKYPHP-Note" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" target="_blank">
						<i class="material-icons">info_outline</i>
					</a>
				</div>
			</header>
			<main class="mdl-layout__content" style="padding: 16px;">
				<div class="page-content" align="center">
					<div class="demo-card-wide mdl-card mdl-shadow--2dp" align="left">
					<?php
						if($do=='0'){
						//Step 0 - Start
					?>
						<div class="mdl-card__supporting-text" align="center">
							<h3 style="margin: 4px;">安装向导</h3>
						</div>
						<div class="mdl-progress mdl-js-progress is-upgraded" style="width:100%;">
							<div class="progressbar bar bar1" style="width: 0%;"></div>
							<div class="bufferbar bar bar2" style="width: 100%;"></div>
							<div class="auxbar bar bar3" style="width: 0%;"></div>
						</div>
						<div class="mdl-card__supporting-text">
							<?php echo nl2br(file_get_contents("../readme.txt")); ?>
						</div>
						<div class="mdl-card__actions mdl-card--border" align="center">
							<?php if($installed){ ?>
								<a class="mdl-button">
									您已经安装过，如需重新安装请删除<font color="red"><b> install/install.lock </b></font>文件后再安装！
								</a>
							<?php }else{?>
								<a class="mdl-button mdl-button--colored" href="?do=1">
									开始安装
								</a>
							<?php }?>
						</div>
					<?php
						} elseif($do=='1') {
						//Step 1 - Check
					?>
						<div class="mdl-card__supporting-text" align="center">
							<h3 style="margin: 4px;">环境检查</h3>
						</div>
						<div class="mdl-progress mdl-js-progress is-upgraded" style="width:100%;">
							<div class="progressbar bar bar1" style="width: 10%;"></div>
							<div class="bufferbar bar bar2" style="width: 100%;"></div>
							<div class="auxbar bar bar3" style="width: 0%;"></div>
						</div>
						<table class="mdl-data-table mdl-js-data-table" style="width:100%">
							<thead>
								<tr>
									<th style="width:20%">函数检测</th>
									<th style="width:15%">需求</th>
									<th style="width:15%">当前</th>
									<th style="width:50%">用途</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>PHP >= 5.4</td>
									<td>必须</td>
									<td><?php echo phpversion(); ?></td>
									<td>PHP版本</td>
								</tr>
								<tr>
									<td>mysqli_query()</td>
									<td>必须</td>
									<td><?php echo checkfunc('mysqli_query',true); ?></td>
									<td>数据库</td>
								</tr>
								<tr>
									<td>mysqli_fetch_array()</td>
									<td>必须</td>
									<td><?php echo checkfunc('mysqli_fetch_array',true); ?></td>
									<td>数据库</td>
								</tr>
								<tr>
									<td>mysqli_num_rows()</td>
									<td>必须</td>
									<td><?php echo checkfunc('mysqli_num_rows',true); ?></td>
									<td>数据库</td>
								</tr>
								<tr>
									<td>addslashes()</td>
									<td>必须</td>
									<td><?php echo checkfunc('addslashes',true); ?></td>
									<td>转义</td>
								</tr>
								<tr>
									<td>stripslashes()</td>
									<td>必须</td>
									<td><?php echo checkfunc('stripslashes',true); ?></td>
									<td>转义</td>
								</tr>
								<tr>
									<td>nl2br()</td>
									<td>必须</td>
									<td><?php echo checkfunc('nl2br',true); ?></td>
									<td>转义</td>
								</tr>
								<tr>
									<td>urlencode()</td>
									<td>必须</td>
									<td><?php echo checkfunc('urlencode',true); ?></td>
									<td>转义</td>
								</tr>
								<tr>
									<td>htmlspecialchars()</td>
									<td>必须</td>
									<td><?php echo checkfunc('htmlspecialchars',true); ?></td>
									<td>转义</td>
								</tr>
								<tr>
									<td>md5()</td>
									<td>必须</td>
									<td><?php echo checkfunc('htmlspecialchars',true); ?></td>
									<td>加密</td>
								</tr>
								<tr>
									<td>file_get_contents()</td>
									<td>可选</td>
									<td><?php echo checkfunc('file_get_contents',true); ?></td>
									<td>文件</td>
								</tr>
							</tbody>
						</table>
						<div class="mdl-card__actions mdl-card--border" align="center">
							<a class="mdl-button mdl-button--colored" href="./?do=0">
								<<上一步
							</a>
							<a class="mdl-button mdl-button--colored" href="./?do=2">
								下一步>>
							</a>
						</div>
					<?php
						}elseif($do=='2'){
						//Step 2 - Set Setting
					?>
						<div class="mdl-card__supporting-text" align="center">
							<h3 style="margin: 4px;">数据库配置</h3>
						</div>
						<div class="mdl-progress mdl-js-progress is-upgraded" style="width:100%;">
							<div class="progressbar bar bar1" style="width: 30%;"></div>
							<div class="bufferbar bar bar2" style="width: 100%;"></div>
							<div class="auxbar bar bar3" style="width: 0%;"></div>
						</div>
						<div class="mdl-card__supporting-text" align="center">			
							<form action="./?do=3" class="form-sign" method="post">
								<div style="max-width:300px;margin:16px;">
									<div>
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
											<input class="mdl-textfield__input" type="text" name="db_host" value="127.0.0.1" required>
											<label class="mdl-textfield__label" for="fromname">数据库地址</label>
										</div>
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
											<input class="mdl-textfield__input" type="num" name="db_port" value="3306" required>
											<label class="mdl-textfield__label" for="fromname">数据库端口</label>
										</div>
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
											<input class="mdl-textfield__input" type="text" name="db_user" value="root" required>
											<label class="mdl-textfield__label" for="fromname">数据库用户名</label>
										</div>
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
											<input class="mdl-textfield__input" type="password" name="db_pwd" required>
											<label class="mdl-textfield__label" for="fromname">数据库密码</label>
										</div>
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
											<input class="mdl-textfield__input" type="text" name="db_name" required>
											<label class="mdl-textfield__label" for="fromname">数据库名称</label>
										</div>
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
											<input class="mdl-textfield__input" type="text" name="db_tag" value="wall_" required>
											<label class="mdl-textfield__label" for="fromname">数据表前缀</label>
										</div>
									</div>
									<input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="width:100%;margin-top:16px;margin-bottom:0px;" name="submit" value="保存配置">
								</div>
							</form>
							（如果已事先填写好config.php相关数据库配置，请 <a href="./?do=3&jump=1">点击此处</a> 跳过这一步！）
						</div>
					<?php 
						}elseif($do=='3'){
						//Step 3 - Save Setting
					?>
						<div class="mdl-card__supporting-text" align="center">
							<h3 style="margin: 4px;">保存数据库</h3>
						</div>
						<div class="mdl-progress mdl-js-progress is-upgraded" style="width:100%;">
							<div class="progressbar bar bar1" style="width: 50%;"></div>
							<div class="bufferbar bar bar2" style="width: 100%;"></div>
							<div class="auxbar bar bar3" style="width: 0%;"></div>
						</div>
					<?php
							if($_GET['jump']==1){
								include_once '../command/config.php';
								if(!$mysql_server||!$mysql_use||!$mysql_password||!$mysql_database||!$mysql_tag) {
					?>
						<div class="mdl-card__supporting-text">
							请先填写好数据库并保存后再安装！
						</div>
						<div class="mdl-card__actions mdl-card--border" align="center">
							<a class="mdl-button mdl-button--colored" href="./?do=2">
								<<上一步
							</a>
						</div>
					<?php
								}
							} else {
								//Save File
$config="
<?php
	/*
		FSKYPHP-Note
		
		Setting
	*/
	
	//MySQL服务器地址
	\$mysql_server='".$_POST['db_host'].":".$_POST['db_port']."';
	
	//MySQL登陆用户
	\$mysql_user='".$_POST['db_user']."';
	
	//MySQL登陆密码
	\$mysql_password='".$_POST['db_pwd']."';
	
	//MySQL选定数据库
	\$mysql_database='".$_POST['db_name']."';
	
	//MySQL表前缀
	\$mysql_tag='".$_POST['db_tag']."';
	
?>
";

								if(file_put_contents('../command/config.php',$config)){
									
									echo '<div class="mdl-card__supporting-text">数据库配置文件保存成功！</div>';
									echo '<div class="mdl-card__actions mdl-card--border" align="center"><a class="mdl-button mdl-button--colored" href="./?do=4">创建数据表>></a></div>';
								
								}else echo '
									<div class="mdl-card__supporting-text">保存失败，请确保网站根目录有写入权限</div>
									<div class="mdl-card__actions mdl-card--border" align="center">
										<a class="mdl-button mdl-button--colored" href="javascript:history.back(-1)">
											<<上一步
										</a>
									</div>
								';
							}
						}elseif($do=='4'){
						//Step 4 - SQL Write
					?>
						<div class="mdl-card__supporting-text" align="center">
							<h3 style="margin: 4px;">创建数据表</h3>
						</div>
						<div class="mdl-progress mdl-js-progress is-upgraded" style="width:100%;">
							<div class="progressbar bar bar1" style="width: 70%;"></div>
							<div class="bufferbar bar bar2" style="width: 100%;"></div>
							<div class="auxbar bar bar3" style="width: 0%;"></div>
						</div>
					<?php
							include_once '../command/config.php';
							if(!$mysql_server||!$mysql_user||!$mysql_password||!$mysql_database||!$mysql_tag) {
								echo '<div class="mdl-card__supporting-text">请先填写好数据库并保存后再安装！</div><div class="mdl-card__actions mdl-card--border" align="center"><a class="mdl-button mdl-button--colored" href="javascript:history.back(-1)"><<上一步</a></div>';
							} else {
								$mysql_conn = mysqli_connect($mysql_server,$mysql_user,$mysql_password);
								if (!$mysql_conn) {
									die('<div class="mdl-card__supporting-text">无法连接到数据库！错误信息：'.mb_convert_encoding(mysqli_connect_error(), "utf-8", "gbk").'</div><div class="mdl-card__actions mdl-card--border" align="center"><a class="mdl-button mdl-button--colored" href="javascript:history.back(-1)"><<上一步</a></div>');
								}
								mysqli_select_db($mysql_conn,$mysql_database);
								mysqli_query($mysql_conn,"set names utf8");
								mysqli_query($mysql_conn,"
									CREATE TABLE IF NOT EXISTS `".$mysql_tag."config` (
										`id` int(5) NOT NULL,
										`name` text NOT NULL,
										`title` text NOT NULL,
										`style` text NOT NULL,
										`background` text NOT NULL,
										`headimage` text NOT NULL,
										`hikotoko` text NOT NULL,
										`copyright` text NOT NULL,
										`toclock` text NOT NULL,
										`readnumber` int(3) NOT NULL,
										`template` text NOT NULL,
										`adminuser` text NOT NULL,
										`password` text NOT NULL,
										`loglog` TEXT NOT NULL,
										`ico` TEXT NOT NULL,
										`cdn` text NOT NULL,
										`googleanalytics` text NOT NULL,
										`sendt` int(3) NOT NULL,
										PRIMARY KEY (`id`)
									) ENGINE=MyISAM DEFAULT CHARSET=utf8;
								");
								mysqli_query($mysql_conn,"
									CREATE TABLE IF NOT EXISTS `".$mysql_tag."list` (
										`Id` int(11) NOT NULL AUTO_INCREMENT,
										`fromname` text NOT NULL,
										`toname` text NOT NULL,
										`mail` text NOT NULL,
										`content` text NOT NULL,
										`lastdate` text NOT NULL,
										`ip` text NOT NULL,
										PRIMARY KEY (`Id`)
									) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
								");
								mysqli_query($mysql_conn,"
									CREATE TABLE IF NOT EXISTS `".$mysql_tag."logs` (
										`id` int(11) NOT NULL AUTO_INCREMENT,
										`text` text,
										`ip` text,
										`time` text,
										`language` TEXT,
										`nowadd` TEXT,
										`hostname` TEXT,
										`lastadd` TEXT,
										PRIMARY KEY (`id`)
									) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
								");
								mysqli_query($mysql_conn,"
									CREATE TABLE IF NOT EXISTS `".$mysql_tag."menu` (
										`id` int(5) NOT NULL,
										`name` text NOT NULL,
										`link` text NOT NULL,
										PRIMARY KEY (`id`)
									) ENGINE=MyISAM DEFAULT CHARSET=utf8;
								");
								mysqli_query($mysql_conn,"
									INSERT INTO `".$mysql_tag."config` (
										`id`, `name`, `title`, `style`, `background`, `headimage`, `hikotoko`, `copyright`, `toclock`, `readnumber`, `template`, `adminuser`, `password`, `ico`, `cdn`
									) VALUES(
										1, 'FSKYPHP-Note', 'FlyingSky', 'blue-light_blue', '#ff40810d', './command/bingpic.php', '', 'Copyright © 2017 - 2019 <a>FlyingSky</a> . All Rights Reserved .', '', 10, 'default', 'admin', '".md5('123456')."', './favicon.ico', 'https://github.cdn.fsky7.com/'
									);
								");
								if(mysqli_query($mysql_conn,"select * from ".$mysql_tag."config")) {
									echo '<div class="mdl-card__supporting-text">安装成功！</div>
									<div class="mdl-card__actions mdl-card--border" align="center"><a class="mdl-button mdl-button--colored" href="./?do=5">下一步>></a></div>';
								} else {
									echo '<div class="mdl-card__supporting-text">安装失败！</div>
									<div class="mdl-card__actions mdl-card--border" align="center"><a class="mdl-button mdl-button--colored" href="./?do=4">重试</a></div>';
								}
							}
						}elseif($do=='5'){
						//Step 5 - Finish
					?>
						<div class="mdl-card__supporting-text" align="center">
							<h3 style="margin: 4px;">安装完成</h3>
						</div>
						<div class="mdl-progress mdl-js-progress is-upgraded" style="width:100%;">
							<div class="progressbar bar bar1" style="width: 100%;"></div>
							<div class="bufferbar bar bar2" style="width: 100%;"></div>
							<div class="auxbar bar bar3" style="width: 0%;"></div>
						</div>
					<?php
							@file_put_contents("install.lock",'安装锁');
							echo '
								<div class="mdl-card__supporting-text">
									安装完成！默认管理账号和密码是: admin / 123456<br>
									如果你的空间不支持本地文件读写，请自行在 install 目录建立 install.lock 文件！<br>
									更多设置选项请登录后台管理进行修改。
								</div>
								<div class="mdl-card__actions mdl-card--border" align="center">
									<a class="mdl-button mdl-button--colored"href="../">网站首页</a>
									<a class="mdl-button mdl-button--colored"href="../admin/">后台管理</a>
								</div>
							';
						} else {
						//Step tan90
					?>
						<div class="mdl-card__supporting-text" align="center">
							<h3 style="margin: 4px;">步骤错误</h3>
						</div>
						<div class="mdl-progress mdl-js-progress is-upgraded" style="width:100%;">
							<div class="progressbar bar bar1" style="width: 0%;"></div>
							<div class="bufferbar bar bar2" style="width: 100%;"></div>
							<div class="auxbar bar bar3" style="width: 0%;"></div>
						</div>
						<div class="mdl-card__supporting-text">
							不存在的步骤
						</div>
						<div class="mdl-card__actions mdl-card--border" align="center">
							<a class="mdl-button mdl-button--colored" href="./">返回</a>
						</div>
					<?php
						}
					?>
					</div>
				</div>
			</main>
		</div>
	</body>
</html>