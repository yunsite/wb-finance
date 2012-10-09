<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>支出</title>
<link rel="stylesheet" type="text/css" href="__TMPL__/jquery-easyui-1.3.1/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="__TMPL__/jquery-easyui-1.3.1/themes/icon.css" />
<script type="text/javascript" src="__TMPL__/jquery-easyui-1.3.1/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__TMPL__/jquery-easyui-1.3.1/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__TMPL__/jquery-easyui-1.3.1/locale/easyui-lang-zh_CN.js"></script>

<link rel="stylesheet" type="text/css" href="__TMPL__/Main/Css/main.css" />
<script type="text/javascript" src="__TMPL__/Main/Js/main.js"></script>
<script type="text/javascript" src="__TMPL__/Public/Js/common.js"></script>
</head>
<script language="javascript">
function add() {
	$('#tt').tabs('add',{
		title: '增加支出',
		href: '__URL__/expend_add',
		closable: true
	});
}
function update($querystr) {
	$('#tt').tabs('add',{
		title: '修改支出',
		href: '__URL__/expend_update?' + $querystr,
		closable: true
	});
}
</script>
<body>
<div id="tt" class="easyui-tabs" style="width:auto; height:auto;">

	<div title="支出明细" style="padding: 20px;">	
		<form action="" method="get">
		<table id="expend" class="table">
			<tr>
				<td colspan="5" style="background:#E0ECFF;">
					<input type="button" class="button" value="增加" onclick="add()" />&nbsp;
					<input type="button" class="button" value="删除" />&nbsp;
				</td>
			</tr>
			<tr>
				<th width="20px"><input id="ck" type="checkbox"></th>
				<th width="100px">类 别</th>
				<th width="100px">金 额</th>
				<th width="100px">时 间</th>
				<th width="100px">操 作</th>
			</tr>
			<!-- 循环将数据输出 -->
			<?php if(is_array($expendList)): $i = 0; $__LIST__ = $expendList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><input type="checkbox"></td>
					<td><?php echo ($vo["item"]); ?></td>
					<td><?php echo ($vo["money"]); ?>元</td>
					<td><?php echo ($vo["time"]); ?></td>
					<td><a style="cursor:pointer" title="删除" onclick="del(<?php echo ($vo["id"]); ?>, 'expend')"><img src="../Public/Images/del.png" border="0" /></a> 
						<a style="cursor:pointer" title="修改" onclick="update('id=<?php echo ($vo["id"]); ?>&item=<?php echo ($vo["item"]); ?>&money=<?php echo ($vo["money"]); ?>&time=<?php echo ($vo["time"]); ?>')">
							<img src="../Public/Images/alter.png" border="0" /></a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		<!-- <div id="pagination" data-options="total:<?php echo ($total); ?>" class="easyui-pagination"></div>分页 -->
		</form>
	</div>
	
	<!-- 搜索部分 -->
	<div title="搜索" style="padding: 20px;">
		类别：
		<select class="easyui-combobox" style="width:100px;" data-options="multiple:true, editable:false">
			<?php if(is_array($categoryList_expend)): foreach($categoryList_expend as $key=>$vo): ?><option value="<?php echo ($vo["item"]); ?>"><?php echo ($vo["item"]); ?></option><?php endforeach; endif; ?>
		</select>
		&nbsp;&nbsp;起止时间：
		<input name="startTime" class="easyui-datebox" style="width:85px;" data-options="editable:false" />
		- <input name="endTime" class="easyui-datebox" style="width:85px;" data-options="editable:false"/>
		&nbsp;<input type="button" class="button" style="heigth:10px;" value="搜索" />
		<br/>
		<br/>
		<form action="" method="get">
		<table id="expendSearch" class="table">
			<tr>
				<th width="100px">类 别</th>
				<th width="100px">金 额</th>
				<th width="100px">时 间</th>
				<th width="100px">操 作</th>
			</tr>
			<!-- 循环将数据输出 -->
			<?php if(is_array($expendSearchList)): $i = 0; $__LIST__ = $expendSearchList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($vo["item"]); ?></td>
					<td><?php echo ($vo["money"]); ?>元</td>
					<td><?php echo ($vo["time"]); ?></td>
					<td><a href="__URL__/expend_del?id=<?php echo ($vo["id"]); ?>" title="删除"><img src="../Public/Images/del.png" border="0" /></a> 
						<a style="cursor:pointer" title="修改" onclick="update('id=<?php echo ($vo["id"]); ?>&item=<?php echo ($vo["item"]); ?>&money=<?php echo ($vo["money"]); ?>&time=<?php echo ($vo["time"]); ?>')">
							<img src="../Public/Images/alter.png" border="0" /></a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		</form> 
	</div>
</div>

<!-- 
<div id="updateWin" class="easyui-window" style="width:300px;height:230px;" data-options="
		closed: true,
		modal: true,
		title: '修改记录',
		minimizable: false,
		maximizable: false,
		collapsible: false,
		resizable: false">
	<div id="update">
		<table cellpadding="5">
			<tr>
				<td width="60px">类别</td>
				<td>
					<select id="cc" class="easyui-combobox" name="category" style="width:120px" data-options="required:true,editable:false">
						<?php if(is_array($categoryList)): foreach($categoryList as $key=>$vo): ?><option value="<?php echo ($vo["item"]); ?>"><?php echo ($vo["item"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>金额</td>
				<td><input id="vv" class="easyui-numberbox" style="width:115px;" data-options="required:true" /></td>
			</tr>
			<tr>
				<td>时间</td>
				<td><input id="dd" type="text" class="easyui-datebox" style="width:120px;"  required="required" /></td>
			</tr>
		</table>
		<div style="margin:20px;">
			<input type="button" class="button" value="修改" />&nbsp;
			<input type="button" class="button" value="取消" onclick="updateClose()" style="float:right" />
		</div>
		
	</div>
</div>
-->
</body>
</html>