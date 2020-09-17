Chart.defaults.global.defaultFontFamily = 'Poppins';

// barchart
var MONTHSline = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor()
                    ],
                    fill: false,
                }, {
                    label: "My Second dataset",
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor()
                    ],
                }]
            },
            options: {
                responsive: true,
                fontFamily: 'Poppins',
                title:{
                    display:false
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    fontFamily: 'Poppins',
                },
                hover: {
                    mode: 'nearest',
                    intersect: true,
                    fontFamily: 'Poppins',
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month',
                            fontFamily: 'Poppins',
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value',
                            fontFamily: 'Poppins',
                        }
                    }]
                }
            }
        };

        window.onload = function() {
            var ctxline = document.getElementById("line").getContext("2d");
            window.myLine = new Chart(ctxline, config);

            var ctxbar = document.getElementById("bar").getContext("2d");
            window.myBar = new Chart(ctxbar, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: false
                    }
                }
            });

            var ctxcombo = document.getElementById("combo-bar-line").getContext("2d");
            window.myMixedChart = new Chart(ctxcombo, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    title: {
                        display: false
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
                    }
                }
            });

            var ctxpiechart = document.getElementById("chart-area-pie").getContext("2d");
            window.myPie = new Chart(ctxpiechart, configPiechart);


            window.myRadar = new Chart(document.getElementById("radar"), configrad);

            var chartEldata = document.getElementById("datachart");
			var chartdata = new Chart(chartEldata, {
				type: "line",
				data: lineChartData,
				options: {
					title:{
						display: false
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

        document.getElementById('randomizeDataline').addEventListener('click', function() {
            config.data.datasets.forEach(function(dataset) {
                dataset.data = dataset.data.map(function() {
                    return randomScalingFactor();
                });

            });

            window.myLine.update();
        });

        var colorNamesline = Object.keys(window.chartColors);
        document.getElementById('addDatasetline').addEventListener('click', function() {
            var colorName = colorNamesline[config.data.datasets.length % colorNamesline.length];
            var newColor = window.chartColors[colorName];
            var newDataset = {
                label: 'Dataset ' + config.data.datasets.length,
                backgroundColor: newColor,
                borderColor: newColor,
                data: [],
                fill: false
            };

            for (var index = 0; index < config.data.labels.length; ++index) {
                newDataset.data.push(randomScalingFactor());
            }

            config.data.datasets.push(newDataset);
            window.myLine.update();
        });


        document.getElementById('addDataline').addEventListener('click', function() {
            if (config.data.datasets.length > 0) {
                var month = MONTHSline[config.data.labels.length % MONTHSline.length];
                config.data.labels.push(month);

                config.data.datasets.forEach(function(dataset) {
                    dataset.data.push(randomScalingFactor());
                });

                window.myLine.update();
            }
        });

        document.getElementById('removeDatasetline').addEventListener('click', function() {
            config.data.datasets.splice(0, 1);
            window.myLine.update();
        });

        document.getElementById('removeDataline').addEventListener('click', function() {
            config.data.labels.splice(-1, 1); // remove the label first

            config.data.datasets.forEach(function(dataset, datasetIndex) {
                dataset.data.pop();
            });

            window.myLine.update();
        });

// linechart
var MONTHSbar = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var color = Chart.helpers.color;
        var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: 'Dataset 1',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
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
                label: 'Dataset 2',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
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



        document.getElementById('randomizeDataBar').addEventListener('click', function() {
            var zero = Math.random() < 0.2 ? true : false;
            barChartData.datasets.forEach(function(dataset) {
                dataset.data = dataset.data.map(function() {
                    return zero ? 0.0 : randomScalingFactor();
                });

            });
            window.myBar.update();
        });

        var colorNamesbar = Object.keys(window.chartColors);
        document.getElementById('addDatasetBar').addEventListener('click', function() {
            var colorName = colorNamesbar[barChartData.datasets.length % colorNamesbar.length];;
            var dsColor = window.chartColors[colorName];
            var newDataset = {
                label: 'Dataset ' + barChartData.datasets.length,
                backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                borderColor: dsColor,
                borderWidth: 1,
                data: []
            };

            for (var index = 0; index < barChartData.labels.length; ++index) {
                newDataset.data.push(randomScalingFactor());
            }

            barChartData.datasets.push(newDataset);
            window.myBar.update();
        });

        document.getElementById('addData').addEventListener('click', function() {
            if (barChartData.datasets.length > 0) {
                var month = MONTHSbar[barChartData.labels.length % MONTHSbar.length];
                barChartData.labels.push(month);

                for (var index = 0; index < barChartData.datasets.length; ++index) {
                    //window.myBar.addData(randomScalingFactor(), index);
                    barChartData.datasets[index].data.push(randomScalingFactor());
                }

                window.myBar.update();
            }
        });

        document.getElementById('removeDataset').addEventListener('click', function() {
            barChartData.datasets.splice(0, 1);
            window.myBar.update();
        });

        document.getElementById('removeData').addEventListener('click', function() {
            barChartData.labels.splice(-1, 1); // remove the label first

            barChartData.datasets.forEach(function(dataset, datasetIndex) {
                dataset.data.pop();
            });

            window.myBar.update();
        });


// radarchart
var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var color = Chart.helpers.color;
    var configrad = {
        type: 'radar',
        data: {
            labels: [["Eating", "Dinner"], ["Drinking", "Water"], "Sleeping", ["Designing", "Graphics"], "Coding", "Cycling", "Running"],
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
            },]
        },
        options: {
            legend: {
                position: 'top',
            },
            title: {
                display: false
            },
            scale: {
              ticks: {
                beginAtZero: true
              }
            }
        }
    };


    document.getElementById('randomizeDataradar').addEventListener('click', function() {
        configrad.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return randomScalingFactor();
            });
        });

        window.myRadar.update();
    });

    var colorNamesrad = Object.keys(window.chartColors);
    document.getElementById('addDatasetradar').addEventListener('click', function() {
        var colorNamerad = colorNamesrad[configrad.data.datasets.length % colorNamesrad.length];
        var newColorrad = window.chartColors[colorNamerad];

        var newDataset = {
            label: 'Dataset ' + configrad.data.datasets.length,
            borderColor: newColorrad,
            backgroundColor: color(newColorrad).alpha(0.2).rgbString(),
            pointBorderColor: newColorrad,
            data: [],
        };

        for (var index = 0; index < configrad.data.labels.length; ++index) {
            newDataset.data.push(randomScalingFactor());
        }

        configrad.data.datasets.push(newDataset);
        window.myRadar.update();
    });

    document.getElementById('addDataradar').addEventListener('click', function() {
        if (configrad.data.datasets.length > 0) {
            configrad.data.labels.push('dataset #' + configrad.data.labels.length);

            configrad.data.datasets.forEach(function (dataset) {
                dataset.data.push(randomScalingFactor());
            });

            window.myRadar.update();
        }
    });

    document.getElementById('removeDatasetradar').addEventListener('click', function() {
        configrad.data.datasets.splice(0, 1);
        window.myRadar.update();
    });

    document.getElementById('removeDataradar').addEventListener('click', function() {
        configrad.data.labels.pop(); // remove the label first

        configrad.data.datasets.forEach(function(dataset) {
            dataset.data.pop();
        });

        window.myRadar.update();
    });


