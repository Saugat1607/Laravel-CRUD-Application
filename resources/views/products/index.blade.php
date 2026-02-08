@extends('products.layout')

@section('content')

<div class="row mb-3">
    <div class="col-lg-6">
        <h2>
            {{ isset($user) ? $user->name . "'s Products" : 'My Products' }}
        </h2>
    </div>

    <div class="col-lg-6 text-end">
        <!-- Create New Product Button -->
        <a class="btn btn-success" href="{{ route('products.create') }}">Create New Product</a>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-warning">Logout</button>
        </form>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th width="280px">Actions</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @forelse ($products as $product)
        <tr>
            <td>{{ $i++ }}</td>

            <td>
                @if($product->image)
                    <img src="{{ asset('uploads/products/' . $product->image) }}" 
                         alt="{{ $product->name }}" width="80" class="img-thumbnail">
                @else
                    No Image
                @endif
            </td>

            <td>{{ $product->name }}</td>
            <td>{{ $product->details ?? $product->description ?? 'N/A' }}</td>
            <td>${{ number_format($product->price, 2) }}</td>

            <td>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    <a class="btn btn-info btn-sm mb-1" href="{{ route('products.show', $product->id) }}">Show</a>

                    <!-- Show Edit/Delete if admin or owner -->
                    @if(session()->has('is_admin') || $product->user_id == Auth::id())
                        <a class="btn btn-primary btn-sm mb-1" href="{{ route('products.edit', $product->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    @endif
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No products found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@if(method_exists($products, 'links'))
<div class="d-flex justify-content-center">
    {!! $products->links() !!}
</div>
@endif

@endsection
