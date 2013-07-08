<?php

class PublicAction extends CommonAction {

/*	public function checkUser() {
		if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
			redirect('Login/');
		}
		//if (!isset($_COOKIE['user'])) {
		//	redirect('Login/login');
		//}
	}*/

	public function header() {
		//$this->checkUser();
		$this->assign('user', $_SESSION[C('USER_AUTH_KEY')]);
		//$this->assign('us', 'aaa');
/*		$time = date("Y-m-d");
		$this->assign('time', $time);*/
		$this->display();
	}

	public function header2() {
		//$this->checkUser();
		$this->assign('user', $_SESSION[C('USER_AUTH_KEY')]);
		$time = date("Y-m-d");
		$this->assign('time', $time);
		$this->display();
	}

	public function nav() {
		$this->assign('user', $_SESSION[C('USER_AUTH_KEY')]);
		$this->display();
	}

	public function main() {
		$this->display();
	}

	public function footer() {
		$this->display();
	}

	public function logout() {

		if (isset($_SESSION[C('USER_AUTH_KEY')])) {
			echo "session is set";
			$_SESSION = array();
			session_destroy();
		}
		$this->redirect('Login/');
//		if (isset($_COOKIE['user'])) {
//			setcookie('user', '', time() - 1);
//			//setcookie('PHPSESSID', '', time() - 1);
//			//echo "dsfsdf";
//		}
//		$Index = new IndexAction();
//		$Index->index();

	}
}