// combo-bar-line
var chartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                type: 'line',
                label: 'Dataset 1',
                borderColor: window.chartColors.blue,
                borderWidth: 2,
                fill: false,
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
                type: 'bar',
                label: 'Dataset 2',
                backgroundColor: window.chartColors.red,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: 'Dataset 3',
                backgroundColor: window.chartColors.green,
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

        document.getElementById('randomizeData-combo-bar-line').addEventListener('click', function() {
            chartData.datasets.forEach(function(dataset) {
                dataset.data = dataset.data.map(function() {
                    return randomScalingFactor();
                });
            });
            window.myMixedChart.update();
        });

// dataPoints-customTooltips
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
// pie chart
var randomScalingFactorPie = function() {
        return Math.round(Math.random() * 100);
    };

    var configPiechart = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    randomScalingFactorPie(),
                    randomScalingFactorPie(),
                    randomScalingFactorPie(),
                    randomScalingFactorPie(),
                    randomScalingFactorPie(),
                ],
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                ],
                label: 'Dataset 1'
            }],
            labels: [
                "Red",
                "Orange",
                "Yellow",
                "Green",
                "Blue"
            ]
        },
        options: {
            responsive: true
        }
    };

    document.getElementById('randomizeDataPie').addEventListener('click', function() {
        configPiechart.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return randomScalingFactorPie();
            });
        });

        window.myPie.update();
    });

    var colorNamesPie = Object.keys(window.chartColors);
    document.getElementById('addDatasetPie').addEventListener('click', function() {
        var newDatasetPie = {
            backgroundColor: [],
            data: [],
            label: 'New dataset ' + configPiechart.data.datasets.length,
        };

        for (var indexPie = 0; indexPie < configPiechart.data.labels.length; ++indexPie) {
            newDatasetPie.data.push(randomScalingFactorPie());

            var colorNamePie = colorNamesPie[indexPie % colorNamesPie.length];;
            var newColorPie = window.chartColors[colorNamePie];
            newDatasetPie.backgroundColor.push(newColorPie);
        }

        configPiechart.data.datasets.push(newDatasetPie);
        window.myPie.update();
    });

    document.getElementById('removeDatasetPie').addEventListener('click', function() {
        configPiechart.data.datasets.splice(0, 1);
        window.myPie.update();
    });
