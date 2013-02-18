var categoryList;

function initiate() {
	$.ajax({
		url: 'expend_categoryList',
		type: 'post',
		success: function(data) {
			var jsonData = eval('(' + data + ')');
			categoryList = jsonData['categoryList'];
		}
	});
}

function del(id, in_ex) {
	var r = confirm('确定删除该项记录吗？');
	if (r) {
		// 使用ajax方式提交，删除某项后不刷新整个页面，只更新表格。
		if (in_ex == 'expend') {
			$.ajax({
				url: "expend_del?id=" + id,
				type: 'get',
				success: function() {
					$('#' + id).remove();
					changeTable();
				},
				error: function() {
					alert('error');
				}
			});
		}
		else if (in_ex == 'income')
			location.href = "income_del?id=" + id;
	}
}

// 更新记录
function update() {
	var id = $('#update_id');
	var item = $('option:selected');
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
			$('tr#' + id.val() + ' td:eq(1)').html('<strong>' + item.val() + '</strong>');
			$('tr#' + id.val() + ' td:eq(2)').html('<strong>' + money.val() + '元</strong>');
			$('tr#' + id.val() + ' td:eq(3)').html('<strong>' + time.val() + '</strong>');

		}
	});
}

function showUpdateDialog(id, item, money, time) {
	$('option').remove();
	$('#update_money').val(money);
	$('#update_time').val(time);
	$('#update_id').val(id);
	for (var i = 0; i < categoryList.length; i++) {
		var tmp = categoryList[i]['item'];
		if (tmp == item) {
			$('#categoryList').append('<option value="' + tmp + '" selected>' + tmp + '</option>');
		} else {
			$('#categoryList').append('<option value="' + tmp + '">' + tmp + '</option>');
		}
	}
}

function changeTable() {
	$('tr').removeClass('success');
	$('tr').removeClass('info');
	$('tr:even').addClass('success');
	$('tr:odd').addClass('info');
}

function add_cancle() {
	$('#add_money').val('');
	$('#add_time').val('');
}

function add_add() {
	var item = $('#add_categoryList');
	var money = $('#add_money');
	var time = $('#add_time');
	if (money.val() == '' || time.val() == '') return false;
	$.ajax({
		url: 'expend_add',
		type: 'post',
		data: {item: item.val(), money: money.val(), time: time.val()},
		success: function(data) {
			// 添加成功后刷新页面
			window.location.reload();

			// 未实现的方法
			// 成功后将结果添加到table的第一行
			var jsonData = eval('(' + data + ')');
			money.val('');
			time.val('');
			$('a[href="#expend_detail"]').tab('show');
			$('table tbody').prepend('<tr id="' + jsonData['id'] + '">' +
				'<td><input type="checkbox" class="toggle"></td>' +
				'<td>' + jsonData['item'] + '</td>' +
				'<td>' + jsonData['money'] + '元</td>' +
				'<td>' + jsonData['time'] + '</td>' +
				'<td><a style="cursor: pointer" title="删除" onclick="del(' + jsonData['id'] + ', "expend")">' +
					'<img src="/wb_Finance/Finance/Tpl/Public/Images/del.png" border="0"></a>' +
					'<a style="cursor: pointer" title="修改" href="#expend_update" data-toggle="modal"' +
					' onclick="showUpdateDialog("' + jsonData['id'] + '", "' + jsonData['item'] + '", "'
					+ jsonData['money'] + '", "' + jsonData['time'] + '")">' +
					'<img src="/wb_Finance/Finance/Tpl/Public/Images/alter.png" border="0"></a></td>' +
				'</tr>');
			changeTable();
		}
	});
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
	changeTable();

	$('tbody > tr').click(function() {
		if ($(this).hasClass('selected')) {
			$(this).removeClass('selected').find(':input').removeAttr('checked');
		} else {
			$(this).addClass('selected').find(':input').attr('checked', 'checked');
		}

		// 如果全部选中，将全选的框选中
		if ($('.toggle:checked').length == $('.toggle').length) {
			$('#selectAll').attr('checked', 'true');
		}
		if ($('.toggle:checked').length < $('.toggle').length) {
			$('#selectAll').removeAttr('checked');
		}
	});

	// 全选
	$('#selectAll').click(function() {
		if ($(this).attr('checked') == 'checked') {
			$('.toggle').attr('checked', 'checked');
			$('tbody > tr').addClass('selected');
		} else {
			$('.toggle').removeAttr('checked');
			$('tbody > tr').removeClass('selected');
		}
	});

	// 单击增加支出tab页，加载select的数据
	$('a[href="#expend_add"], a[href="#expend_search"]').on('shown', function () {
		$('#add_categoryList > option').remove();
		$('#search_categoryList > option').remove();
		for (var i = 0; i < categoryList.length; i++) {
			var tmp = categoryList[i]['item'];
			$('#add_categoryList').append('<option value="' + tmp + '">' + tmp + '</option>');
			$('#search_categoryList').append('<option value="' + tmp + '">' + tmp + '</option>');
		}
	})
});

window.addEventListener('load', initiate, false);