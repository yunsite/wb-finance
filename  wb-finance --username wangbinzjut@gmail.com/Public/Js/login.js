//$(
//	function () {
//
//		var name = $('#name');
//		var pwd = $('#pwd');
//		var error = $('#error');
//		var errorInfo = $('#errorInfo');
//
//		$('#loginForm').ajaxForm({
//			beforeSubmit: checkForm  // pre-submit callback
//		});
//
//		function checkForm() {
//			if ('' == $.trim(name.val())) {
//				errorInfo.html('请输入用户名！');
//				error.show();
//				return false;
//			}
//			if ('' == $.trim(pwd.val())) {
//				errorInfo.html('请输入密码！');
//				error.show();
//				return false;
//			}
//		}
//	}
//);


$(document).ready(function () {
	var name = $('#name');
	var pwd = $('#pwd');
	var error = $('#error');
	var errorInfo = $('#errorInfo');

	$('#btnLogin').click(function () {
		name.bind('keyup changed', validate);
		pwd.bind('keyup changed', validate);

		if (name.val() == '') {
			name.next().remove();
			name.after('<span class="alert alert-error">请输入用户名！</span>');
			return false;
		} else if (pwd.val() == '') {
			pwd.next().remove();
			pwd.after('<span class="alert alert-error">请输入密码！</span>');
			return false;
		}

//		$.ajax({
//			url: 'checkLogin',
//			type: 'post',
//			data: {name: name.val(), pwd: pwd.val()},
//			success: function (data) {
//				var jsonData = eval('(' + data + ')');
//				if (jsonData['status'] == 1) {
//					window.location = 'Index/index';
//				} else {
//					error.slideDown('fast');
//					errorInfo.html(jsonData.info);
//				}
//			},
//			error: function (data) {
//				alert('error');
//			}
//		});
	});

	function validate() {
		if (name.val() != '') name.next().remove();
		if (pwd.val() != '') pwd.next().remove();
		error.slideUp('fast');
	}
});