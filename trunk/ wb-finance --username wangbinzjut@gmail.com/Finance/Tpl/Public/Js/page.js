function Page() {
	// 起始行数
	var firstRow;
	// 分页总页面数
	var $totalPages;
	// 总行数
	var $totalRows;
	// 当前页数
	var $nowPage;
	// 分页的栏的总页数
	var $coolPages;
//	// 默认分页变量名
//	var $varPage;

	this.init = function() {
		// 分页栏每页显示的页数
		this.rollPage = 5;
		// 默认列表每页显示行数
		this.listRows = 20;

	};

	this.prePage = function() {

	};

	this.nextPage = function() {

	};
}