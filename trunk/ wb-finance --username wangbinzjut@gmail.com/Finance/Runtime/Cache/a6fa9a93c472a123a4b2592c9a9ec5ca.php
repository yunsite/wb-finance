<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo (C("Appname")); ?>——登陆</title>
<link rel="stylesheet" href="__TMPL__/Public/Css/common.css" type="text/css" />
<script type="text/javascript" src="__TMPL__/Public/Js/jquery.js"></script>
<script type="text/javascript" src="__TMPL__/Public/Js/common.js"></script>
<link rel="stylesheet" href="__TMPL__/Login/Css/login.css" type="text/css" />
</head>
<body>
<form action="login" method="post">
<div id="login">
<?php if($msg != null): ?><div id="error">
		错误: <?php echo ($msg); ?>
	</div><?php endif; ?>
<div id="loginform">
	<label for="name">用户名</label><input class="input_large" id="name" name="name" value="<?php echo ($name); ?>" type="text" /><br/>
	<label for="pwd">密码</label><input class="input_large" id="pwd" name="pwd" value="<?php echo ($pwd); ?>" type="password" />
	<label for="autologin"><input type="checkbox" id="autologin" name="autologin" value="autologin"> 下次自动登录</label><br/><br/>
	<div id="btns">
		<input type="submit" class="button" value="登录" />
		<input type="button" class="button" value="注册" onclick="window.location.href='register'" /><br/>
	</div>
</div>
</div>
</form>
</body>
</html>