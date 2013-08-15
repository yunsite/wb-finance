function initiate() {
	$('#add_time,#update_time').datepicker({
		format: "yyyy-mm-dd",
		language: "zh-CN"
	});
}

function del(id, in_ex) {
	// 使用ajax方式提交，删除某项后不刷新整个页面，只更新表格。
	if (in_ex == 'expend') {
		$.ajax({
			url: "expend_del?id=" + id,
			type: 'get',
			success: function() {
				$('#' + id).remove();
			},
			error: function() {
				alert('del error');
			}
		});
	}
	else if (in_ex == 'income')
		location.href = "income_del?id=" + id;
}

// 更新记录
function update() {
	var id = $('#update_id');
	var item = $('#update_category > option:selected');
	var money = $('#update_money');
	var time = $('#update_time');
	if (money.val() == '' || time.val() == '') return false;

//	var querystr = 'id=' + id + '&item="' + item + '"&money=' + money + '&time=' + time;
	$.ajax({
		//url: 'expend_update?' + querystr,
		url: 'expend_update',
		type: 'post',	// 这里使用的是post方法，但是使用get方法就不能成功，中文传递使用$_GET得不到结果？？？？？？？？？？？
		data: {id: id.val(), item: item.val(), money: money.val(), time: time.val()},
		success: function(data) {
			$('#expend_update').modal('hide');
			// 修改成功后更新页面
			$('tr#' + id.val()).addClass('bold');
			$('tr#' + id.val() + ' td:eq(1)').html(item.val());
			$('tr#' + id.val() + ' td:eq(2)').html(money.val() + '元');
			$('tr#' + id.val() + ' td:eq(3)').html(time.val()
				+ '<span class=\"hidden\" style=\"float: right\"><a style=\"cursor:pointer\" title=\"修改\" href=\"#expend_update\" data-toggle=\"modal\" onclick=\"showUpdateDialog(\''
				+ id.val() + '\',\'' + item.val() + '\', \'' + money.val() + '\'\"><img src=\"/wb_Finance/Public/Images/alter.png\" border=\"0\"/></a></span>');
		}
	});
}

function showUpdateDialog(id, item, money, time) {
	$('#update_money').val(money);
	$('#update_time').val(time);
	$('#update_id').val(id);
	$('#update_category option').each(function () {
		if ($(this).text() == item) {
			$(this).attr('selected', 'selected');
		}
	})
}

function add_cancle() {
	$('#add_money').val('');
	$('#add_time').val('');
}

function search() {
	var item = $('#search_categoryList');
	var starttime = $('#search_starttime');
	var endtime = $('#search_endtime');

	$.ajax({
		url: 'expend_search',
		type: 'post',
		data: {item: item.val(), starttime: starttime.val(), endtime: endtime.val()},
		success: function(data) {
			alert('ja');
		}
	});
}

$(document).ready(function() {
	$('#nav_expend').addClass('active');

	// 单击删除按钮
	$('#del').click(function () {
		if ($('.toggle:checked').length == 0) {
			alert('没有选中项！');
			return;
		}
		var r = confirm('确定删除选中记录吗？');
		if (r) {
			var arr = new Array();
			var k = 0;
			$('tbody > tr > td > input').each(function () {
				var checkbox = $(this);
				if (checkbox.attr('checked') == 'checked') {
					var id = checkbox.parents('tr').attr('id');
					arr[k++] = id;
				}
			});
			for (var i = 0; i < k; i++) {
				del(arr[i], 'expend');
			}
		}
	});

	// 刷新按钮
	$('#refresh').click(function () {
		window.location.reload();
	});

	// 鼠标放在某一行上显示修改按钮
	$('tbody > tr').mouseenter(function () {
		var span = $(this).children('td').eq(3).children('span');
		span.removeClass('hidden');
	});
	$('tbody > tr').mouseleave(function () {
		var span = $(this).children('td').eq(3).children('span');
		span.addClass('hidden');
	});

	// 单击table的某一行
	$('tbody > tr > td').click(function() {
		var checkbox = $(this).parent('tr').children('td').eq(0).children('input');
		if  (checkbox.attr('checked') == 'checked') {
			checkbox.removeAttr('checked');
		} else {
			checkbox.attr('checked', 'checked');
		}

		// 如果全部选中，将全选的框选中
		if ($('.toggle:checked').length == $('.toggle').length) {
			$('#selectAll').attr('checked', 'true');
		}
		if ($('.toggle:checked').length < $('.toggle').length) {
			$('#selectAll').removeAttr('checked');
		}
	});

	// 单击全选框
	$('#selectAll').click(function() {
		if ($(this).attr('checked') == 'checked') {
			$('.toggle').attr('checked', 'checked');
		} else {
			$('.toggle').removeAttr('checked');
		}
	});

	// 数字输入框
	$('.number').keypress(function (e) {
		if (e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode == 46) return true;
		return false;
	});
});

window.addEventListener('load', initiate, false);