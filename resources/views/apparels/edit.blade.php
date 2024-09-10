@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 class="title-text">Edit Apparel</h1>

    <div class="col-lg-6 bg-dark text-light rounded-5 mx-auto p-4">
        <form action="{{ route('apparels.update', $apparel->id) }}" method="POST" class="text-center" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select id="type" name="type_id" class="form-select">
                    @foreach ($apparelTypes as $apparelType)
                        <option value="{{ $apparelType->id }}" {{ $apparelType->id == $apparel->type_id ? 'selected' : '' }}>{{ $apparelType->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="purchased_date" class="form-label">Purchased Date</label>
                <input id="purchased_date" type="date" name="purchased_date" class="form-control"/>
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <input class="form-control" id="note" name="note" value="{{ $apparel->note }}" type="text" minlength="2" maxlength="20">
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input class="form-control" id="color" name="color" value="{{ $apparel->color }}" type="text" minlength="2" maxlength="20">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $apparel->price }}" required min="0" step="0.01" value="0.00">
                </div>
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="qty" name="qty" value="{{ $apparel->qty }}" required min="1" value="1">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" value="{{ $apparel->description }}" type="text" minlength="2" maxlength="255" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <select id="brand" name="brand_id" class="form-select">
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $apparel->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="style" class="form-label">Style</label>
                <select id="style" name="style_id" class="form-select">
                    @foreach ($styles as $style)
                        <option value="{{ $style->id }}" {{ $style->id == $apparel->style_id ? 'selected' : '' }}>{{ $style->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="budget" class="form-label">Budget</label>
                <select id="budget" name="budget_id" class="form-select">
                    @foreach ($budgets as $budget)
                        <option value="{{ $budget->id }}" {{ $budget->id == $apparel->budget_id ? 'selected' : '' }}>{{ $apparel->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="attachment" class="form-label">Attachment</label>
                <input class="form-control" type="file" id="attachment" name="attachment">
            </div>
            @if ($apparel->attachment ?? false)
                <div id=imgDiv class="mb-3">
                    <img class="rounded" src="{{asset('storage/' . $apparel->attachment)}}" alt="Failed to load attachment" style="width: 400px;">
                    <a id="removeAttachment" class="btn btn-warning">Delete Image</a>
                </div>
            @endif
            <button type="submit" id="submit-btn" class="btn rounded">Update Apparel</button>
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

@endsection
