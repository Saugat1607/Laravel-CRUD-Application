<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Edit User Details</h2>

        <!-- Back Button -->
        <a href="{{ route('admin.dashboard') }}"
           class="text-blue-600 hover:underline mb-4 inline-block">
            ← Back to Dashboard
        </a>

        <!-- Edit User Form -->
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Name</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full border px-3 py-2 rounded"
                    required
                >
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full border px-3 py-2 rounded"
                    required
                >
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="bg-green-500 text-white px-5 py-2 rounded hover:bg-green-600">
                    Update User
                </button>
            </div>
        </form>
    </div>

</body>
</html>
