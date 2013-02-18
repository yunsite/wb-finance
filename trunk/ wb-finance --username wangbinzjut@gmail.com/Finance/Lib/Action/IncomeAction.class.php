<?php

class IncomeAction extends Action {

	public $userId;
	public $categoryList_income;

	// 得到用户ID
	public function getUserId() {
		$User = M('User');
		$name = $_SESSION['user'];
		$rs = $User->where("name='$name'")->find();
		return $rs['id'];
	}

	// 得到 categoryList_income
	public function getCL_income() {
		$Category = M('Category');
		$rs = $Category->where("typeId=0")->select();
		return $rs;
	}

}

?>