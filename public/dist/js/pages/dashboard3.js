$(function() {
    'use strict'

    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true
        // operation comparision
    $.ajax({
        type: 'get',
        url: '/admin/get-bar',
        data: {

        },
        success: function(response) {
            // console.log(response)
            var $salesChart = $('#sales-chart')
            var array = ['Purchase', 'Sale', 'Expense', 'Waste'];
            var day = new Date();
            // console.log(day)


            $("#total_sales").text('Rs.' + response.total_sales)
                // firstMonth = firstMonth-1
            var salesChart = new Chart($salesChart, {
                type: 'bar',
                data: {
                    labels: [array[0], array[1], array[2], array[3]],
                    datasets: [{
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: [response.purchase, response.sale, response.expense, response.waste]
                        },
                        // {
                        //     backgroundColor: '#ced4da',
                        //     borderColor: '#ced4da',
                        //     data: [response.profit_sixth, response.profit_fith, response.profit_fourth, response.profit_third, response.profit_second, response.profit_first]
                        // }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,

                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    if (value >= 1000) {
                                        value /= 1000
                                        value += 'k'
                                    }
                                    return 'Rs.' + value
                                }
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })

        }
    });


    // monthly sale comparision 
    $.ajax({
        type: 'get',
        url: '/admin/get-sale',
        data: {

        },
        success: function(response) {
            console.log(response)
            var $salesChart = $('#sales_graph')
            var array = ['Purchase', 'Sale', 'Expense', 'Waste'];
            var day = new Date();
            // console.log(day)

            var salesChart = new Chart($salesChart, {
                type: 'bar',
                data: {
                    labels: [
                        response.month.tawval, response.month.elevan, response.month.ten, response.month.nine, response.month.eight, response.month.seven, response.month.six, response.month.five, response.month.four, response.month.three, response.month.two, response.month.one,


                    ],
                    datasets: [{
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: [response.data.tawval, response.data.elevan, response.data.ten, response.data.nine, response.data.eight, response.data.seven, response.data.six, response.data.five, response.data.four, response.data.three, response.data.two, response.data.one,


                            ]
                        },
                        // {
                        //     backgroundColor: '#ced4da',
                        //     borderColor: '#ced4da',
                        //     data: [response.profit_sixth, response.profit_fith, response.profit_fourth, response.profit_third, response.profit_second, response.profit_first]
                        // }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,

                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    if (value >= 1000) {
                                        value /= 1000
                                        value += 'k'
                                    }
                                    return 'Rs.' + value
                                }
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })

        }
    });


    var $visitorsChart = $('#visitors-chart')
    var visitorsChart = new Chart($visitorsChart, {
        data: {
            labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
            datasets: [{
                    type: 'line',
                    data: [100, 120, 170, 167, 180, 177, 160],
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    pointBorderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                    fill: false
                        // pointHoverBackgroundColor: '#007bff',
                        // pointHoverBorderColor    : '#007bff'
                },
                {
                    type: 'line',
                    data: [60, 80, 70, 67, 80, 77, 100],
                    backgroundColor: 'tansparent',
                    borderColor: '#ced4da',
                    pointBorderColor: '#ced4da',
                    pointBackgroundColor: '#ced4da',
                    fill: false
                        // pointHoverBackgroundColor: '#ced4da',
                        // pointHoverBorderColor    : '#ced4da'
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    // display: false,
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,
                        suggestedMax: 200
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    })
})