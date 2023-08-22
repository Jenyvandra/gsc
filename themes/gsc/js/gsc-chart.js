jQuery(function($) {
	var ctx = document.getElementById('gsc_financial_chart').getContext('2d');
	console.log(gsc_obj.year_labels);
	console.log(gsc_obj.share_capital);
	var data = {
		labels: gsc_obj.year_labels,
		datasets: [
		
		{
			label: 'Reserves and Other Funds',
			data: gsc_obj.reserves_and_other_funds,
			backgroundColor: 'rgba(255, 99, 132, 0.2)',
			borderColor: 'rgba(255, 99, 132, 1)',
			borderWidth: 1,
		},
		{
			label: 'Total Advances',
			data: gsc_obj.total_advances,
			backgroundColor: 'rgba(255, 206, 86, 0.2)',
			borderColor: 'rgba(255, 206, 86, 1)',
			borderWidth: 1,
		},
		{
			label: 'Deposits',
			data: gsc_obj.deposits,
			backgroundColor: 'rgba(54, 162, 235, 0.2)',
			borderColor: 'rgba(54, 162, 235, 1)',
			borderWidth: 1,
		},
		{
			label: 'Profit Loss',
			data: gsc_obj.profit__loss,
			backgroundColor: 'rgba(153, 102, 255, 0.2)',
			borderColor: 'rgba(153, 102, 255, 1)',
			borderWidth: 1,
		},
		{
			label: 'Share Capital',
			data: gsc_obj.share_capital,
			backgroundColor: 'rgba(75, 192, 192, 0.2)',
			borderColor: 'rgba(75, 192, 192, 1)',
			borderWidth: 1,
		},
		],
	};

	var options = {
		tooltips: {
			mode: 'index',
			intersect: false,
		},
		scales: {
			x: {
				stacked: true,
			},
			y: {
				stacked: true,
			},
		},
	};

	var myChart = new Chart(ctx, {
		type: 'bar',
		data: data,
		options: options,
	});
});