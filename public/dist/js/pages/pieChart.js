$(function () {

    'use strict';


    var charts_pie = {
        init: function (sent_url, model) {
            // -- Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            this.ajaxGetData(sent_url, model);

        },

        ajaxGetData: function (sent_url, model) {

            var urlPath = window.location.origin + '/' + sent_url + '/' + model;
            /*console.log(urlPath);*/
            var request = $.ajax({
                method: 'GET',
                url: urlPath
            });

            request.done(function (response) {
                charts_pie.createCompletedPieChart(response);
            });
        },

        createCompletedPieChart: function (response) {
            var all_labels = response.all_labels;
            var data_dhaka = response.data_dhaka;
            var data_chittagong = response.data_chittagong;
            var data_rajshahi = response.data_rajshahi;
            var data_khulna = response.data_khulna;
            var data_rangpur = response.data_rangpur;
            var data_barisal = response.data_barisal;
            var data_mymensingh = response.data_mymensingh;
            var data_sylhet = response.data_sylhet;
            var data_others = response.data_others;
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
            var pieChart = new Chart(pieChartCanvas);
            var PieData = [
                {
                    value: data_dhaka,
                    color: '#ee82ee',
                    highlight: '#ee82ee',
                    label: all_labels["Dhaka"]
                },
                {
                    value: data_chittagong,
                    color: '#4b0082',
                    highlight: '#4b0082',
                    label: all_labels["Chittagong"]
                },
                {
                    value: data_rajshahi,
                    color: '#0000ff',
                    highlight: '#0000ff',
                    label: all_labels["Rajshahi"]
                },
                {
                    value: data_khulna,
                    color: '#008000',
                    highlight: '#008000',
                    label: all_labels["Khulna"]
                },
                {
                    value: data_rangpur,
                    color: '#ffff00',
                    highlight: '#ffff00',
                    label: all_labels["Rangpur"]
                },
                {
                    value: data_barisal,
                    color: '#ffa500',
                    highlight: '#ffa500',
                    label: all_labels["Barisal"]
                },
                {
                    value: data_mymensingh,
                    color: '#ff0000',
                    highlight: '#ff0000',
                    label: all_labels["Mymensingh"]
                },
                {
                    value: data_sylhet,
                    color: '#00cc00',
                    highlight: '#00cc00',
                    label: all_labels["Sylhet"]
                },
                {
                    value: data_others,
                    color: '#808080',
                    highlight: '#808080',
                    label: all_labels["Others"]
                }
            ];
            var pieOptions = {
                // Boolean - Whether we should show a stroke on each segment
                segmentShowStroke: true,
                // String - The colour of each segment stroke
                segmentStrokeColor: '#fff',
                // Number - The width of each segment stroke
                segmentStrokeWidth: 1,
                // Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout: 50, // This is 0 for Pie charts
                // Number - Amount of animation steps
                animationSteps: 100,
                // String - Animation easing effect
                animationEasing: 'easeOutBounce',
                // Boolean - Whether we animate the rotation of the Doughnut
                animateRotate: true,
                // Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale: true,
                // Boolean - whether to make the chart responsive to window resizing
                responsive: true,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: false,
                // String - A legend template
                legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
                // String - A tooltip template
                tooltipTemplate: '<%=value %> <%=label%> users'
            };
            // Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions);
        }
    };

    var sent_url = "pieChartCurrentMonthDivision";
    var model = "all_models";
    charts_pie.init(sent_url, model);
   /* console.log('http://127.0.0.1:8000/' + sent_url + '/' + model);*/


    $(document).ready(function () {
        $("#PieChartID_smart").change(function () {

            model = "all_models";
            sent_url = $('#PieChartID_smart option:selected').val();
            /*console.log('http://127.0.0.1:8000/' + sent_url + '/' + model);*/

            $('#refresh_main_smart').load('activation #refresh_smart', function () {

            });
            charts_pie.init(sent_url, model);
        });
    });


    // -----------------
    // - END PIE CHART -
    // -----------------


    /* /!* SPARKLINE CHARTs
     * ----------------
     * Create a inline charts with spark line
     *!/*/

    // -----------------
    // - SPARKLINE BAR -
    // -----------------
    $('.sparkbar').each(function () {
        var $this = $(this);
        $this.sparkline('html', {
            type: 'bar',
            height: $this.data('height') ? $this.data('height') : '30',
            barColor: $this.data('color')
        });
    });

    // -----------------
    // - SPARKLINE PIE -
    // -----------------
    $('.sparkpie').each(function () {
        var $this = $(this);
        $this.sparkline('html', {
            type: 'pie',
            height: $this.data('height') ? $this.data('height') : '90',
            sliceColors: $this.data('color')
        });
    });

    // ------------------
    // - SPARKLINE LINE -
    // ------------------
    $('.sparkline').each(function () {
        var $this = $(this);
        $this.sparkline('html', {
            type: 'line',
            height: $this.data('height') ? $this.data('height') : '90',
            width: '100%',
            lineColor: $this.data('linecolor'),
            fillColor: $this.data('fillcolor'),
            spotColor: $this.data('spotcolor')
        });
    });
});
