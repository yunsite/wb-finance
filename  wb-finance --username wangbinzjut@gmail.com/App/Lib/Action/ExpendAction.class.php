<?php

class ExpendAction extends CommonAction {

	public $userId;
	public $categoryList_expend;

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

	// 支出明细
	public function index() {
		$userId = $this->getUserId();
		$Bill   = M('Bill');
		import("@.ORG.Page"); //导入分页类
		$count    = $Bill->where("typeId=1&&userId=$userId")->count(); //计算总数
		$p        = new Page($count, 10);
		$rs       = $Bill->where("typeId=1&&userId=$userId")->limit($p->firstRow . ',' . $p->listRows)->order('time desc')->order('id desc')->select();
		$Category = M('Category');
		foreach ($rs as $va) {
			$id                       = $va['id'];
			$expendList[$id]['id']    = $va['id'];
			$expendList[$id]['money'] = $va['money'];
			$expendList[$id]['time']  = $va['time'];
			$categoryId               = $va['categoryId'];
			$itemRs                   = $Category->where("id=$categoryId")->find();
			$expendList[$id]['item']  = $itemRs['item'];
		}
		$page = $p->show(); //分页的导航条的输出变量
		$this->assign("page", $page);
		$this->assign('expendList', $expendList);
		$this->assign('user', $_SESSION[C('USER_AUTH_KEY')]);
		$categoryList = $this->getCL_expend();
		$this->assign('categoryList', $categoryList);
		$this->display();
	}

	// 删除支出
	public function expend_del() {
		$id   = trim($_GET['id']);
		$Bill = M('Bill');
		$Bill->where("id=$id")->delete();
		$data['status'] = 1;
		$this->ajaxReturn($data);
	}

	// 修改支出记录
	public function expend_update() {
		$id                 = trim($_POST['id']);
		$item               = trim($_POST['item']);
		$data['id']         = $id;
		$data['item']       = $item;
		$data['money']      = trim($_POST['money']);
		$data['time']       = trim($_POST['time']);
		$Category           = M('Category');
		$rsCategory         = $Category->where("item='$item'")->find();
		$data['categoryId'] = $rsCategory['id'];
		$Bill               = M('Bill');
		$Bill->where("id=$id")->save($data);
		$this->ajaxReturn($data);
	}

	// 增加记录
	public function expend_add() {
		$item               = trim($_POST['add_category']);
		$data['money']      = trim($_POST['add_money']);
		$data['time']       = trim($_POST['add_time']);
		$Category           = M('Category');
		$rsCategory         = $Category->where("item='$item'")->find();
		$data['categoryId'] = $rsCategory['id'];
		$Bill               = M('Bill');
		$data['userId']     = $this->getUserId();
		$data['typeId']     = 1;

		if ($Bill->add($data)) {
			$this->redirect('index');
		} else {
			header("Content-Type:text/html; charset=utf-8");
			exit($Bill->getError() . ' [ <a href="javascript:history.back()">返 回</a> ]');
		}
	}

	public function expend_search() {
		$item      = trim($_POST['item']);
		$starttime = trim($_POST['starttime']);
		$endtime   = trim($_POST['endtime']);
		$Bill      = M('Bill');
	}
}