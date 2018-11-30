<?php
	/*
		FlyingSky 留言墙程序 Release 2.00
		
		初始化模块
		
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
	
	$mysql_result=mysqli_query($mysql_conn,"select * from ".$mysql_tag."config");
	$config=mysqli_fetch_array($mysql_result);
	
	$sql = "SELECT COUNT(*) FROM ".$mysql_tag."list";
	$row = mysqli_fetch_array(mysqli_query($mysql_conn,$sql));
	$count_message = $row[0];
	
	if ($config['loglog']=="on") {
		mysqli_query($mysql_conn,"INSERT INTO ".$mysql_tag."logs (`text` ,`time` ,`ip` ,`language` ,`nowadd` ,`hostname` ,`lastadd`) VALUES ('Visit',  '".$info_time."',  '".$info_ip."',  '".$info_language."',  'http://".$info_host."".$info_nowadd."',  '".$info_user."',  '".$info_lastadd."');");
	}
	
?>