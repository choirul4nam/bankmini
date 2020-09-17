	var customTooltips = function (tooltip) {
		$(this._chart.canvas).css("cursor", "pointer");

		$(".chartjs-tooltip").css({
			opacity: 0,
		});

		if (!tooltip || !tooltip.opacity) {
			return;
		}

		if (tooltip.dataPoints.length > 0) {
			tooltip.dataPoints.forEach(function (dataPoint) {
				var content = [dataPoint.xLabel, dataPoint.yLabel].join(": ");
				var $tooltip = $("#tooltip-" + dataPoint.datasetIndex);

				$tooltip.html(content);
				$tooltip.css({
					opacity: 1,
					top: dataPoint.y + "px",
					left: dataPoint.x + "px",
				});
			});
		}
	};
	var color = Chart.helpers.color;
	var lineChartData = {
		labels: ["January", "February", "March", "April", "May", "June", "July"],
		datasets: [{
			label: "My First dataset",
			backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
			borderColor: window.chartColors.red,
			pointBackgroundColor: window.chartColors.red,
			data: [
				randomScalingFactor(), 
				randomScalingFactor(), 
				randomScalingFactor(), 
				randomScalingFactor(), 
				randomScalingFactor(), 
				randomScalingFactor(), 
				randomScalingFactor()
			]
		}, {
			label: "My Second dataset",
			backgroundColor: color(window.chartColors.blue).alpha(0.2).rgbString(),
			borderColor: window.chartColors.blue,
			pointBackgroundColor: window.chartColors.blue,
			data: [
				randomScalingFactor(), 
				randomScalingFactor(), 
				randomScalingFactor(), 
				randomScalingFactor(), 
				randomScalingFactor(), 
				randomScalingFactor(), 
				randomScalingFactor()
			]
		}]
	};

	window.onload = function() {
		var chartEldata = document.getElementById("datachart");
		var chartTooltips = new Chart(chartEldata, {
			type: "line",
			data: lineChartData,
			options: {
				title:{
					display: true,
					text: "Chart.js - Custom Tooltips using Data Points"
				},
				tooltips: {
					enabled: false,
					mode: 'index',
					intersect: false,
					custom: customTooltips
				}
			}
		});
	};
