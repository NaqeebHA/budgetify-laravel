@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="title-text">Categories</h1>
        <div class="title-text"><a id="add-btn" class="btn rounded" href="{{ route('categories.create') }}">Add a Category</a></div>

        @if ($categories->count())
            <table class="table table-bordered table-dark bg-dark">
                <thead>
                    <tr>
                        <th>Income/Expense</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->in_out ? 'Income' : 'Expense' }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a class="btn btn-warning text-white" href="{{ route('categories.edit', $category->id) }}"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" category="display: inline-block;">
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
            <div class="alert alert-danger" role="alert">No categories found.</div>
        @endif
    </div>
    <div id="response"></div>

@endsection
