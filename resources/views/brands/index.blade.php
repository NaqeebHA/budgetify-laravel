@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="title-text">Brands</h1>
        <div class="title-text"><a id="add-btn" class="btn rounded" href="{{ route('brands.create') }}">Add a Brand</a></div>

        @if ($brands->count())
            <table class="table table-bordered table-dark bg-dark">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $brand->name }}</td>
                            <td>
                                <a class="btn btn-warning text-white" href="{{ route('brands.edit', $brand->id) }}"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display: inline-block;">
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
            <div class="alert alert-danger" role="alert">No brand found.</div>
        @endif
    </div>
    <div id="response"></div>

@endsection
