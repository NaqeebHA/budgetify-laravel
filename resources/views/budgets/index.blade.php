@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="title-text">Budgets</h1>
        <div class="title-text"><a id="add-btn" class="btn rounded" href="{{ route('budgets.create') }}">Add a Budget</a></div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($budgets->count())
            <table class="table table-bordered table-dark bg-dark">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Account</th>
                        <th>Category</th>
                        <th>Note</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($budgets as $budget)
                        <tr>
                            <td>{{ $budget->txn_datetime }}</td>
                            <td>{{ $budget->account_id }}</td>
                            <td>{{ $budget->category_id }}</td>
                            <td>{{ $budget->note }}</td>
                            <td class={{$budget->in_out == 0 ? 'text-danger' : 'text-primary'}}>
                                {{ $budget->amount }}
                            </td>
                            <td>
                                <a class="btn btn-warning text-white" href="{{ route('budgets.edit', $budget->id) }}"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-danger" role="alert">No budgets found.</div>
        @endif
    </div>
    <div id="response"></div>

    <script>
        $('.table').DataTable();
    </script>
@endsection
