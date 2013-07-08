<?php

class LoginAction extends Action {

	public function _initialize() {
		if (isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->redirect('Index/');
		}
	}

	public function _empty() {
		if (isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->redirect('Index');
		}
	}

	public function index() {
//		if (isset($_SESSION['user'])) {
//			$this->redirect('Index/index');
//		}
		$this->display();
	}

	public function index2() {
		$this->display();
	}

	// 用户登录
	public function checkLogin() {
		// 获取页面的用户名和密码
		$name = trim($_POST['name']);
		$pwd  = trim($_POST['pwd']);
//		echo $name;
//		echo $pwd;
		$User   = M('User');
		$rs     = $User->where("name='" . "$name'");
		$db_pwd = $rs->getField('pwd');

		// 存在此用户
		if ($db_pwd != null) {
			// 匹配密码
			if (md5($pwd) == $db_pwd) {
				// 登录成功，跳转到首页
				$_SESSION[C('USER_AUTH_KEY')] = $name;
				$data['data'] = '';
				$data['info'] = '';
				$data['status'] = 1;
				$data = json_encode($data);
				$this->ajaxReturn($data);
//				$autologin = $_POST['autologin'];
				// 自动登录
//				if ($autologin == "autologin") {
//					setcookie('user', $name, time() + 3600 * 24 * 7);
//				}
//				$this->redirect('Index/index');
			} else {
				$data['data'] = '';
				$data['info'] = '密码错误';
				$data['status'] = 0;
				$data = json_encode($data);
				$this->ajaxReturn($data);
//				$vo = array();
//				$this->ajaxReturn($vo, '密码错误！', 1);
//				$this->error('密码错误');
			}
		} else {
			$data['data'] = '';
			$data['info'] = '用户不存在';
			$data['status'] = 0;
			$data = json_encode($data);
			$this->ajaxReturn($data);
//			$vo = array();
//			$this->ajaxReturn($vo, '用户不存在！', 1);
			//$this->error('用户不存在');
		}
	}
}