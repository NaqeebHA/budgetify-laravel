@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="title-text">Apparel Types</h1>
        <div class="title-text"><a id="add-btn" class="btn rounded" href="{{ route('apparel-types.create') }}">Add an Apparel Type</a></div>

        @if ($apparelTypes->count())
            <table class="table table-bordered table-dark bg-dark">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apparelTypes as $apparelType)
                        <tr>
                            <td>{{ $apparelType->name }}</td>
                            <td>
                                <a class="btn btn-warning text-white" href="{{ route('apparel-types.edit', $apparelType->id) }}"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('apparel-types.destroy', $apparelType->id) }}" method="POST" style="display: inline-block;">
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
            <div class="alert alert-danger" role="alert">No apparel types found.</div>
        @endif
    </div>
    <div id="response"></div>

@endsection
