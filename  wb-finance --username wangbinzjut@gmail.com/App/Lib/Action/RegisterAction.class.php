<?php

class RegisterAction extends Action {

	// 得到所有注册用户名
	public function getRegisterNames() {
		$User           = M('User');
		$rs             = $User->select();
		$data['status'] = 1;
		$i              = 0;
		foreach ($rs as $va) {
			$data['db_names'][$i] = $va['name'];
			$i++;
		}
		$data = json_encode($data);
		$this->ajaxReturn($data);
	}

	public function checkRegister() {
		// 获取页面的用户名和密码
		$name = trim($_POST['name']);
		$pwd  = trim($_POST['pwd']);

		$data['name'] = $name;
		$data['pwd']  = md5($pwd);
		date_default_timezone_set('Asia/Shanghai');
		$data['reg_time'] = date("Y-m-d H:i:s");
		$User = M('User');
		$User->add($data);

		$result['status'] = 1;
		$result['info']   = '注册成功';
		$result           = json_encode($result);
		$this->ajaxReturn($result);
	}
}