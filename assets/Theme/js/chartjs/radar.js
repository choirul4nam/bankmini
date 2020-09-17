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
                display: true,
                text: 'Chart.js Radar Chart'
            },
            scale: {
              ticks: {
                beginAtZero: true
              }
            }
        }
    };

    window.onload = function() {
        window.myRadar = new Chart(document.getElementById("radar"), configrad);
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
