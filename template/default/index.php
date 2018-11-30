<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$config[name]?> - <?=$config[title]?></title>
		<link rel="stylesheet" href="css/icon.css">
		<link rel="stylesheet" href="css/material.<?=$config['style']?>.min.css">
		<link rel="icon" type="image/ico" href="<?=$config['ico']?>">
		<script defer src="css/material.min.js"></script>
		<style>
			.fs-layout-transparent {
				background: <?=$config['background']?>;
			}
			.demo-card-wide.mdl-card {
				width: auto;
				margin-top:8px;
				margin-left:8px;
				margin-right:8px;
				opacity:0.95;
				max-width:728px;
			}
			.demo-card-wide > .mdl-card__title {
				color: #fff;
				height: 176px;
				background: url('<?=$config[headimage]?>') center / cover;
			}
			.demo-card-wide > .mdl-card__menu {
				color: #fff;
			}
			.mdl-button {
				margin:8px;
			}
		</style>
	</head>
	<body>
		<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-tabs">
			<header class="mdl-layout__header">
				<div class="mdl-layout__header-row">
					<span class="mdl-layout-title"><?=$config[name]?></span>
					<div class="mdl-layout-spacer"></div>
					<!--<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right">
						<form method="post" action="search.php" name="search">
							<label class="mdl-button mdl-js-button mdl-button--icon" for="fixed-header-drawer-exp">
								<i class="material-icons">search</i>
							</label>
							<div class="mdl-textfield__expandable-holder">
								<input class="mdl-textfield__input" type="text" name="search" id="fixed-header-drawer-exp">
							</div>
						</form>
					</div>-->
				</div>
				
				<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
					<a href="#fixed-tab-1" class="mdl-layout__tab is-active">查看留言</a>
					<a href="#fixed-tab-2" class="mdl-layout__tab">写留言</a>
				</div>
			</header>
			<div class="mdl-layout__drawer">
				<span class="mdl-layout-title"><?=$config[name]?></span>
				<nav class="mdl-navigation">
					<a class="mdl-navigation__link" href="index.php">首页</a>
					<?php
						$result=mysqli_query($mysql_conn,"select * from ".$mysql_tag."menu");
						while ($rows=mysqli_fetch_array($result)) {
					?>
					<a class="mdl-navigation__link" href="<?=$rows[link] ?>"><?=$rows[name] ?></a>
					<?php
						}
					?>
				</nav>
			</div>
			<main class="mdl-layout__content fs-layout-transparent">
				<section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
					<div class="page-content" align="center">
						<div class="demo-card-wide mdl-card mdl-shadow--2dp" align="left">
							<div class="mdl-card__title">
								<h2 class="mdl-card__title-text"><?=$config[name]?></h2>
							</div>
							<div class="mdl-card__supporting-text">
								<?php
									if ($config[hikotoko]) { 
										echo $config[hikotoko];
									} else { 
								?>
								<script type="text/javascript" src="https://api.imjad.cn/hitokoto/?encode=js&charset=utf-8"></script>
								<script>hitokoto()</script>
								<?php } ?>
							</div>
							<div class="mdl-card__menu">
								<i class="material-icons">message</i>
							</div>
						</div>
						<?php if ($_GET['warning']) { ?>
						<div class="demo-card-wide mdl-card mdl-shadow--2dp" style="min-height:10px !important;background:#ff9900;color:#885500;" align="left">
							<div class="mdl-card__supporting-text">
								<?=$_GET['warning']?>
							</div>
						</div>
						<?php } ?>
						<div class="demo-card-wide mdl-card mdl-shadow--2dp" style="min-height:10px !important;" align="left">
							<div class="mdl-card__supporting-text">
								现在时间是 <?=$info_time?> ，本站已有 <?=$count_message?> 条留言。
							</div>
						</div>
						<?php
							$read_perNumber=$config[readnumber]; //每页显示记录数
							$read_page=$_GET['page']; //获得当前页面值
							$read_totalPage=ceil($count_message/$read_perNumber);
							if (!$read_page) {
								$read_page=1;
							}
							$read_startCount=($read_page-1)*$read_perNumber;
							$result=mysqli_query($mysql_conn,"select * from ".$mysql_tag."list order by Id desc limit ".$read_startCount.",".$read_perNumber." ;");
							while ($rows=mysqli_fetch_array($result)) {
						?>
						<div class="demo-card-wide mdl-card mdl-shadow--2dp" style="min-height:50px !important;" align="left">
							<div class="mdl-card__supporting-text" style="border-bottom: 1px solid rgba(0,0,0,.1);background:#F5F5F5;width:100%;">
								<a><?=$rows[toname] ?></a>
							</div>
							<div class="mdl-card__supporting-text" style="min-height:50px;">
								<p style="width:100%;font-size:14px;color:black;"><?=$rows[content] ?></p>
							</div>
							<div class="mdl-card__supporting-text" style="border-top: 1px solid rgba(0,0,0,.1);background:#F5F5F5;width:100%;">
								来自: <?=$rows[fromname] ?> | 时间: <?=$rows[lastdate] ?>
							</div>
						</div>
						<?php
							}
						?>
						<div style="margin:8px;" align="center">
							<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" href="index.php?page=1">首页</a>
							<?php if ($read_page != 1) { ?>
							<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" href="index.php?page=<?php echo $read_page - 1;?>">上页</a>
							<?php } ?>
							<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" href="index.php?page=<?php echo $read_page;?>"><?php echo $read_page ?>/<?php echo $read_totalPage ?></a>
							<?php if ($read_page<$read_totalPage) { //page小于总页数,显示下页链接 ?>
							<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" href="index.php?page=<?php echo $read_page + 1;?>">下页</a>
							<?php } ?>
							<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" href="index.php?page=<?php echo $read_totalPage;?>">尾页</a>
						</div>
						<div class="demo-card-wide mdl-card mdl-shadow--2dp" style="min-height:50px !important;margin-bottom: 8px;background-color:#1e1e1e;padding:16px;" align="left">
							<p style="color:#AAA !important;margin-bottom:0px!important;">
								<?=$config[copyright]?>
							</p>
							<p style="color:#666 !important;margin-bottom:0px!important;font-size:12px;">
								Powered by <?=$info_application ?>
							</p>
						</div>
					</div>
				</section>
				<section class="mdl-layout__tab-panel" id="fixed-tab-2">
					<div class="page-content" align="center">
						<div class="demo-card-wide mdl-card mdl-shadow--2dp" align="left">
							<div class="mdl-card__title">
								<h2 class="mdl-card__title-text"><?=$config[name]?></h2>
							</div>
							<div class="mdl-card__supporting-text">
								<?php
									if ($config[hikotoko]) { 
										echo $config[hikotoko];
									} else { 
								?>
								<script type="text/javascript" src="https://api.imjad.cn/hitokoto/?encode=js&charset=utf-8"></script>
								<script>hitokoto()</script>
								<?php } ?>
							</div>
							<div class="mdl-card__menu">
								<i class="material-icons">check</i>
							</div>
						</div>
						<div class="demo-card-wide mdl-card mdl-shadow--2dp" style="min-height:50px !important;" align="center">
							<div class="mdl-card__supporting-text">
								<form action="send.php" method="post">
									<div style="max-width:300px;margin:16px;">
										<div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
												<input class="mdl-textfield__input" type="text" name="fromname" id="fromname" value="游客" required>
												<label class="mdl-textfield__label" for="fromname">来自</label>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
												<?php if ($config[toclock]) { ?>
												<input class="mdl-textfield__input" type="text" name="toname" id="toname" value="<?=$config[toclock] ?>" readonly>
												<?php } else { ?>
												<input class="mdl-textfield__input" type="text" name="toname" id="toname" required>
												<?php } ?>
												<label class="mdl-textfield__label" for="toname">送给</label>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
												<textarea class="mdl-textfield__input" type="text" rows="10" name="content" id="content" maxlength="512" width="100%" required></textarea>
												<label class="mdl-textfield__label" for="content">内容</label>
											</div>
										</div>
										<input class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="width:100%;margin-top:16px;margin-bottom:0px;" type="submit" id="submit" value="发送">
									</div>
								</form>
							</div>
						</div>
						<div class="demo-card-wide mdl-card mdl-shadow--2dp" style="min-height:50px !important;margin-bottom: 8px;background-color:#1e1e1e;padding:16px;" align="left">
							<p style="color:#AAA !important;margin-bottom:0px!important;">
								<?=$config[copyright]?>
							</p>
							<p style="color:#666 !important;margin-bottom:0px!important;font-size:12px;">
								Powered by <?=$info_application ?>
							</p>
						</div>
					</div>
				</section>
			</main>
		</div>
	</body>
</html>