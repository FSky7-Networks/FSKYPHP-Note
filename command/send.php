<?php
	/*
		FlyingSky 留言墙程序 Release 2.00
		
		留言发送
		
		Copyright 2018 FlyingSky & FlyingGroup .

		Licensed under the Apache License, Version 2.0 (the "License");
		you may not use this file except in compliance with the License.
		You may obtain a copy of the License at

			http://www.apache.org/licenses/LICENSE-2.0

		Unless required by applicable law or agreed to in writing, software
		distributed under the License is distributed on an "AS IS" BASIS,
		WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
		See the License for the specific language governing permissions and
		limitations under the License.
	*/
	
	$send_fromname = htmlspecialchars($_POST['fromname']);
	$send_toname = htmlspecialchars($_POST['toname']);
	$send_content = nl2br(htmlspecialchars($_POST['content']));
	$send_lastdate = $info_time;
	$send_ip = $info_ip;
	
	mysqli_query($mysql_conn,"INSERT INTO ".$mysql_tag."logs (`text` ,`time` ,`ip` ,`language` ,`nowadd` ,`hostname` ,`lastadd`) VALUES ('Send',  '".$info_time."',  '".$info_ip."',  '".$info_language."',  'http://".$info_host."".$info_nowadd."',  '".$info_user."',  '".$info_lastadd."');");
	
	if ($send_fromname && $send_toname && $send_content) {
		if ($_COOKIE['sendt']!="clock") {
			setcookie("sendt", "clock", time()+$config['sendt']);
			mysqli_query($mysql_conn,"INSERT INTO ".$mysql_tag."list (`fromname` ,`toname` ,`content` ,`lastdate` ,`ip`) VALUES ('".$send_fromname."',  '".$send_toname."',  '".$send_content."',  '".$send_lastdate."',  '".$send_ip."');");
			echo '<script type="text/javascript">window.location.href="index.php";</script>';
		} else {
			echo '<script type="text/javascript">window.location.href="index.php?warning='.urlencode('<b>留言发送失败</b> 留言发送间隔 : '.$config['sendt'].' 秒').'";</script>';
		}
	} else {
		echo "<h1>:(</h2>";
		echo "<h3>Send Error !</h3>";
		echo "没有内容（发送方，接收方，文本内容）!";
		$emmm_emmm = "'index.php'";
		die('<script type="text/javascript">window.setTimeout("window.location='.$emmm_emmm.'",3000);</script>');
	}
?>