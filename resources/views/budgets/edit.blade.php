@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 class="title-text">Edit Budget</h1>

    <div class="col-lg-6 bg-dark text-light rounded-5 mx-auto p-4">
        <form action="{{ route('budgets.update', $budget->id) }}" method="POST" class="text-center" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="in_out" class="form-label">Income/Expense</label>
                <select id="in_out" name="in_out" class="form-select">
                    <option selected value=0>Expense</option>
                    <option value=1>Income</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="datetime" class="form-label">Date and Time</label>
                <input id="datetime" type="datetime-local" name="txn_datetime" value="{{ $budget->txn_datetime }}" required class="form-control"/>
            </div>
            <div class="mb-3">
                <label for="account" class="form-label">Account</label>
                <select id="account" name="account_id" class="form-select" required>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}" {{ $account->id == $budget->account_id ? 'selected' : '' }}>{{ $account->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select id="category" name="category_id" class="form-select" required></select>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ $budget->amount }}" required min="0" step="0.01" value="0.00">
                </div>
            </div>
            <div class="mb-3">
              <label for="note" class="form-label">Note</label>
              <input class="form-control" id="note" name="note" type="text" value="{{ $budget->note }}" minlength="2" maxlength="20">
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" type="text" value="{{ $budget->description }}" minlength="2" maxlength="255" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="attachment" class="form-label">Attachment</label>
              <input class="form-control" type="file" id="attachment" name="attachment" value="{{ $budget->attachment }}">
            </div>
            @if ($budget->attachment ?? false)
                <div id=imgDiv class="mb-3">
                    <img class="rounded" src="{{asset('storage/' . $budget->attachment)}}" alt="Failed to load attachment" style="width: 400px;">
                    <a id="removeAttachment" class="btn btn-warning">Delete Image</a>
                </div>
            @endif
            <button type="submit" id="submit-btn" class="btn rounded">Update Budget</button>
        </form>
    </div>

</div>
<div id="response"></div>

<script>
    $(document).ready(function() {

        $('#in_out').change(function() {
            var selectedInOut = $(this).val();
            $('#category').empty().append('<option value="">Select a category</option>');

            if (selectedInOut) {
                $.ajax({
                    url: '/categories/' + selectedInOut,
                    type: 'GET',
                    success: function(data) {
                        $.each(data, function(key, category) {
                            $('#category').append(`<option value=${category.id}  ${category.id === {{$budget->category_id}} ? 'selected' : '' }>${category.name}</option>`);
                        });
                    }
                });
            }
        })

        //set original in_out
        const originalInOut = {{ $budget->in_out }};
        $('#in_out').val(originalInOut).change();

        $('#removeAttachment').click(function(ev) {
            ev.preventDefault();
            $.ajax({
                type: "GET",
                url: "./delete-attachment",
                success: function(response) {
                    if (response.success) {
                        alert('Attachment removed successfully');
                        window.location.href = "./edit";
                    } else {
                        alert('There was an error!');
                    }
                },
                error: function() {
                    $("#response").html("<p>An error occured.</p>");
                }
            });
        })
    })
</script>

@endsection
