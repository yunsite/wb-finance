<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<link rel="stylesheet" type="text/css" href="__TMPL__/jquery-easyui-1.3.1/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="__TMPL__/jquery-easyui-1.3.1/themes/icon.css" />
<script type="text/javascript" src="__TMPL__/jquery-easyui-1.3.1/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__TMPL__/jquery-easyui-1.3.1/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__TMPL__/jquery-easyui-1.3.1/locale/easyui-lang-zh_CN.js"></script>

<link rel="stylesheet" type="text/css" href="__TMPL__/Public/Css/nav.css" />
<script type="text/javascript" src="__TMPL__/Public/Js/jquery.js"></script>
<script type="text/javascript" src="__TMPL__/Public/Js/nav.js"></script>
</head>
<body>
<div id="menu">
 
	<dl>
		<dt>收支记录</dt>
		<dd><span><a target="main" id="selected" href="__APP__/Main/expend">支 出 明 细</a></span></dd>
		<dd><span><a target="main" href="__APP__/Main/income">收 入 明 细</a></span></dd>
		<dd><span><a target="main" href="__APP__/Main/expend_column">消费柱状图</a></span></dd>
	</dl>
	<dl>
		<dt>用户信息</dt>
		<dd><span><a target="main" href="__APP__/Main/user_pwd">修 改 密 码</a></span></dd>
	</dl>
	<?php if($user == 'admin'): ?><dl>
		<dt>系统配置</dt>
		<dd><span><a target="main" href="__APP__/Main/system_category">收 支 类 别</a></span></dd>
		<dd><span><a target="main" href="__APP__/Main/system_userManage">用 户 管 理</a></span></dd>
	</dl><?php endif; ?>
</div>

</body>
</html>