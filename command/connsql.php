<?php
	/*
		FlyingSky 留言墙程序 Release 2.00
		
		数据库连接模块
		
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
	
	$mysql_conn = mysqli_connect($mysql_server,$mysql_user,$mysql_password);
	
	//如果连接数据库失败
	if (!$mysql_conn) {
		echo "<h1>:(</h2>";
		echo "<h3>MySQL Error !</h3>";
		die(mysqli_connect_error());
	}
	
	//如果数据库连接成功
	mysqli_select_db($mysql_conn,$mysql_database);
	mysqli_query($mysql_conn,"set names utf8");
	
?>