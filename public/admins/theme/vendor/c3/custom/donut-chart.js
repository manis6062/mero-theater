var chart10 = c3.generate({
	bindto: '#donutChart',
	data: {
		columns: [
			['Negative', 12],
			['Natural', 87],
			['Positive', 51],
		],
		type : 'donut',
		colors: {
			Negative: '#da1113',
			Natural: '#dddddd',
			Positive: '#008000',
		},
		onclick: function (d, i) { console.log("onclick", d, i); },
		onmouseover: function (d, i) { console.log("onmouseover", d, i); },
		onmouseout: function (d, i) { console.log("onmouseout", d, i); }
	},
	donut: {
		title: ""
	},
});