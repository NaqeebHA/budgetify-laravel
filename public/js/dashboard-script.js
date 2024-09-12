$(document).ready(function() {
    const INCOME = 1;
    const EXPENSE = 0;
    //datepicker
    var date_from;
    var date_to;
    var expenseChart;
    var incomeChart;
    var start = moment().startOf('month');
    var end = moment().endOf('month');
    var startSQLFormat = start.format('YYYY-MM-DD');
    var endSQLFormat = end.format('YYYY-MM-DD');

    $('#reportrange').daterangepicker({
        autoApply: true,
        startDate: start,
        endDate: end,
        showDropdowns: true,
        opens: 'left',
        ranges: {
        'Today': [moment(), moment()],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        }
    }, cb);
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        date_from = picker.startDate.format('YYYY-MM-DD');
        date_to = picker.endDate.format('YYYY-MM-DD');
        fetchBudgetAnalytics(date_from, date_to);
        fetchApparelAnalyticsTimeframe(date_from, date_to);
    });

    cb(start, end);
    fetchBudgetAnalytics(startSQLFormat, endSQLFormat);
    fetchApparelAnalyticsAllTime();
    fetchApparelAnalyticsTimeframe(startSQLFormat, endSQLFormat);

    function fetchBudgetAnalytics(date_from, date_to)
    {
        fetchBudgetAnalyticsCategory(date_from, date_to);
        fetchBudgetAnalyticsAccount(date_from, date_to);
        //fetch json and fill table for budget
        function fetchBudgetAnalyticsCategory(date_from, date_to)
        {
            var expenseCategories = [];
            var expensePercentage = [];
            var expenseTotals = [];

            var incomeCategories = [];
            var incomePercentage = [];
            var incomeTotals = [];
            var colors = ['#ff6384', '#36a2eb', '#ffce56', '#cc65fe', 'green', 'red', 'blue', 'yellow'];

            ajaxBudgetCategoryInOut(INCOME);
            ajaxBudgetCategoryInOut(EXPENSE);
            // start ajax, table and pie chart
            function ajaxBudgetCategoryInOut(in_out)
            {
                var categories = in_out === INCOME ? incomeCategories : expenseCategories;
                var percentage = in_out === INCOME ? incomePercentage : expensePercentage;
                var totals = in_out === INCOME ? incomeTotals : expenseTotals;
                // start ajax and table
                $.ajax({
                    url: `/budgets/analytics/category?in_out=${in_out}&from=${date_from}&to=${date_to}`,
                    method: 'GET',
                    success: function(response)
                    {
                        var TableHead = in_out === INCOME ? $('#income-table thead') : $('#expense-table thead');
                        var TableBody = in_out === INCOME ? $('#income-table tbody') : $('#expense-table tbody');
                        var noAnalyticsFound = in_out === INCOME ? $('#noIncomeFound') : $('#noExpenseFound');

                        if (response.error || response.length == 0) {
                            TableHead.empty();
                            TableBody.empty();
                            noAnalyticsFound.html(`<p class="mx-auto text-light"> ${response.error || 'no record found'} <p>`);
                        } else {
                            var sumTotal = response.reduce(function (sum, res) {
                                return sum + Number(res.total);
                            }, 0);

                            noAnalyticsFound.empty();
                            TableHead.empty();
                            TableHead.append('<tr><th>Category</th><th>Percentage</th><th>Amount</th></tr>');
                            TableBody.empty();

                            count = 0;

                            $.each(response, function(index, budget) {
                                categories.push(budget.category);
                                totals.push(Number(budget.total));
                                percentage.push(Math.round((budget.total*100)/sumTotal));
                                var row = '<tr>' +
                                    '<td style="background-color:' + colors[count] + '">' + budget.category + '</td>' +
                                    '<td>' + percentage[count] + '%</td>' +
                                    '<td>' + budget.total + '</td>' +
                                    '</tr>';
                                TableBody.append(row);

                                count++;
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Request failed:', error);
                    }
                }) // end ajax and table
                //start pie chart
                .then(function()
                {
                    var chartCanvas = in_out === INCOME ? 'incomeChart' : 'expenseChart';
                    var chart = in_out === INCOME ? incomeChart : expenseChart;

                    var ctx = document.getElementById(chartCanvas).getContext('2d');
                    if (chart) {
                        chart.destroy();
                    }
                    chart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: categories,
                            datasets: [{
                                label: 'My Pie Chart',
                                data: totals,
                                backgroundColor: colors.slice(0, totals.length)
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                    in_out === INCOME ? incomeChart = chart : expenseChart = chart;
                });//end pie chart

            } //end ajax, table, and pie chart

        }  //end fetchBudgetAnalyticsCategory method

        function fetchBudgetAnalyticsAccount(date_from, date_to)
        {
            var expenseAccount = [];
            var expensePercentageAcc = [];
            var expenseTotalsAcc = [];

            var incomeAccount = [];
            var incomePercentageAcc = [];
            var incomeTotalsAcc = [];
            var colorsAcc = ['blue', 'red', 'green', 'yellow', '#cc65fe', '#ffce56', '#36a2eb', '#ff6384'];

            ajaxBudgetAccountInOut(INCOME);
            ajaxBudgetAccountInOut(EXPENSE);
            // start account expense ajax and table
            function ajaxBudgetAccountInOut(in_out)
            {
                var accounts =[];
                var percentageAcc =[];
                var totalsAcc = [];
                $.ajax({
                    url: `/budgets/analytics/account?in_out=${in_out}&from=${date_from}&to=${date_to}`,
                    method: 'GET',
                    success: function(response) {

                        var $AccTableHead = in_out === INCOME? $('#income-acc-table thead') : $('#expense-acc-table thead');
                        var $AccTableBody = in_out === INCOME? $('#income-acc-table tbody') :  $('#expense-acc-table tbody');

                        if (response.error || response.length == 0) {
                            // alert(response.error);
                            $AccTableHead.empty();
                            $AccTableBody.empty();
                        } else {
                            var sumTotal = 1;

                            sumTotal = response.reduce(function (sum, res) {
                                return sum + Number(res.total);
                            }, 0);

                            $AccTableHead.empty();
                            $AccTableHead.append('<tr><th>Account</th><th>Percentage</th><th>Amount</th></tr>');
                            $AccTableBody.empty();

                            count = 0;

                            $.each(response, function(index, budget) {
                                accounts.push(budget.account);
                                totalsAcc.push(Number(budget.total));
                                percentageAcc.push(Math.round((budget.total*100)/sumTotal));
                                var row = '<tr>' +
                                    '<td style="background-color:' + colorsAcc[count] + '">' + budget.account + '</td>' +
                                    '<td>' + percentageAcc[count] + '%</td>' +
                                    '<td>' + budget.total + '</td>' +
                                    '</tr>';
                                $AccTableBody.append(row);

                                count++;
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Request failed:', error);
                    }
                }) //end expense ajax and table
            }
        }
    }


    function fetchApparelAnalyticsAllTime()
    {
        var colorsAcc = ['blue', 'red', 'green', 'yellow', '#cc65fe', '#ffce56', '#36a2eb', '#ff6384'];

        ajaxApparelAllTime('type');
        ajaxApparelAllTime('style');
        ajaxApparelAllTime('brand');
        // start account expense ajax and table
        function ajaxApparelAllTime(param)
        {
            var paramNames =[];
            var paramCounts =[];
            $.ajax({
                url: `/apparels/analytics/${param}`,
                method: 'GET',
                success: function(response) {

                    var $AccTableHead = $(`#${param}-table thead`);
                    var $AccTableBody = $(`#${param}-table tbody`);

                    if (response.error || response.length == 0) {
                        $AccTableHead.empty();
                        $AccTableBody.empty();
                    } else {
                        $AccTableHead.empty();
                        $AccTableHead.append(`<tr><th>${param.toUpperCase()}</th><th>COUNT</th></tr>`);
                        $AccTableBody.empty();

                        count = 0;

                        $.each(response, function(index, apparel) {
                            paramNames.push(apparel.name);
                            paramCounts.push(Number(apparel.count));
                            var row = '<tr>' +
                                '<td style="background-color:' + colorsAcc[count] + '">' + apparel.name + '</td>' +
                                '<td>' + apparel.count + '</td>' +
                                '</tr>';
                            $AccTableBody.append(row);

                            count++;
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            }) //end expense ajax and table
        }
    }

    function fetchApparelAnalyticsTimeframe(date_from, date_to)
    {
        var colorsAcc = ['blue', 'red', 'green', 'yellow', '#cc65fe', '#ffce56', '#36a2eb', '#ff6384'];

        ajaxApparelTimeframe('type', date_from, date_to);
        ajaxApparelTimeframe('style', date_from, date_to);
        ajaxApparelTimeframe('brand', date_from, date_to);
        // start account expense ajax and table
        function ajaxApparelTimeframe(param, date_from, date_to)
        {
            var paramNames =[];
            var paramCounts =[];
            $.ajax({
                url: `/apparels/analytics/${param}/timeframe?from=${date_from}&to=${date_to}`,
                method: 'GET',
                success: function(response) {

                    var $AccTableHead = $(`#${param}-timeframe-table thead`);
                    var $AccTableBody = $(`#${param}-timeframe-table tbody`);

                    if (response.error || response.length == 0) {
                        $AccTableHead.empty();
                        $AccTableBody.empty();
                    } else {
                        $AccTableHead.empty();
                        $AccTableHead.append(`<tr><th>${param.toUpperCase()}</th><th>COUNT</th></tr>`);
                        $AccTableBody.empty();

                        count = 0;

                        $.each(response, function(index, apparel) {
                            paramNames.push(apparel.name);
                            paramCounts.push(Number(apparel.count));
                            var row = '<tr>' +
                                '<td style="background-color:' + colorsAcc[count] + '">' + apparel.name + '</td>' +
                                '<td>' + apparel.count + '</td>' +
                                '</tr>';
                            $AccTableBody.append(row);

                            count++;
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            }) //end expense ajax and table
        }
    }

    $( "#budget-tabs" ).tabs();
    $( "#summary-tabs" ).tabs();
}); //end js
