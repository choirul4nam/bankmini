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

    window.onload = function() {
        var ctxpiechart = document.getElementById("chart-area-pie").getContext("2d");
        window.myPie = new Chart(ctxpiechart, configPiechart);
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