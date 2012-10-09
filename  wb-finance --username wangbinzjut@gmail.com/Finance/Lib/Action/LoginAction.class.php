<?php

class LoginAction extends Action {
	
	public function login() {
		if (isset($_COOKIE['user'])) {
			$_SESSION['user'] = $_COOKIE['user'];
		}
		if (isset($_SESSION['user'])) {
			$this->redirect('Index/index');
		}
		// 提交表单
		if (isset($_POST['name'])) {
			// 获取页面的用户名和密码
			$name = trim($_POST['name']);
			$pwd = trim($_POST['pwd']);
			if ($name == null) {
				$this->assign('msg', "请填写用户名。");
				$this->display();
			}
			if ($pwd == null) {
				$this->assign('msg', "请填写密码。");
				$this->assign('name', $name);
				$this->assign('pwd', $pwd);
				$this->display();
				return;
			}
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
					$autologin = $_POST['autologin'];
					// 自动登录
					if ($autologin == "autologin") {
						setcookie('user', $name, time() + 3600 * 24 * 7);
					}
					$this->redirect('Index/index');
				} else {
					$this->assign('msg', "密码错误。");
					$this->assign('name', $name);
				}
			} else {
				$this->assign('msg', "用户不存在。");
			}
		}
		$this->display();
	}

	// 更改。。。。。。。输入用户名后能立即判断出该用户是否存在。。。。。。
	public function register() {
		// 提交表单
		if (isset($_POST['name'])) {
			// 获取页面的用户名和密码
			$name = trim($_POST['name']);
			$pwd = trim($_POST['pwd']);
			$repwd = trim($_POST['repwd']);
			if ($name == null || $pwd == null || $repwd == null) {
				$this->assign('msg', "请将信息填写完整。");
				$this->assign('name', $name);
				$this->display();
				return;
			}
			if ($pwd != $repwd) {
				$this->assign('msg', "两次密码不匹配，请重新输入");
				$this->assign('name', $name);
				$this->display();
				return;
			}
			$User = M('User');
			$rs = $User->where("name='" . "$name'");
			$db_name = $rs->getField('name');
			if ($db_name != null) {
				$this->assign('msg', "该用户已存在!");
				$this->display();
				return;
			}
			$data['name'] = $name;
			$data['pwd'] = md5($pwd);
			$data['reg_time'] = date("Y-m-d H:i:s");
			$User->add($data);
			$this->success('2秒钟后转到登录界面！', 'login', 2); 
		}
		$this->display();
	}
}

?>