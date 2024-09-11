@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 class="title-text">Edit Apparel</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="bg-dark text-light rounded-5 mx-auto p-4">
        <form action="{{ route('apparels.update', $apparel->id) }}" method="POST" class="text-center" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="type" class="form-label">Type</label>
                    <select id="type" name="type_id" class="form-select" required>
                        @foreach ($apparelTypes as $apparelType)
                            <option value="{{ $apparelType->id }}" {{ $apparelType->id == $apparel->type_id ? 'selected' : '' }}>{{ $apparelType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="purchased_date" class="form-label">Purchased Date</label>
                    <input id="purchased_date" type="date" name="purchased_date" class="form-control"/>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="note" class="form-label">Note</label>
                    <input class="form-control" id="note" name="note" value="{{ $apparel->note }}" type="text" minlength="2" maxlength="20" required>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="color" class="form-label">Color</label>
                    <input class="form-control" id="color" name="color" value="{{ $apparel->color }}" type="color" minlength="2" maxlength="20" required>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $apparel->price }}" min="0" step="0.01" value="0.00" required>
                    </div>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="qty" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="qty" name="qty" value="{{ $apparel->qty }}" min="1" value="1" required>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" value="{{ $apparel->description }}" type="text" minlength="2" maxlength="255" rows="1"></textarea>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="brand" class="form-label">Brand</label>
                    <select id="brand" name="brand_id" class="form-select" required>
                        <option value="">Select a Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $brand->id == $apparel->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="style" class="form-label">Style</label>
                    <select id="style" name="style_id" class="form-select" required>
                        <option value="">Select a Style</option>
                        @foreach ($styles as $style)
                            <option value="{{ $style->id }}" {{ $style->id == $apparel->style_id ? 'selected' : '' }}>{{ $style->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="budget" class="form-label">Budget</label>
                    <select id="budget" name="budget_id" class="form-select">
                        <option value="">Select a Budget</option>
                        @foreach ($budgets as $budget)
                            <option value="{{ $budget->id }}" {{ $budget->id == $apparel->budget_id ? 'selected' : '' }}>{{ $budget->note }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="attachment" class="form-label">Attachment</label>
                    <input class="form-control" type="file" id="attachment" name="attachment">
                </div>
            </div>
            <div class="row">
                <div class="preview-container col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <img id="preview" class="preview-image mx-auto" alt="Image Preview" style="display:none;">
                </div>
            </div>

            @if ($apparel->attachment ?? false)
                <div class="row">
                    <div class="imgDiv col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                        <img id="attachmentDisplay" class="rounded" src="{{asset('storage/' . $apparel->attachment)}}" alt="Failed to load attachment" style="width: 100%; height:auto">
                    </div>
                </div>
                <div class="row">
                    <div class="deleteImgDiv col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                        <a id="removeAttachment" class="btn btn-warning">Delete Attachment</a>
                    </div>
                </div>
            @endif

            <button id="back-btn" type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
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
<script src="{{ asset('js/image-preview.js') }}"></script>

@endsection
