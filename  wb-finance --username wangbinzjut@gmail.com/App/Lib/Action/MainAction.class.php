<?php

class MainAction extends Action {

	public $userId;
	public $categoryList_expend;
	public $categoryList_income;

	public function a() {
		$this->display();
	}

	// 得到用户ID
	public function getUserId() {
		$User = M('User');
		$name = $_SESSION['user'];
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

	// 增加记录
	public function add($type, $inex) {
		$category           = $_GET['category'];
		$data['money']      = $_GET['money'];
		$data['time']       = $_GET['time'];
		$Category           = M('Category');
		$rsCategory         = $Category->where("item='$category'")->find();
		$data['categoryId'] = $rsCategory['id'];
		$Bill               = M('Bill');
		$user               = $_SESSION['user'];
		$User               = M('User');
		$rsUser             = $User->where("name='$user'")->find();
		$data['userId']     = $rsUser['id'];
		$data['typeId']     = $type;
		$Bill->add($data);
		if ($inex == 'expend') {
			$this->redirect('Main:expend');
		} else if ($inex == 'income') {
			$this->redirect('Main:income');
		}
	}

	// 更新记录
	public function update($inex) {
		$id                 = $_GET['id'];
		$category           = $_GET['category'];
		$data['id']         = $id;
		$data['money']      = $_GET['money'];
		$data['time']       = $_GET['time'];
		$Category           = M('Category');
		$rsCategory         = $Category->where("item='$category'")->find();
		$data['categoryId'] = $rsCategory['id'];
		$Bill               = M('Bill');
		$Bill->where("id=$id")->save($data);
		if ($inex == 'expend') {
			$this->redirect('Main:expend');
		} else if ($inex == 'income') {
			$this->redirect('Main:income');
		}
	}

	// 将记录加载到页面
	public function update_init($typeId) {
		$this->assign('id', $_GET['id']);
		$this->assign('category', $_GET['item']);
		$this->assign('money', $_GET['money']);
		$this->assign('time', $_GET['time']);
		$Category     = M('Category');
		$categoryList = $Category->where("typeId=$typeId")->select();
		$this->assign('categoryList', $categoryList);
	}

	// 支出明细
	public function expend() {
		//"pageIndex=" + (pageIndex) + "&pageSize=" + pageSize
//		$pageIndex = $_GET['pageIndex'];
//		$pageSize = $_GET['pageSize'];
//		echo $pageIndex;
//		echo "<br/>";
//		echo $pageSize;
		$userId = $this->getUserId();
		$Bill   = M('Bill');
		//$rs = $Bill->where("typeId=1&&userId=$userId")->limit("($pageIndex-1)*$pageSize, $pageSize")->select();
		$rs = $Bill->where("typeId=1&&userId=$userId")->select();
		//$expendTotal = $Bill->where("typeId=1&&userId=$userId")->limit("($pageIndex-1)*$pageSize, $pageSize")->count();
		$expendTotal         = $Bill->where("typeId=1&&userId=$userId")->count();
		$Category            = M('Category');
		$categoryList_expend = $this->getCL_expend();
//		echo $expendTotal;
		foreach ($rs as $va) {
			$id                       = $va['id'];
			$expendList[$id]['id']    = $va['id'];
			$expendList[$id]['money'] = $va['money'];
			$expendList[$id]['time']  = $va['time'];
			$categoryId               = $va['categoryId'];
			$itemRs                   = $Category->where("id=$categoryId")->find();
			$expendList[$id]['item']  = $itemRs['item'];
		}
		$this->assign('total', $expendTotal);
		$this->assign('expendList', $expendList);
		$this->assign('categoryList_expend', $categoryList_expend);
		$this->display();
	}

	/*	public function expend() {
			$userId = $this->getUserId();
			$Bill = M('Bill');
			$rs = $Bill->where("typeId=1&&userId=$userId")->select();
			$expendTotal = $Bill->where("typeId=1&&userId=$userId")->count();
			$Category = M('Category');
			$categoryList_expend = $this->getCL_expend();

			foreach ($rs as $va) {
				$id = $va['id'];
				$expendList[$id]['id'] = $va['id'];
				$expendList[$id]['money'] = $va['money'];
				$expendList[$id]['time'] = $va['time'];
				$categoryId = $va['categoryId'];
				$itemRs = $Category->where("id=$categoryId")->find();
				$expendList[$id]['item'] = $itemRs['item'];
			}
			$this->assign('total', $expendTotal);
			$this->assign('expendList', $expendList);
			$this->assign('categoryList_expend', $categoryList_expend);
			$this->display();
		}
	*/

	// 增加支出
	public function expend_add() {
		if (!empty($_GET['submit'])) {
			$this->add(1, 'expend');
		} else {
			$Category     = M('Category');
			$categoryList = $Category->where("typeId=1")->select();
			$this->assign('categoryList', $categoryList);
			$this->display();
		}
	}

	// 删除支出
	public function expend_del() {
		$id   = $_GET['id'];
		$Bill = M('Bill');
		$Bill->where("id=$id")->delete();
		$this->redirect('Main:expend');
	}

	// 修改支出
	public function expend_update() {
		if (!empty($_GET['submit'])) {
			$this->update('expend');
		} else if (!empty($_GET['id'])) {
			$this->update_init(1);
			$this->display();
		}
	}

	// 消费柱状图
	public function expend_column() {
		$year = date("Y");
		if (!empty($_GET['submit'])) {
			$year = $_GET['year'];
		}
		$Bill   = M('Bill');
		$userId = $this->getUserId();
		$rs     = $Bill->where("year(time)=$year and userId=$userId and typeId=1")->select();
		foreach ($rs as $va) {
			$str   = explode("-", $va['time']);
			$month = (int)$str[1];
			$data[$month] += $va['money'];
		}
		for ($i = 0; $i < 12; $i++) {
			$data1[$i] = $data[$i + 1];
		}
		$dataJson = json_encode($data1);
		$this->assign('year', $year);
		$this->assign('data', $dataJson);
		$this->display();
	}

	// 收入明细
	public function income() {
		$Bill                = M('Bill');
		$userId              = $this->getUserId();
		$rs                  = $Bill->where("typeId=0&&userId=$userId")->select();
		$Category            = M('Category');
		$categoryList_income = $this->getCL_income();

		foreach ($rs as $va) {
			$id                       = $va['id'];
			$incomeList[$id]['id']    = $va['id'];
			$incomeList[$id]['money'] = $va['money'];
			$incomeList[$id]['time']  = $va['time'];
			$categoryId               = $va['categoryId'];
			$itemRs                   = $Category->where("id=$categoryId")->find();
			$incomeList[$id]['item']  = $itemRs['item'];
		}
		$this->assign('incomeList', $incomeList);
		$this->assign('categoryList_income', $categoryList_income);
		$this->display();
	}

	// 增加收入
	public function income_add() {
		if (!empty($_GET['submit'])) {
			$this->add(0, 'income');
		} else {
			$Category     = M('Category');
			$categoryList = $Category->where("typeId=0")->select();
			$this->assign('categoryList', $categoryList);
			$this->display();
		}
	}

	// 删除收入
	public function income_del() {
		$id   = $_GET['id'];
		$Bill = M('Bill');
		$Bill->where("id=$id")->delete();
		$this->redirect('Main:income');
	}

	// 修改收入
	public function income_update() {
		if (!empty($_GET['submit'])) {
			$this->update('income');
		} else if (!empty($_GET['id'])) {
			$this->update_init(0);
			$this->display();
		}
	}

	// 修改密码
	public function user_pwd() {
		if (!empty($_POST['submit'])) {
			$user        = $_SESSION['user'];
			$newpwd      = $_POST['newpwd'];
			$data['pwd'] = md5($newpwd);
			$User        = M('User');
			$User->where("name='$user'")->save($data);
			unset($_SESSION['user']);
			unset($_SESSION['pwd']);
			$this->assign('refresh', true);
			$this->display();
		} else {
			$this->assign('pwd', $_SESSION['pwd']);
			$this->display();
		}
	}

	// 收支类别
	public function system_category() {
		$Category            = M('Category');
		$categoryList_expend = $this->getCL_expend();
		$categoryList_income = $this->getCL_income();
		$this->assign('categoryList_expend', $categoryList_expend);
		$this->assign('categoryList_income', $categoryList_income);
		$this->display();
	}

	// 增加类别
	public function addCategory($type) {
		$item         = $_GET['item'];
		$Category     = M('Category');
		$data['item'] = $item;
		if ($type == 'expend') {
			$data['typeId'] = 1;
		} else {
			$data['typeId'] = 0;
		}
		$Category->add($data);
		$this->redirect('Main:system_category');
	}

	// 增加支出类别
	public function system_addExpend() {
		if (!empty($_GET['submit'])) {
			$this->addCategory('expend');
		}
	}

	// 增加收入类别
	public function system_addIncome() {
		if (!empty($_GET['submit'])) {
			$this->addCategory('income');
		}
	}

	// 删除类别
	public function system_delCategory() {
		$Category   = M('Category');
		$categoryId = $_GET['id'];
		$Bill       = M('Bill');
		$Bill->where("categoryId=$categoryId")->delete();
		$Category->where("id=$categoryId")->delete();
		$this->redirect('Main:system_category');
	}

	// 用户管理
	public function system_userManage() {
		$User     = M('User');
		$userList = $User->select();
		$this->assign('userList', $userList);
		$this->display();
	}

	// 删除用户
	public function system_delUser() {
		$id   = $_GET['id'];
		$Bill = M('Bill');
		$Bill->where("userId=$id")->delete();
		$User = M('User');
		$User->where("id=$id")->delete();
		$this->redirect('Main:system_userManage');
	}
}