
var $value;

function getData($arr) {
	$value = $arr;
}

Ext.onReady(function() {

	window.generateData = function(){
    	var data = [], i;
		for (i = 0; i < 12; i++) {
			data.push( {
				month : Ext.Date.monthNames[i % 12],
				money : $value[i],
			});
		}
		return data;
    };
    
    window.store1 = Ext.create('Ext.data.JsonStore', {
        fields: ['month', 'money'],
        data: generateData()
    });
    
    var chart = Ext.create('Ext.chart.Chart', {
            id: 'chartCmp',
            xtype: 'chart',
            style: 'background:#fff',
            //animate: true,
            //shadow: true,
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
                renderer: function(sprite, record, attr, index, store) {
                    color = ['#2C99C9']
                    return Ext.apply(attr, {
                        fill: color
                    });
                },
                xField: 'month',
                yField: 'money'
            }]
        });

    var win = Ext.create('Ext.panel.Panel', {
        width: 650,
        height: 400,
        resizable: false,
        hidden: false,
        renderTo: 'expend_column',
        layout: 'fit',
        items: chart    
    });
});