<?php
class UserModel extends Model {
	// 自动验证设置
	protected $_validate = array(
		array('name', 'require', '请输入用户名！', 1),
		array('pwd', 'require', '请输入密码！', 1),
	);
}