@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="title-text">Add an Apparel Type</h1>

        <div class="col-lg-6 bg-dark text-light rounded-5 mx-auto p-4">
            <form action="{{ route('apparel-types.store') }}" method="POST" class="text-center">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" id="name" name="name" type="text" minlength="2" maxlength="20" required>
                </div>
                <button type="submit" id="submit-btn" class="btn rounded">Create Apparel Type</button>
            </form>
        </div>
    </div>
    <div id="response"></div>

@endsection
