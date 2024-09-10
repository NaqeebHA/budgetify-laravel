@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="title-text">Accounts</h1>
        <div class="title-text"><a id="add-btn" class="btn rounded" href="{{ route('accounts.create') }}">Add an Account</a></div>

        @if ($accounts->count())
            <table class="table table-bordered table-dark bg-dark">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                        <tr>
                            <td>{{ $account->name }}</td>
                            <td>
                                <a class="btn btn-warning text-white" href="{{ route('accounts.edit', $account->id) }}"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" style="display: inline-block;">
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
            <div class="alert alert-danger" role="alert">No accounts found.</div>
        @endif
    </div>
    <div id="response"></div>

@endsection
