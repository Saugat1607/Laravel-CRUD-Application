<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->name }}'s Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Navbar -->
<header class="bg-blue-600 text-white p-4 shadow flex justify-between items-center">
    <h1 class="text-2xl font-bold">{{ $user->name }}'s Products</h1>
    <a href="{{ route('admin.dashboard') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
        ← Back to Dashboard
    </a>
</header>

<!-- Main Content -->
<main class="p-6">
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-semibold mb-4">Products List</h2>

        @if ($products->isEmpty())
            <p class="text-gray-600">No products found for this user.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Price</th>
                            <th class="px-4 py-2 border">Description</th>
                            <th class="px-4 py-2 border">Created At</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $product->id }}</td>
                            <td class="px-4 py-2 border">{{ $product->name }}</td>
                            <td class="px-4 py-2 border">${{ number_format($product->price, 2) }}</td>
                            <td class="px-4 py-2 border">{{ $product->details }}</td>
                            <td class="px-4 py-2 border">{{ $product->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-2 border flex gap-2">
                                <!-- Edit Button -->
                                <a href="{{ route('products.edit', $product->id) }}" 
                                   class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('products.destroy', $product->id) }}" 
                                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</main>

</body>
</html>
