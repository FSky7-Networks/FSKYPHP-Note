<?php
	/*
		FSKYPHP-Note
		
		模块 : 模板 - Wishes
		时间 : 2018/12/01
		环境 : Win7+Nginx1.12+MySQL5.5+PHP7.1
		编写 : FlyingSky
		检查 : FlyingSky
		版本 : Release 3.0
		
		Copyright 2018 FlyingSky .
	*/
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$config['name']?> - <?=$config['title']?></title>
		<link rel="stylesheet" href="<?=$config['cdn']?>FlyingSky/1833/cover.css">
		<link rel="stylesheet" href="<?=$config['cdn']?>GoogleMDL/icon.css">
		<link rel="stylesheet" href="<?=$config['cdn']?>GoogleMDL/material.<?=$config['style']?>.min.css">
		<link rel="icon" type="image/ico" href="<?=$config['ico']?>">
		<script defer src="<?=$config['cdn']?>GoogleMDL/material.min.js"></script>
		<style>
			.demo-card-wide.mdl-card {
				width: auto;
				margin-top:8px;
				margin-left:8px;
				margin-right:8px;
				opacity:0.95;
				max-width:512px;
			}
			.demo-card-wide > .mdl-card__title {
				color: #fff;
				height: 176px;
				background: url('<?=$config['headimage']?>') center / cover;
			}
			.demo-card-wide > .mdl-card__menu {
				color: #fff;
			}
			.mdl-button {
				margin:8px;
			}
		</style>
		<script>
			//淡入效果
			function fadeIn(elem, speed, opacity){ 
				/* 
				* 参数说明 
				* elem==>需要淡入的元素 
				* speed==>淡入速度,正整数(可选) 
				* opacity==>淡入到指定的透明度,0~100(可选) 
				*/
				speedspeed = speed || 25; 
				opacityopacity = opacity || 1; 
				//显示元素,并将元素值为0透明度(不可见) 
				elem.style.display = 'block'; 
				elem.style.opacity = 0; 
				//初始化透明度变化值为0 
				var val = 0; 
				//循环将透明值以5递增,即淡入效果 
				(function(){ 
					elem.style.opacity = val; 
					val += 0.05; 
					if (val <= opacityopacity) { 
						setTimeout(arguments.callee, speedspeed) 
					} 
				})(); 
			} 
			  
			function fadeOut(elem){ 
				elem.style.display = 'none'; 
			}

			//Ajax
			function loadXMLDoc(link)
			{
				var xmlhttp;
				if (window.XMLHttpRequest)
				{
					//  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
					xmlhttp=new XMLHttpRequest();
				}
				else
				{
					// IE6, IE5 浏览器执行代码
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						fadeOut(document.getElementById("message"));
						document.getElementById("message").innerHTML=xmlhttp.responseText;
						fadeIn(document.getElementById("message"));
					}
				}
				xmlhttp.open("GET",link,true);
				xmlhttp.send();
			}
			
			function UpPage(pages)
			{
				if (page<=1)
				{
					loadXMLDoc('/template/1833/ajax.php?mod=message&class=1');
				}
				else
				{
					pages -= 1;
					page=pages;
					document.getElementById("pages").innerHTML=pages + " / <?=mysqli_num_rows($data_list)?>";
					loadXMLDoc('/template/1833/ajax.php?mod=message&class=' + page );
				}
			}
			
			function DownPage(pages)
			{
				if (page>=<?=mysqli_num_rows($data_list)?>)
				{
					loadXMLDoc('/template/1833/ajax.php?mod=message&class=<?=mysqli_num_rows($data_list)?>');
				}
				else
				{
					pages += 1;
					page=pages;
					document.getElementById("pages").innerHTML=pages + " / <?=mysqli_num_rows($data_list)?>";
					loadXMLDoc('/template/1833/ajax.php?mod=message&class=' + page );
				}
			}
			
			function LookMessage()
			{
				pages=1;
				page=pages;
				fadeOut(document.getElementById("home"));
				fadeIn(document.getElementById("look"));
				loadXMLDoc('/template/1833/ajax.php?mod=message&class=1');
			}
			
			function NewMessage()
			{
				fadeOut(document.getElementById("home"));
				fadeIn(document.getElementById("new"));
			}
			
			function BackHome()
			{
				fadeOut(document.getElementById("look"));
				fadeOut(document.getElementById("new"));
				fadeIn(document.getElementById("home"));
			}
			
		</script>
		<?php
			if ($config['googleanalytics']) {
		?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?=$config['googleanalytics']?>"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', '<?=$config['googleanalytics']?>');
		</script>
		<?php
			}
		?>
	</head>
	<body>
		<div class="site-wrapper">
			<div class="site-wrapper-inner">
				<div class="cover-container">
					<div class="inner cover">
						<h3>For 1833 - 框女</h3>
						<div id="home" align="center">
							<div class="demo-card-wide mdl-card mdl-shadow--2dp" align="left">
								<div class="mdl-card__title">
									<h2 class="mdl-card__title-text"><?=$config[name]?></h2>
								</div>
								<div class="mdl-card__supporting-text">
									<?php
										if ($config['hikotoko']) { 
											echo $config['hikotoko'];
										} else { 
									?>
									<script type="text/javascript" src="https://api.imjad.cn/hitokoto/?encode=js&charset=utf-8"></script>
									<script>hitokoto()</script>
									<?php } ?>
								</div>
								<div class="mdl-card__menu">
									<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" >
										<i class="material-icons">message</i>
									</button>
								</div>
							</div>
							<?php if ($_GET['warning']) { ?>
							<div class="demo-card-wide mdl-card mdl-shadow--2dp" style="min-height:10px !important;background:#ff9900;color:#885500;" align="left">
								<div class="mdl-card__supporting-text">
									<?=$_GET['warning']?>
								</div>
							</div>
							<?php } ?>
							<div style="padding-top:16px;padding-bottom:16px;">
								<a 
									class="mdl-button mdl-js-button mdl-js-ripple-effect" 
									style="color:#fff;" 
									onclick="NewMessage()"
								>
								   写留言
								</a>
								<a 
									class="mdl-button mdl-js-button mdl-js-ripple-effect" 
									style="color:#fff;" 
									onclick="LookMessage()"
								>
								   查看留言
								</a>
							</div>
						</div>
						<div id="look" align="center" style="display:none;">
							<div id="message" align="center">
							</div>
							<div style="padding-top:16px;padding-bottom:16px;">
								<a 
									class="mdl-button mdl-js-button mdl-js-ripple-effect" 
									style="color:#fff;" 
									onclick="BackHome()"
								>
								   返回
								</a>
								<a 
									class="mdl-button mdl-js-button mdl-js-ripple-effect" 
									style="color:#fff;" 
									onclick="UpPage(page)"
								>
								   上一页
								</a>
								<a 
									class="mdl-button" 
									style="color:#fff;" 
									id="pages"
								>
									1 / <?=mysqli_num_rows($data_list)?>
								</a>
								<a 
									class="mdl-button mdl-js-button mdl-js-ripple-effect" 
									style="color:#fff;" 
									onclick="DownPage(page)"
								>
								   下一页
								</a>
							</div>
						</div>
						<div id="new" align="center" style="display:none;">
							<div class="demo-card-wide mdl-card mdl-shadow--2dp" style="min-height:50px !important;" align="center">
								<div class="mdl-card__supporting-text">
									<form action="./?send=true" method="post">
										<div style="max-width:300px;margin:16px;">
											<div>
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
													<input class="mdl-textfield__input" type="text" name="fromname" id="fromname" value="游客">
													<label class="mdl-textfield__label" for="fromname">来自</label>
												</div>
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
													<input class="mdl-textfield__input" type="text" name="mail" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" id="mail">
													<label class="mdl-textfield__label" for="mail">邮箱</label>
													<span class="mdl-textfield__error">邮箱格式不正确</span>
												</div>
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
													<?php if ($config['toclock']) { ?>
													<input class="mdl-textfield__input" type="text" name="toname" id="toname" value="<?=$config['toclock'] ?>" readonly>
													<?php } else { ?>
													<input class="mdl-textfield__input" type="text" name="toname" id="toname">
													<?php } ?>
													<label class="mdl-textfield__label" for="toname">送给</label>
												</div>
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
													<textarea class="mdl-textfield__input" type="text" rows="5" name="content" id="content" maxlength="1024" width="100%"></textarea>
													<label class="mdl-textfield__label" for="content">内容</label>
												</div>
											</div>
											<input class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="width:auto;margin-top:16px;margin-bottom:0px;padding-left:34px;padding-right:34px;" type="submit" id="submit" value="发送">
											<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="width:auto;margin-top:16px;margin-bottom:0px;" onclick="BackHome()">返回</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="mastfoot">
						<p>
                        	<?=$config['copyright']?><br/>
							Powered by <?=$info_application ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>