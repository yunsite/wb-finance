<?php

class IndexAction extends Action {
	
	public function bug() {
		header("Content-Type: text/html; charset=utf-8");
		echo "1、记住密码后不能注销.<br/>";
		echo "2、登录时，验证用户名改为实时验证.<br/>";
		echo "3、搜索返回时，只更改当前的tab页面.<br/>";
	}
	
	public function test() {
		$time = date("Y-m-d H:i:s");
		echo $time;
		$this->assign('url', 'datagrid_data2.json');
		$this->display();
	}
	
    public function index(){
    	if (isset($_COOKIE['user'])) {
    		$_SESSION['user'] = $_COOKIE['user']; 
			$this->redirect('index');
		}
   		if (!isset($_SESSION['user'])) {
			$this->redirect('Login/login');
		}
    	//if (!isset($_COOKIE['user'])) {
		//	$this->redirect('index');
		//}
        $this->assign('title', '个人记账系统');
        $this->display();
    }

}

?>