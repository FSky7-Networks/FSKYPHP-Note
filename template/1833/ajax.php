<?php
	/*
		FSKYPHP-Note
		
		模块 : 模板 - Wishes | Ajax
		时间 : 2018/12/01
		环境 : Win7+Nginx1.12+MySQL5.5+PHP7.1
		编写 : FlyingSky
		检查 : FlyingSky
		版本 : Release 3.0
		
		Copyright 2018 FlyingSky .
	*/
	
	include('../../command/common.php');
	
	if (!$_GET['mod'] || !$_GET['class']) exit();
	
	if ($_GET['mod'] == "message") {
		$read_all=mysqli_num_rows($data_list); //总记录数
		$read_page=$_GET['class']-1; //当前页面值
		$result=mysqli_query($mysql_conn,"select * from ".$mysql_tag."list order by Id desc limit ".$read_page.",1 ;");
		$rows=mysqli_fetch_array($result)
?>
<div class="demo-card-wide mdl-card mdl-shadow--2dp" style="min-height:50px !important;" align="left">
	<div class="mdl-card__supporting-text" style="border-bottom: 1px solid rgba(0,0,0,.1);background:#F5F5F5;width:100%;">
		<a><?=stripslashes($rows['toname'])?></a>
	</div>
	<div class="mdl-card__supporting-text" style="min-height:50px;">
		<p style="width:100%;font-size:14px;color:black;"><?=stripslashes($rows['content'])?></p>
	</div>
	<div class="mdl-card__supporting-text" style="border-top: 1px solid rgba(0,0,0,.1);background:#F5F5F5;width:100%;">
		来自: <?=stripslashes($rows['fromname'])?> | 时间: <?=stripslashes($rows['lastdate'])?> | #<?=$rows['Id']?> 
	</div>
</div>
<?php
	} elseif ($_GET['mod'] == "new") {
?>

<?php
	}
?>