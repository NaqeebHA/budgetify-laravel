@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 class="title-text">Add an Apparel</h1>

    <div class="col bg-dark text-light rounded-5 mx-auto p-4">
        <form action="{{ route('apparels.store') }}" method="POST" class="text-center" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="type" class="form-label">Type</label>
                    <select id="type" name="type_id" class="form-select">
                        @foreach ($apparelTypes as $apparelType)
                            <option value="{{ $apparelType->id }}">{{ $apparelType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="purchased_date" class="form-label">Purchased Date</label>
                    <input id="purchased_date" type="date" name="purchased_date" class="form-control"/>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="note" class="form-label">Note</label>
                    <input class="form-control" id="note" name="note" type="text" minlength="2" maxlength="20">
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="color" class="form-label">Color</label>
                    <input class="form-control" id="color" name="color" type="text" minlength="2" maxlength="20">
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" id="price" name="price" required min="0" step="0.01" value="0.00">
                    </div>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="qty" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="qty" name="qty" required min="1" value="1">
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" type="text" minlength="2" maxlength="255" rows="1"></textarea>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="brand" class="form-label">Brand</label>
                    <select id="brand" name="brand_id" class="form-select">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="style" class="form-label">Style</label>
                    <select id="style" name="style_id" class="form-select">
                        @foreach ($styles as $style)
                            <option value="{{ $style->id }}">{{ $style->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="budget" class="form-label">Budget</label>
                    <select id="budget" name="budget_id" class="form-select">
                        @foreach ($budgets as $budget)
                            <option value="{{ $budget->id }}">{{ $budget->note }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6 mb-3 mx-auto">
                    <label for="attachment" class="form-label">Attachment</label>
                    <input class="form-control" type="file" id="attachment" name="attachment">
                </div>
            </div>
            <button type="submit" id="submit-btn" class="btn rounded">Add Apparel</button>
        </form>
    </div>

</div>
<div id="response"></div>

@endsection
