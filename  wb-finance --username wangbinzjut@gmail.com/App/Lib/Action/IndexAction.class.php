<?php

class IndexAction extends CommonAction {

	public $userId;
	public $categoryList_expend;
	public $categoryList_income;

	// 得到用户ID
	public function getUserId() {
		$User = M('User');
		$name = $_SESSION[C('USER_AUTH_KEY')];
		$rs   = $User->where("name='$name'")->find();
		return $rs['id'];
	}

	// 得到 categoryList_expend
	public function getCL_expend() {
		$Category = M('Category');
		$rs       = $Category->where("typeId=1")->select();
		return $rs;
	}

	// 得到 categoryList_income
	public function getCL_income() {
		$Category = M('Category');
		$rs       = $Category->where("typeId=0")->select();
		return $rs;
	}

	public function bug() {
		header("Content-Type: text/html; charset=utf-8");
		echo "1、点击支出列表checkbox问题.<br/>";
		echo "2、每个页面加载前检查session，安全性：session['user_shell']=name.pwd.常量  php100 51讲<br/>";
		echo "3、登录超时 php100 52讲<br/>";
		echo "4、自动登录问题<br/>";
		echo "5、金额只能为数字问题<br/>";
	}

	public function test() {
		$time = date("Y-m-d H:i:s");
		echo $time;
		$this->assign('url', 'datagrid_data2.json');
		$this->display();
	}

	public function index() {
//    	if (isset($_COOKIE['user'])) {
//    		$_SESSION['user'] = $_COOKIE['user'];
//			$this->redirect('index');
//		}
//   		if (!isset($_SESSION['user'])) {
//			$this->redirect('Login/index');
//		}
		//if (!isset($_COOKIE['user'])) {
		//	$this->redirect('index');
		//}
		$this->assign('title', '个人理财系统');
		$this->assign('user', $_SESSION[C('USER_AUTH_KEY')]);
		$this->display();
	}

	// 支出明细
//	public function expend() {
//		$userId = $this->getUserId();
//		$Bill = M('Bill');
//		$rs = $Bill->where("typeId=1&&userId=$userId")->select();
//		$expendTotal = $Bill->where("typeId=1&&userId=$userId")->count();
//		$Category = M('Category');
//		$categoryList_expend = $this->getCL_expend();
//		foreach ($rs as $va) {
//			$id = $va['id'];
//			$expendList[$id]['id'] = $va['id'];
//			$expendList[$id]['money'] = $va['money'];
//			$expendList[$id]['time'] = $va['time'];
//			$categoryId = $va['categoryId'];
//			$itemRs = $Category->where("id=$categoryId")->find();
//			$expendList[$id]['item'] = $itemRs['item'];
//		}
//		$this->assign('total', $expendTotal);
//		$this->assign('expendList', $expendList);
//		$this->assign('categoryList_expend', $categoryList_expend);
//		$this->display();
//	}

	// 删除支出
//	public function expend_del() {
//		$id = $_GET['id'];
//		$Bill = M('Bill');
//		$Bill->where("id=$id")->delete();
//		$data['status'] = 1;
//		$this->ajaxReturn($data);
//	}

}