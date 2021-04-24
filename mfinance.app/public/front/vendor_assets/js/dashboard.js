(function ($){

    /* custom legend function */
    function customLegend(chart) {
        var text = [];
        text.push('<ul class="linechart'+ chart.id + '-legend">');
        var data = chart.data;
        var datasets = data.datasets;
        var labels = data.labels;
        if (datasets.length) {
            /*check if the type of the chart is line and take length accordingly for iteration*/
            var dataLength = chart.config.type === "line" ? datasets.length : datasets[0].backgroundColor.length;

            /*set the data source according to type*/
            function getData(i){
                return (
                    [chart.config.type === "line" ? datasets[i].borderColor : datasets[0].backgroundColor[i],
                        chart.config.type === "line" ? datasets[i].label : data.labels[i]]);
            }

            /* loop through data to generate html */
            for (var i=0 ; i < dataLength; ++i) {
                text.push('<li><span style="background-color:' + (getData(i)[0]) + '"></span>');
                text.push(getData(i)[1]);
                text.push('</li>');
            }

            text.push('</ul>');
            return text.join('');
        }
    }

    // line chart
    if($('.line-chart').length){
        var ctx = $('.line-chart');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ["2013", "2014", "2015", "2016", "2017", "2018"],
                datasets: [{
                    label: "Business",
                    backgroundColor: 'rgba(65,58,164,0.1)',
                    borderColor: 'rgb(65,58,164)',
                    pointBackgroundColor: '#fff',
                    data: [18, 51, 30, 18, 24, 50],
                    borderWidth: 2
                },{
                    label: "Others",
                    backgroundColor: 'rgba(6,181,144,0.1)',
                    borderColor: 'rgb(6,181,144)',
                    pointBackgroundColor: '#fff',
                    data: [6, 25, 13, 8, 15, 7],
                    borderWidth: 2
                }]
            },

            // Configuration options go here
            options: {
                scales:{
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            suggestedMax: 60,
                            stepSize: 10
                        }
                    }]
                },
                legend: {
                    display: false
                },
                legendCallback: customLegend
            }
        });

        var lineLegend = chart.generateLegend();
        $('.line-legend').html(lineLegend);
    }


    if($('.bar-chart').length){
        var barChart = $('.bar-chart');
        var chart = new Chart(barChart, {
            type: 'bar',

            data: {
                labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul'],
                datasets: [
                    {
                        label: "Business",
                        data:[40,60,34,30,32,43,62],
                        backgroundColor: '#413aa4'
                    },{
                        label: "Others",
                        data:[30,20,60,40,65,15,40],
                        backgroundColor: '#06b590'
                    }
                ]
            },

            options: {
                scales:{
                    yAxes: [{
                        ticks:{
                            beginAtZero: true,
                            suggestedMax: 60
                        }
                    }],
                    xAxes: [{
                        barThickness: 18
                    }]
                },
                legend:{
                    display: false
                }
            }
        });

        var barLegend = chart.generateLegend();
        $('.ar-legend').html(barLegend);
    }


    if($('.pie-chart').length){
        var piechart = $('.pie-chart');
        var chart  = new Chart(piechart, {
            type: 'doughnut',
            data:{
                datasets: [{
                    data: [40,120,120],
                    backgroundColor: [
                        '#ff9f40',
                        '#36a2eb',
                        '#ff6384'
                    ]
                }],
                labels: [
                    "Google",
                    "Website",
                    "Other"
                ]
            },
            options:{
                cutoutPercentage: 50,
                responsive: true,
                layout: {
                    padding: {
                        right: 100,
                        top: 0,
                        bottom: 0
                    }
                },
                legend: {
                    display: false
                },
                legendCallback: customLegend
            }
        });

        var pieLegend = chart.generateLegend();
        $('.pie-legend').html(pieLegend);
    }


})(jQuery);