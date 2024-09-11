@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="title-text">Events</h1>
        <div class="title-text"><a id="add-btn" class="btn rounded" href="{{ route('events.create') }}">Add an Event</a></div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="bg-dark rounded-3 p-2">
            @if ($events->count())
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
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->note }}</td>
                                <td style="background-color:{{ $event->color }}"></td>
                                <td>{{ $event->brand->name }}</td>
                                <td>{{ $event->style->name }}</td>
                                <td>
                                    <a class="btn btn-warning text-white" href="{{ route('events.edit', $event->id) }}"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline-block;">
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
                <div class="alert alert-danger" role="alert">No event found.</div>
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
