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
                            <th>Title</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->from_time }}</td>
                                <td>{{ $event->to_time }}</td>
                                <td><a href="https://www.google.com/maps?q={{ $event->location }}" target="_blank">{{ $event->location }}</a></td>
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
