<?php

class PublicAction extends CommonAction {

	public function header() {
		$this->assign('user', $_SESSION[C('USER_AUTH_KEY')]);
		$this->display();
	}

	public function footer() {
		$this->display();
	}

	public function logout() {
//		if (isset($_COOKIE[C('USER_AUTH_KEY')])) {
//			setcookie($_COOKIE[C('USER_AUTH_KEY')], time() - 1);
//		}
		if (isset($_SESSION[C('USER_AUTH_KEY')])) {
			echo "session is set";
			$_SESSION = array();
			session_destroy();
		}
		$this->redirect('Login/');
	}
}