//js获取项目根路径，如： http://localhost:8080/ems
function getRootPath() {
	//获取当前网址，如： http://localhost:8080/ems/Pages/Basic/Person.jsp
	var curWwwPath = window.document.location.href;
	//获取主机地址之后的目录，如： /ems/Pages/Basic/Person.jsp
	var pathName = window.document.location.pathname;
	var pos = curWwwPath.indexOf(pathName);
	//获取主机地址，如： http://localhost:8080
	var localhostPath = curWwwPath.substring(0, pos);
	//获取带"/"的项目名，如：/ems
	var projectName = pathName.substring(0, pathName.substr(1).indexOf('/') + 1);
	return(localhostPath + projectName);
}

var userList;
var flag = true;	// 是否可提交数据

// 初始化得到所有注册用户
function init() {
	$.ajax({
		url: 'getRegisterNames',
		type: 'post',
		success: function (data) {
			userList = eval("(" + data + ")");
			userList = userList['db_names']
		}
	});
}

window.addEventListener('load', init, false);

$(document).ready(function () {

	var name = $('#name');
	var pwd = $('#pwd');
	var repwd = $('#repwd');
	var result = $('.result');

	name.bind('keypress', keypress);
	pwd.bind('keypress', keypress);
	repwd.bind('keypress', keypress);

	name.bind('keyup', checkRegisterName);

	$('#btnRegister').bind('click', register);

	$('#returnLogin').click(function() {
		window.location = getRootPath() + '/Login/index';
	});

	function keypress(e) {
		if (e.which == 13) {
			register();
		}
	}

	// 检测用户名是否存在
	function checkRegisterName() {
		result.html('&nbsp;');
		flag = true;
		for (var i = 0; i < userList.length; i++) {
			if (name.val() == userList[i]) {
				result.html('该用户名已存在！');
				flag = false;	// 用户已存在，不能提交数据
			}
		}
	}

	function register() {
		if (name.val() == '') {
			result.html('请输入用户名！');
			return false;
		} else if (pwd.val() == '') {
			result.html('请输入密码！');
			return false;
		} else if (repwd.val() == '') {
			result.html('请再次输入密码！');
			return false;
		} else if (pwd.val() != repwd.val()) {
			result.html('两次密码输入不同！');
			return false;
		}

		if (flag) {
			$.ajax({
				url: 'checkRegister',
				type: 'post',
				data: {name: name.val(), pwd: pwd.val()},
				success: function (data) {
					data = eval("(" + data + ")");
					if (data['status'] == 1) {
						result.html('注册成功！');
						window.location = getRootPath() + '/Login/index';
					}
				}
			});
		}
	}
});