$(function () {

    'use strict';

    var charts_activation = {
        init: function (sent_url,model) {
            // -- Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            this.ajaxGetSalesData(sent_url,model);

        },

        ajaxGetSalesData: function (sent_url,model) {
            var urlPath =  window.location.origin +'/'+sent_url+'/'+model;
            /*console.log(urlPath);*/
            var request = $.ajax( {
                method: 'GET',
                url: urlPath
            } );

            request.done( function ( response ) {
                charts_activation.createCompletedActivationChart( response );
            });
        },

        /**
         * Created the Completed Jobs Chart
         */
        createCompletedActivationChart: function ( response ) {

            var all_labels = Object.values(response.all_labels);
            var all_data_smart = Object.values(response.all_data_smart);
            var all_data_feature = Object.values(response.all_data_feature);
            var activationChartCanvas = $('#activationChart').get(0).getContext('2d');
            // This will get the first returned node in the jQuery collection.
            var activationChart = new Chart(activationChartCanvas);
            var activationChartData = {
                labels: all_labels,
                datasets: [
                    {
                        label: 'Smart Phone',
                        fillColor: 'rgba(115, 24, 32, .9)',
                        strokeColor: 'rgba(115, 24, 32, 1)',
                        pointColor: 'rgba(115, 24, 32, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(115, 24, 32,.8)',
                        data                : all_data_smart
                    },
                    {
                        label: 'Feature Phone',
                        fillColor: 'rgba(18, 119, 137, .4)',
                        strokeColor: 'rgba(18, 119, 137,.4)',
                        pointColor: 'rgba(18, 119, 137,.4)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(18, 119, 137,.4)',
                        data                : all_data_feature
                    }
                ]
            };

            var activationChartOptions = {
                // Boolean - If we should show the scale at all
                showScale: true,
                // Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                // String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.2)',
                // Number - Width of the grid lines
                scaleGridLineWidth: 1,
                // Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                // Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                // Boolean - Whether the line is curved between points
                bezierCurve: true,
                // Number - Tension of the bezier curve between points
                bezierCurveTension: 0.3,
                // Boolean - Whether to show a dot for each point
                pointDot: true,
                // Number - Radius of each point dot in pixels
                pointDotRadius: 1,
                // Number - Pixel width of point dot stroke
                pointDotStrokeWidth: 1,
                // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius: 20,
                // Boolean - Whether to show a stroke for datasets
                datasetStroke: true,
                // Number - Pixel width of dataset stroke
                datasetStrokeWidth: 2,
                // Boolean - Whether to fill the dataset with a color
                datasetFill: true,
                // String - A legend template
                legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: true,
                // Boolean - whether to make the chart responsive to window resizing
                responsive: true,
                scaleFontColor: "rgb(184,199,206)"
            };

            activationChart.Line(activationChartData, activationChartOptions);
        }
    };

    var sent_url = "activationChartLastSevenDays";
    var model = "all_models";
    charts_activation.init(sent_url,model);

    /*console.log(sent_url,model);*/


    $(document).ready(function() {
        $("#ActivationChartID").change(function(){

            document.getElementById("loader_of_chart").style.display = "block";
            document.getElementById("activationChart").style.display = "none";

            model = $('#ActivationChartID_Model').val();
            sent_url = $('#ActivationChartID option:selected').val();

            if(model==""){
                model = "all_models";
            }

            if(sent_url=="activationChartTwentyFour"){
                document.getElementById('title2').innerHTML = "Last 24 Hours";
            }else if(sent_url=="activationChartLastSevenDays"){
                document.getElementById('title2').innerHTML = "Last 7 Days";
            }else if(sent_url=="activationChartLastThirtyDays"){
                document.getElementById('title2').innerHTML = "Last 30 Days";
            }else if(sent_url=="activationChartCurrentWeek"){
                document.getElementById('title2').innerHTML = "Current Week";
            }else if(sent_url=="activationChartPreviousWeek"){
                document.getElementById('title2').innerHTML = "Previous Week";
            }else if(sent_url=="activationChartCurrentMonth"){
                document.getElementById('title2').innerHTML = "Current Month";
            }else if(sent_url=="activationChartPreviousMonth"){
                document.getElementById('title2').innerHTML = "Previous Month";
            }else if(sent_url=="activationChartYear"){
                document.getElementById('title2').innerHTML = "Current Year";
            }else if(sent_url=="activationChartPreviousYear"){
                document.getElementById('title2').innerHTML = "Previous Year";
            }
            $('#refresh_main').load('dashboard #refresh', function() {
                charts_activation.init(sent_url,model);
                document.getElementById("loader_of_chart").style.display = "none";
            });
        });
    });

    $(document).ready(function() {
        $("#ActivationChartID_Model").change(function(){

            document.getElementById("loader_of_chart").style.display = "block";
            document.getElementById("activationChart").style.display = "none";
            model = $('#ActivationChartID_Model').val();
            sent_url = $('#ActivationChartID option:selected').val();

            if(sent_url==""){
                sent_url = "activationChartLastSevenDays";
            }

            document.getElementById('title1').innerHTML = model;

            $('#refresh_main').load('dashboard #refresh', function() {
                charts_activation.init(sent_url,model);
                document.getElementById("loader_of_chart").style.display = "none";
            });
        });
    });

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


