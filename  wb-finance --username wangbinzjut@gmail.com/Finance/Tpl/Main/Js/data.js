Ext.require(['Ext.data.*']);

function abc($arr) {
	//for (i = 0; i < 12; i++) {
	//	alert(data[i]);
	//}
	alert($arr);
}

Ext.onReady(function() {

    window.generateData = function($datas){
    	var data = [], i;
		for (i = 0; i < 12; i++) {
			data.push( {
				month : Ext.Date.monthNames[i % 12],
				money : Math.floor(Math.max((Math.random() * 100))),
			});
		}
		return data;
/*
 * var data = [], for (i = 0; i < 12; i++) { data.push({ month:
 * $data[i]['month'], money: $data[i]['money'] }); alert($data[i]['month']);
 * alert($data[i]['money']); } return data;
 */
    };
    
    window.store1 = Ext.create('Ext.data.JsonStore', {
        fields: ['month', 'money'],
        data: generateData()
    });
    
    
});
