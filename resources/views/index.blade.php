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
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="false" aria-controls="collapseOne">
                    Budget Summary
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
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
                    <div id="summary-tabs">
                        <ul>
                            <li><a href="#apparel-all-time">All Time</a></li>
                            <li><a href="#apparel-timeframe">Timeframe</a></li>
                            <li><a href="#apparel-addition">Aenean lacinia</a></li>
                        </ul>
                        <div id="apparel-all-time">
                            <div class="row">
                                <div class="col bg-dark mx-auto p-2 col-md-4">
                                    <table id="type-table" class="table table-bordered table-dark bg-dark my-auto">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="col bg-dark mx-auto p-2 col-md-4">
                                    <table id="style-table" class="table table-bordered table-dark bg-dark my-auto">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="col bg-dark mx-auto p-2 col-md-4">
                                    <table id="brand-table" class="table table-bordered table-dark bg-dark my-auto">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>                        </div>
                        <div id="apparel-timeframe">
                            <div class="row">
                                <div class="col bg-dark mx-auto p-2 col-md-4">
                                    <table id="type-timeframe-table" class="table table-bordered table-dark bg-dark my-auto">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="col bg-dark mx-auto p-2 col-md-4">
                                    <table id="style-timeframe-table" class="table table-bordered table-dark bg-dark my-auto">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="col bg-dark mx-auto p-2 col-md-4">
                                    <table id="brand-timeframe-table" class="table table-bordered table-dark bg-dark my-auto">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="apparel-addition">
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
                    <div id="event-timeframe">
                        <div class="col bg-dark mx-auto p-2 col-md-4" style="width:100%">
                            <table id="event-timeframe-table" class="table table-bordered table-dark bg-dark my-auto">
                                <thead></thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('js/dashboard-script.js')}}"></script>

@endsection
