Ext.onReady(function() {

	var store3 = new Ext.data.JsonStore({
	    // store configs
	    //storeId: 'myStore',
		fields: ['month', 'money'],
	    proxy: {
	        type: 'ajax',
	        //url: 'expend_column_data'
	        url: 'a.json'
	        //reader: {
	        //    type: 'json',
	        //    root: 'images',
	        //    idProperty: 'name'
	        //}
	    }
	});
	//alert(store3.proxy.url);
	
	var store4 = new Ext.data.JsonStore({
	    fields:['month', 'money'],
	    data: [
	        {month:'1月', money: 245},
	        {month:'2月', money: 240},
	        {month:'3月', money: 355},
	        {month:'4月', money: 375},
	        {month:'5月', money: 490},
	        {month:'6月', money: 495},
	        {month:'7月', money: 520},
	        {month:'8月', money: 620},
	        {month:'9月', money: 620},
	        {month:'10月', money: 620},
	        {month:'11月', money: 620},
	        {month:'12月', money: 620}
	    ]
	});

    var chart = Ext.create('Ext.chart.Chart', {
            id: 'chartCmp',
            xtype: 'chart',
            style: 'background:#fff',
            animate: true,
            shadow: true,
            store: store1,
            axes: [{
                type: 'Numeric',
                position: 'left',
                fields: ['money'],
                label: {
                    renderer: Ext.util.Format.numberRenderer('0')
                },
               	title: '金额',
                grid: true,
                minimum: 0
            }, {
                type: 'Category',
                position: 'bottom',
                fields: ['month'],
               	title: '月份'
            }],
            series: [{
                type: 'column',
                axis: 'left',
                highlight: true,
                tips: {
                	trackMouse: true,
                	width: 140,
                	height: 28,
                	renderer: function(storeItem, item) {
                		this.setTitle(storeItem.get('month') + ': ' + storeItem.get('money') + ' 元');
                  	}
                },
                label: {
                	display: 'insideEnd',
                	'text-anchor': 'middle',
                    field: 'money',
                    renderer: Ext.util.Format.numberRenderer('0.0'),
                    orientation: 'horizontal',
                    color: '#333'
                },
                xField: 'month',
                yField: 'money'
            }]
        });

    var win = Ext.create('Ext.panel.Panel', {
        width: 700,
        height: 450,
        resizable: false,
        hidden: false,
        renderTo: 'expend_column',
        layout: 'fit',
        items: chart    
    });
});