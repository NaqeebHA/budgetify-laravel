@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 class="title-text">Welcome to Budgetify</h1>

    <div id="period-selector">
        <div id="reportrange" class="btn btn-light">
            <i class="bi bi-calendar-range-fill"></i>
            <span></span>
            <i class="bi bi-caret-down-fill"></i>
        </div>
    </div>

    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Budget Summary
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div id="budget-tabs">
                        <ul>
                            <li><a href="#expense-tab">Expense</a></li>
                            <li><a href="#income-tab">Income</a></li>
                        </ul>
                        <div id="expense-tab">
                            <div class="row">
                                <div class="bg-dark mx-auto my-auto p-2 col-md-4">
                                    <div id="noExpenseFound" class="mx-auto my-auto"></div>
                                    <canvas id="expenseChart"></canvas>
                                </div>
                                <div class="col bg-dark mx-auto p-2 col-md-4">
                                    <table id="expense-table" class="table table-bordered table-dark bg-dark my-auto">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="col bg-dark mx-auto p-2 col-md-4">
                                    <table id="expense-acc-table" class="table table-bordered table-dark bg-dark my-auto">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="income-tab">
                            <div class="row">
                                <div class="col bg-dark mx-auto my-auto p-2 col-md-4">
                                    <div id="noIncomeFound" class="mx-auto my-auto"></div>
                                    <canvas id="incomeChart"></canvas>
                                </div>
                                <div class="col bg-dark mx-auto p-2 col-md-4">
                                    <table id="income-table" class="table table-bordered table-dark bg-dark my-auto">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="col bg-dark mx-auto p-2 col-md-4">
                                    <table id="income-acc-table" class="table table-bordered table-dark bg-dark my-auto">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                        <!-- <div class="row">
                            <div class="col bg-dark mx-auto my-auto p-2">
                                <div id="noExpenseFound" class="mx-auto my-auto"></div>
                                <canvas id="expenseChart"></canvas>
                            </div>
                            <div class="col bg-dark mx-auto p-2">
                                <table id="expense-table" class="table table-bordered table-dark bg-dark my-auto">
                                    <thead></thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Apparel Summary
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div id="tabs">
                        <ul>
                            <li><a href="#tabs-1">Nunc tincidunt</a></li>
                            <li><a href="#tabs-2">Proin dolor</a></li>
                            <li><a href="#tabs-3">Aenean lacinia</a></li>
                        </ul>
                        <div id="tabs-1">
                            <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
                        </div>
                        <div id="tabs-2">
                            <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
                        </div>
                        <div id="tabs-3">
                            <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
                            <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Event Summary
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the
                    collapse plugin adds the appropriate classes that we use to style each element. These classes
                    control the overall appearance, as well as the showing and hiding via CSS transitions. You can
                    modify any of this with custom CSS or overriding our default variables. It's also worth noting that
                    just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit
                    overflow.
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        //datepicker
        var date_from;
        var date_to;
        var expenseChart;
        var incomeChart;

        var start = moment().startOf('month');
        var end = moment().endOf('month');

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            fetchBudgetAnalytics(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            // fetchAccList(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        }

        $('#reportrange').daterangepicker({
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

        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
            date_from = picker.startDate.format('YYYY-MM-DD');
            date_to = picker.endDate.format('YYYY-MM-DD');
            fetchBudgetAnalytics(date_from, date_to);
            // fetchAccList(date_from, date_to);
        });

        cb(start, end);

        //fetch json and fill table for budget
        function fetchBudgetAnalytics(date_from, date_to)
        {
            const INCOME = 1;
            const EXPENSE = 0;

            var expenseCategories = [];
            var expensePercentage = [];
            var expenseTotals = [];

            var incomeCategories = [];
            var incomePercentage = [];
            var incomeTotals = [];
            var colors = ['#ff6384', '#36a2eb', '#ffce56', '#cc65fe', 'green', 'red', 'blue', 'yellow'];

            // ajaxInOut(INCOME);
            ajaxInOut(EXPENSE);
            // start ajax and table
            function ajaxInOut($in_out)
            {
                $.ajax({
                    url: `/budgets/analytics/category?in_out=${$in_out}&from=${date_from}&to=${date_to}`,
                    method: 'GET',
                    success: function(response) {

                        var $expenseTableHead = $('#expense-table thead');
                        var $expenseTableBody = $('#expense-table tbody');
                        var $noExpenseFound = $('#noExpenseFound')

                        if (response.error) {
                            // alert(response.error);
                            $expenseTableHead.empty();
                            $expenseTableBody.empty();
                            $noExpenseFound.html('<p class="mx-auto text-light">' + response.error + '<p>');
                        } else {

                            var sumTotal = response.reduce(function (sum, res) {
                                return sum + Number(res.total);
                            }, 0);

                            if (response.length == 0) {
                                sumTotal = 1;
                            }

                            $noExpenseFound.empty();
                            $expenseTableHead.empty();
                            $expenseTableHead.append('<tr><th>Category</th><th>Percentage</th><th>Amount</th></tr>');
                            $expenseTableBody.empty();

                            expensePercentageCount = 0;

                            $.each(response, function(index, budget) {
                                expenseCategories.push(budget.category);
                                expenseTotals.push(Number(budget.total));
                                expensePercentage.push(Math.round((budget.total*100)/sumTotal));
                                var row = '<tr>' +
                                    '<td style="background-color:' + colors[expensePercentageCount] + '">' + budget.category + '</td>' +
                                    '<td>' + expensePercentage[expensePercentageCount] + '%</td>' +
                                    '<td>' + budget.total + '</td>' +
                                    '</tr>';
                                $expenseTableBody.append(row);

                                expensePercentageCount++;
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Request failed:', error);
                    }
                })
                //start expense pie chart
                .then(function(){
                    var ctx = document.getElementById('expenseChart').getContext('2d');
                    if (expenseChart) {
                        expenseChart.destroy();
                    }
                    var shortenedColors = colors.slice(0,4);
                    expenseChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: expenseCategories,
                            datasets: [{
                                label: 'My Pie Chart',
                                data: expenseTotals,
                                backgroundColor: colors.slice(0, expenseCategories.length)
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
                });//end expense pie chart

            } //end ajax, table, and pie chart

        }  //end fetchBudgetAnalytics method

        // function fetchAccList(date_from, date_to)
        // {
        //     var expenseAccount = [];
        //     var expensePercentageAcc = [];
        //     var expenseTotalsAcc = [];

        //     var incomeAccount = [];
        //     var incomePercentageAcc = [];
        //     var incomeTotalsAcc = [];
        //     var colorsAcc = ['blue', 'red', 'green', 'yellow', '#cc65fe', '#ffce56', '#36a2eb', '#ff6384'];

        //     // start account expense ajax and table
        //     $.ajax({
        //         url: 'requestHandler.php?action=accountRange&in_out=0' +
        //         '&from=' + date_from + '&to=' + date_to,
        //         method: 'GET',
        //         success: function(response) {

        //             var $expenseAccTableHead = $('#expense-acc-table thead');
        //             var $expenseAccTableBody = $('#expense-acc-table tbody');

        //             if (response.error) {
        //                 // alert(response.error);
        //                 $expenseAccTableHead.empty();
        //                 $expenseAccTableBody.empty();
        //             } else {
        //                 var sumTotal = 1;

        //                 if (response.length > 0) {
        //                     sumTotal = response.reduce(function (sum, res) {
        //                         return sum + Number(res.total);
        //                     }, 0);
        //                 }

        //                 $expenseAccTableHead.empty();
        //                 $expenseAccTableHead.append('<tr><th>Account</th><th>Percentage</th><th>Amount</th></tr>');
        //                 $expenseAccTableBody.empty();

        //                 expensePercentageAccCount = 0;

        //                 $.each(response, function(index, budget) {
        //                     expenseAccount.push(budget.account);
        //                     expenseTotalsAcc.push(Number(budget.total));
        //                     expensePercentageAcc.push(Math.round((budget.total*100)/sumTotal));
        //                     var row = '<tr>' +
        //                         '<td style="background-color:' + colorsAcc[expensePercentageAccCount] + '">' + budget.account + '</td>' +
        //                         '<td>' + expensePercentageAcc[expensePercentageAccCount] + '%</td>' +
        //                         '<td>' + budget.total + '</td>' +
        //                         '</tr>';
        //                     $expenseAccTableBody.append(row);

        //                     expensePercentageAccCount++;
        //                 });
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Request failed:', error);
        //         }
        //     }) //end expense ajax and table
        //     // start account income ajax and table
        //     $.ajax({
        //         url: 'requestHandler.php?action=accountRange&in_out=1' +
        //         '&from=' + date_from + '&to=' + date_to,
        //         method: 'GET',
        //         success: function(response) {

        //             var $incomeAccTableHead = $('#income-acc-table thead');
        //             var $incomeAccTableBody = $('#income-acc-table tbody');

        //             if (response.error) {
        //                 // alert(response.error);
        //                 $incomeAccTableHead.empty();
        //                 $incomeAccTableBody.empty();
        //             } else {
        //                 var sumTotal = 1;

        //                 if (response.length > 0) {
        //                     sumTotal = response.reduce(function (sum, res) {
        //                         return sum + Number(res.total);
        //                     }, 0);
        //                 }

        //                 $incomeAccTableHead.empty();
        //                 $incomeAccTableHead.append('<tr><th>Account</th><th>Percentage</th><th>Amount</th></tr>');
        //                 $incomeAccTableBody.empty();

        //                 incomePercentageAccCount = 0;

        //                 $.each(response, function(index, budget) {
        //                     incomeAccount.push(budget.account);
        //                     incomeTotalsAcc.push(Number(budget.total));
        //                     incomePercentageAcc.push(Math.round((budget.total*100)/sumTotal));
        //                     var row = '<tr>' +
        //                         '<td style="background-color:' + colorsAcc[incomePercentageAccCount] + '">' + budget.account + '</td>' +
        //                         '<td>' + incomePercentageAcc[incomePercentageAccCount] + '%</td>' +
        //                         '<td>' + budget.total + '</td>' +
        //                         '</tr>';
        //                     $incomeAccTableBody.append(row);

        //                     incomePercentageAccCount++;
        //                 });
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Request failed:', error);
        //         }
        //     }) //end account income ajax and table
        // }
        $( "#budget-tabs" ).tabs();
        $( "#tabs" ).tabs();
    }); //end js

</script>

@endsection
