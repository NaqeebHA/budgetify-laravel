@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 class="title-text">Edit Event</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="bg-dark text-light rounded-5 mx-auto p-4">
        <form action="{{ route('events.update', $event->id) }}" method="POST" class="text-center" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="title" class="form-label">Title</label>
                    <input class="form-control" id="title" name="title" type="text" minlength="2" maxlength="50" value="{{ $event->title }}" required>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="from_time" class="form-label">From</label>
                    <input id="from_time" type="datetime-local" name="from_time" value="{{ $event->from_time }}" class="form-control"/>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="to_time" class="form-label">To</label>
                    <input id="to_time" type="datetime-local" name="to_time" value="{{ $event->to_time }}" class="form-control"/>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="budget" class="form-label">Budget</label>
                    <select id="budget" name="budget_id" class="form-select">
                        <option value="">Select a Budget</option>
                        @foreach ($budgets as $budget)
                            <option value="{{ $budget->id }}" {{ $budget->id == $event->budget_id ? 'selected' : '' }}>{{ $budget->note }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" type="text" minlength="2" maxlength="255" rows="1"value="{{ $event->description }}" ></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <div class="row mb-1">
                        <label for="location" class="form-label">Location</label>
                        <input class="form-control" id="location" name="location" type="text" placeholder="Click on the map to select location" value="{{ $event->location }}">
                    </div>
                    <div class="map-container row">
                        <div id="map" style="height: 300px;"></div>
                    </div>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <div class="row mb-1">
                        <label for="attachment" class="form-label">Attachment</label>
                        <input class="form-control" type="file" id="attachment" name="attachment">
                    </div>
                    <div class="preview-container row">
                        <img id="preview" class="preview-image mx-auto" alt="Image Preview">
                    </div>
                </div>
                @if ($event->attachment ?? false)
                    <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                        <div class="row mb-1">
                            <p class="mb-2">Current Attachment</p>
                            <a id="removeAttachment" class="btn btn-warning">Delete Attachment</a>
                        </div>
                        <div class="row">
                            <div class="imgDiv">
                                <img id="attachmentDisplay" class="rounded" src="{{asset('storage/' . $event->attachment)}}" alt="Failed to load attachment" style="width: 100%; height:auto">
                            </div>
                        </div>
                    </div>
                @endif
            </div>



            <button id="back-btn" type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
            <button type="submit" id="submit-btn" class="btn rounded">Update Event</button>
        </form>
    </div>

</div>
<div id="response"></div>

<script>
    $(document).ready(function() {

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
<script src="{{ asset('js/image-preview.js') }}"></script>
<script>
    var map = L.map('map').setView([3.140853, 101.693207], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker;

    map.on('click', function(e) {
        var latlng = e.latlng;
        if (marker) {
        marker.setLatLng(latlng);
        } else {
        marker = L.marker(latlng).addTo(map);
        }

        document.getElementById('location').value = latlng.lat + ', ' + latlng.lng;
    });
</script>

@endsection
