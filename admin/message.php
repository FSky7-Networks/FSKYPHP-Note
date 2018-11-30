<?php
	/*
		FlyingSky 留言墙程序 Release 2.00
		
		后台访问入口
		
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
	
	include("../command/command.php");
	
	if ($_COOKIE['adminuser'] != $config['adminuser']) {
		exit ('<script type="text/javascript">window.location.href="login.php";</script>');
	} else if ($_COOKIE['password'] != $config['password']) {
		exit ('<script type="text/javascript">window.location.href="login.php";</script>');
	} else {
		include("template/header.html");
		include("template/message.html");
		include("template/footer.html");
	}
?>