<?php

class LoginAction extends Action
{
	public function index()
	{
		if (isset($_SESSION['user'])) {
			$this->redirect('Index/index');
		}
		$this->display();
	}

	public function test() {
		$this->display();
	}

	// 用户登录
	public function checkLogin()
	{
		// 获取页面的用户名和密码
		$name = trim($_POST['name']);
		$pwd = trim($_POST['pwd']);

		$User = M('User');
		$rs = $User->where("name='" . "$name'");
		$db_pwd = $rs->getField('pwd');

		// 存在此用户
		if ($db_pwd != null) {
			// 匹配密码
			if (md5($pwd) == $db_pwd) {
				// 登录成功，跳转到首页
				$_SESSION['user'] = $name;
				$_SESSION['pwd'] = $pwd;
				$data['status'] = 1;
				$this->ajaxReturn($data);
				$autologin = $_POST['autologin'];
				// 自动登录
				if ($autologin == "autologin") {
					//setcookie('user', $name, time() + 3600 * 24 * 7);
				}
				$this->redirect('Index/index');
			} else {
				$data['data'] = '';
				$data['info'] = '密码错误';
				$data['status'] = 0;
				$this->ajaxReturn($data);
			}
		} else {
			$data['data'] = '';
			$data['info'] = '用户不存在';
			$data['status'] = 0;
			$this->ajaxReturn($data);
		}
	}

	// 得到所有注册用户名
	public function getRegisterNames() {
		$User = M('User');
		$rs = $User->select();
		$data['status'] = 1;
		$i = 0;
		foreach ($rs as $va) {
			$data['db_names'][$i] = $va['name'];
			$i++;
		}
		$this->ajaxReturn($data);
		//print_r($data['db_names']);
	}

	// 用户注册
	public function register()
	{
		// 获取页面的用户名和密码
		$name = trim($_POST['name']);
		$pwd = trim($_POST['pwd']);

		$User = M('User');
		$data['name'] = $name;
		$data['pwd'] = md5($pwd);
		$data['reg_time'] = date("Y-m-d H:i:s");
		$User->add($data);

		$ajaxData['status'] = 1;
		$this->ajaxReturn($ajaxData);
	}
}

?>