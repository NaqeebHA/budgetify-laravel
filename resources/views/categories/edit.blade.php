@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="title-text">Edit Category</h1>

        <div class="col-lg-6 bg-dark text-light rounded-5 mx-auto p-4">
            <form action="{{ route('categories.update', $category->id) }}" method="POST" class="text-center">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="in_out" class="form-label">Income/Expense</label>
                    <select id="in_out" name="in_out" class="form-select">
                        <option selected value=0>Expense</option>
                        <option value=1>Income</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" id="name" name="name" type="text" value="{{ $category->name }}" minlength="2" maxlength="20" required>
                </div>
                <button type="submit" id="submit-btn" class="btn rounded">Update Category</button>
            </form>
        </div>

@endsection
