<?php
class CommonAction extends Action {

	/**
	 * 初始化，加载并缓存用户设置
	 * 如果继承本类的类自身也需要初始化，
	 * 那么需要在使用本继承类的类里使用parent::_initialize();
	 */
	public function _initialize() {
		// 判断是否有登录，没有登录跳转到登录窗口
		if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->redirect('Login/index');
		}
	}

	/**
	 * 空操作,对于未定义的操作进行报错
	 */
	public function _empty() {
		$this->error("请求的页面不存在");
	}
}