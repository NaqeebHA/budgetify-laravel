
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logoBudgetify.png') }}" type="image/x-icon">

    <title>Budgetify</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  </head>
  <body>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand rounded-pill px-2" href="/">
        <img src="{{ asset('img/logoBudgetify.png') }}" alt="Budgetify" height="24">
        Budgetify
      </a>
      <span class="navbar-text">
      <a id="addBudgetBtn" class="btn rounded" href="/budgets/create">Add Budget</a>
      </span>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse float-center" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/budgets">Budget</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/apparels">Apparel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/events">Event</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>


<script type="text/javascript">
  $(document).ready(function () {
    var currentPath = window.location.pathname.split("/").pop();

    $('.nav-link').each(function () {
      var linkPath = $(this).attr('href');
      if (linkPath === currentPath) {
        $(this).addClass('active');
      }
    });
  });
</script>
