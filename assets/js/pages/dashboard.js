$('.info-box').click(function () { 
    let id = this.id;
    window.location.replace(id);
})
 
function barChart(Mybar_data, x_axis) { 
     var bar_data = {
     	data: JSON.parse(Mybar_data),
     	bars: {
     		show: true
     	}
     }
     $.plot('#bar-chart', [bar_data], {
     	grid: {
     		borderWidth: 1,
     		borderColor: '#f3f3f3',
     		tickColor: '#f3f3f3'
     	},
     	series: {
     		bars: {
     			show: true,
     			barWidth: 0.5,
     			align: 'center',
     		},
     	},
     	colors: ['#3c8dbc'],
     	xaxis: {
     		ticks: JSON.parse(x_axis)
     	}
     })
/* END BAR CHART */
    console.log();
    console.log();
    
  }
