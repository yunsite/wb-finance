function checkpwd($value) {
	$pwd = document.pwdform.pwd.value;
	$newpwd = document.pwdform.newpwd.value;
	$repwd = document.pwdform.repwd.value;
	if ($pwd == "" || $newpwd == "" || $repwd == "") {
		$.messager.alert('提示', '请将信息填写完整！', 'info');
		return false;
	}
	if ($value != $pwd) {
		$.messager.alert('提示', '原密码不正确！', 'info');
		document.pwdform.pwd.value = "";
		document.pwdform.newpwd.value = "";
		document.pwdform.repwd.value = "";
		return false;
	}
	if ($newpwd != $repwd) {
		$.messager.alert('提示', '两次密码输入不一样！', 'info');
		document.pwdform.newpwd.value = "";
		document.pwdform.repwd.value = "";
		return false;
	}
}

function del($id, $in_ex) {
	$.messager.confirm('删除', '确定删除该项记录吗？', function(r){
		if (r) {
			if ($in_ex == 'expend')
				location.href = "expend_del?id=" + $id;
			else if ($in_ex == 'income')
				location.href = "income_del?id=" + $id;
		}
	});
}

function delCategory($id) {
	$.messager.confirm('删除', '删除该类别将删除所有用户在该类别下的记录。确定要删除吗？', function(r){
		if (r) {
			location.href = "system_delCategory?id=" + $id;
		}
	});
}

function delUser($id, $name) {
	$.messager.confirm('删除', '删除该用户将删除该用户的所有记录。确定要删除吗？', function(r){
		if (r) {
			location.href = "system_delUser?id=" + $id;
		}
	});
}