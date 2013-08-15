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

$(document).ready(function () {
	var name = $('#name');
	var pwd = $('#pwd');
	var result = $('.result');

	name.bind('keypress', keypress);
	pwd.bind('keypress', keypress);

	$('#btnLogin').bind('click', login);

	function keypress(e) {
		if (e.which == 13) {
			login();
		}
	}

	function login() {
		if (name.val() == '') {
			result.html('请输入用户名！');
			return false;
		} else if (pwd.val() == '') {
			result.html('请输入密码！');
			return false;
		}

		$.ajax({
			url: 'checkLogin',
			type: 'post',
			data: {name: name.val(), pwd: pwd.val()},
			success: function (data) {
				data = eval("(" + data + ")");
				if (data['status'] == 1) {
					window.location = getRootPath() + '/Index/index';
				} else {
					result.html(data['info']);
				}
			}
		});
	}

	$('#btnRegister').click(function() {
		window.location = getRootPath() + '/Register/index';
	});
});