<?php

class PublicAction extends Action {
	
	public function checkUser() {
		if (!isset($_SESSION['user'])) {
			redirect('Login/login');
		}
		//if (!isset($_COOKIE['user'])) {
		//	redirect('Login/login');
		//}
	}
	
	public function top() {
		$this->checkUser();
		$this->assign('user', $_SESSION['user']);
		$time = date("Y-m-d");
		$this->assign('time', $time);
		$this->display();
	}
	
	public function nav() {
		$this->assign('user', $_SESSION['user']);
		$this->display();
	}
	
	public function main() {
		$this->display(); 
	}
	
	public function footer() {
		$this->display();
	}
	
	public function logout() {
		
		if (isset($_SESSION['user'])) {
			unset($_SESSION['user']);
		}
		if (isset($_COOKIE['user'])) {
			setcookie('user', '', time() - 1);
			//setcookie('PHPSESSID', '', time() - 1);
			//echo "dsfsdf";
		}
		$Index = new IndexAction();
		$Index->index();
	}
}

?>