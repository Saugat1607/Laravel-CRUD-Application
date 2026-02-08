@extends('products.layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2>Add New Product</h2>
        <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

    @csrf

    <div class="row mb-3">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>Name:</strong>
            <input type="text" name="name" class="form-control" placeholder="Product Name" value="{{ old('name') }}">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>Details:</strong>
            <textarea class="form-control" style="height:150px" name="details" placeholder="Product Description">{{ old('details') }}</textarea>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>Price:</strong>
            <input type="number" name="price" class="form-control" placeholder="Product Price" value="{{ old('price') }}" step="0.01">
        </div>
    </div>


    <div class="mb-3">
        <label>Product Image</label>
        <input type="file" name="image" class="form-control">
    </div>


    <div class="row mb-3">
        <div class="col-xs-12 col-sm-12 col-md-12 text-end">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>
</form>

@endsection
