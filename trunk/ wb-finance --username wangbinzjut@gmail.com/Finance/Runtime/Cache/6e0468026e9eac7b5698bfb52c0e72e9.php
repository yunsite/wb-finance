<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($title); ?></title>
<script></script>
</head>
<frameset rows="70, *, 20" border="0" id="body">
	<frame src="__APP__/Public/top" name="top" scrolling="no" >
 	<frameset cols="180,*" border="0">
		<frame src="__APP__/Public/nav" name="nav">
		<frame src="__APP__/Public/main" name="main">
	</frameset>
	<frame src="__APP__/Public/footer" name="footer" scrolling="no" >
</frameset>
</html>