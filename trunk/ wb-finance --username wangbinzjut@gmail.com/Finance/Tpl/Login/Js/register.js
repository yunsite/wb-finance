$(document).ready(function () {
	var db_names;
	var name = $('#regName');
	var pwd = $('#regPwd');
	var repwd = $('#regRepwd');
	var error = $('#regError');
	var errorInfo = $('#regErrorInfo');

	// 检测用户名是否存在
	name.bind('keyup changed', checkRegisterName);

	// 在首页点击注册按钮后，得到所有注册用户名
	$('#registerLink').click(function() {
		$.ajax({
			url: 'getRegisterNames',
			type: 'post',
			data: {name: $(this).val()},
			success: function (data) {
				var jsonData = eval('(' + data + ')');
				db_names = jsonData['db_names'];
			},
			error: function (data) {
				alert('unknown error!');
			}
		});
	});

	// 点击注册
	$('#btnRegister').click(function () {
		name.bind('keyup changed', validate);
		pwd.bind('keyup changed', validate);
		repwd.bind('keyup changed', validate);

		if (name.val() == '') {
			name.next().remove();
			name.after('<span class="alert alert-error">请输入用户名！</span>');
			return false;
		} else if (pwd.val() == '') {
			pwd.next().remove();
			pwd.after('<span class="alert alert-error">请输入密码！</span>');
			return false;
		} else if (repwd.val() == '') {
			repwd.next().remove();
			repwd.after('<span class="alert alert-error">请再次输入密码！</span>');
			return false;
		}

		if (pwd.val() != repwd.val()) {
			error.slideDown('fast');
			errorInfo.html('两次密码不同，请重新输入！');
			pwd.attr('value', '');
			repwd.attr('value', '');
			pwd.focus();
			return false;
		}

		$.ajax({
			url: 'register',
			type: 'post',
			data: {name: name.val(), pwd: pwd.val()},
			success: function (data) {
				$('#register').modal('hide');
				$('#login').modal('show');
			},
			error: function () {
				alert('unknown error!');
			}
		});
	});

	function validate() {
		if (name.val() != '') name.next().remove();
		if (pwd.val() != '') pwd.next().remove();
		if (repwd.val() != '') repwd.next().remove();
		error.slideUp('fast');
	}

	// 检测用户名是否存在
	function checkRegisterName() {
		name.next().remove();
		for (var i = 0; i < db_names.length; i++) {
			if ($(this).val() == db_names[i]) {
				name.next().remove();
				name.after('<span class="alert alert-error">该用户名已存在！</span>');
			}
		}
	}
});