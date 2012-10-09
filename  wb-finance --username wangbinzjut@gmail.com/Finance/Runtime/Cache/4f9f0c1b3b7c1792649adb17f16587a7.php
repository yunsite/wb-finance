<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<link rel="stylesheet" type="text/css" href="__TMPL__/Public/Css/top.css" />
</head>
<body>
<div id="main">
	<div id="sign">
		<h1>我的Money，我做主！ 从此不做月光族~~~</h1>
	</div>
	<div id="welcome">
		<h4>欢迎你! &nbsp;&nbsp;<?php echo ($user); ?>&nbsp;&nbsp;<a href="__URL__/logout" target="_top"> 注销</a></h4>
		<h4>今天是：<?php echo ($time); ?></h4>
	</div>
</div>
</body>
</html>