@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="title-text">Apparels</h1>
        <div class="title-text"><a id="add-btn" class="btn rounded" href="{{ route('apparels.create') }}">Add an Apparel</a></div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="bg-dark rounded-3 p-2">
            @if ($apparels->count())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Note</th>
                            <th>Color</th>
                            <th>Brand</th>
                            <th>Style</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apparels as $apparel)
                            <tr>
                                <td>{{ $apparel->note }}</td>
                                <td style="background-color:{{ $apparel->color }}"></td>
                                <td>{{ $apparel->brand->name }}</td>
                                <td>{{ $apparel->style->name }}</td>
                                <td>
                                    <a class="btn btn-warning text-white" href="{{ route('apparels.edit', $apparel->id) }}"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('apparels.destroy', $apparel->id) }}" method="POST" style="display: inline-block;">
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
                <div class="alert alert-danger" role="alert">No apparel found.</div>
            @endif
        </div>
    </div>
    <div id="response"></div>

    <script>
        $('.table').DataTable({
            scrollY: 200
        });
    </script>
@endsection
