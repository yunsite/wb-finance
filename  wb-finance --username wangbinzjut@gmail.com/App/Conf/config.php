<?php
return array(
	'DB_TYPE'              => 'mysql',
	'DB_HOST'              => 'localhost',
	'DB_NAME'              => 'wb_finance',
	'DB_USER'              => 'root',
	'DB_PWD'               => '123456',
	'DB_PORT'              => '3306',
	'DB_PREFIX'            => 'wb_',

	'SHOW_ERROR_MSG'       => true,
	'SHOW_PAGE_TRACE'      => true,
//	'APP_DEBUG'            => true,
	'URL_MODEL'            => 2,
	'SESSION_AUTO_START'   => true, // 自动开启session
	'URL_CASE_INSENSITIVE' => true,
	'USER_AUTH_KEY'        => 'finance_user_name',
	'Appname'              => '个人理财系统',
	'App'                  => '__ROOT__/Finance',
	'VAR_PAGE'             => 'p',
);