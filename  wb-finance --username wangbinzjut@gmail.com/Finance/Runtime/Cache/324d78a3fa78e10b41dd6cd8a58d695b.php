<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>消费柱状图</title>
<link rel="stylesheet" type="text/css" href="__TMPL__/jquery-easyui-1.3.1/themes/default/easyui.css" />
<script type="text/javascript" src="__TMPL__/jquery-easyui-1.3.1/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__TMPL__/jquery-easyui-1.3.1/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__TMPL__/jquery-easyui-1.3.1/locale/easyui-lang-zh_CN.js"></script>

<script type="text/javascript" src="__TMPL__/ExtJs/ext-all.js"></script>
<script type="text/javascript" src="__TMPL__/ExtJs/locale/ext-lang-zh_CN.js"></script>
<link rel="stylesheet" type="text/css" href="__TMPL__/ExtJs/resources/css/ext-all.css" />

<link rel="stylesheet" type="text/css" href="__TMPL__/Main/Css/main.css" />
<script type="text/javascript" src="__TMPL__/Public/Js/common.js"></script>
<script type="text/javascript" src="__TMPL__/Main/Js/expend_column.js"></script>

</head>
<body onload="getData(<?php echo ($data); ?>)">
<div id="tt" class="easyui-tabs" style="width:auto; height:auto;">
	<div title="消费柱状图" style="padding:20px;">
		<form action="__URL__/expend_column" method="get">
			<label>年份：</label><input type="text" name="year" class="easyui-numberbox" style="height:25px;width:80px;font-size:16px;" />
			<input type="submit" name="submit" class="button" style="heigth:10px;" value="确定" />
		</form>
		<br/>
		<label><?php echo ($year); ?>年的消费情况</label><br/><br/>
		<div id="expend_column"></div>
	</div>
</div>
</body>
</html>