<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Navbar -->
<header class="bg-blue-600 text-white p-4 shadow">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">
                Logout
            </button>
        </form>
    </div>
</header>

<!-- Main Content -->
<main class="p-6">

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Users</h2>
            <p class="text-3xl font-bold">{{ $users->count() }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Products</h2>
            <p class="text-3xl font-bold">
                {{ $users->sum(fn($user) => $user->products->count()) }}
            </p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Admin Panel</h2>
            <p class="text-gray-600">Manage users and products</p>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Users List</h2>

        <table class="w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2 text-center">Products</th>
                    <th class="border px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $user->id }}</td>

                    <!-- Click name to see products -->
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.user.products', $user->id) }}"
                           class="text-blue-600 hover:underline">
                            {{ $user->name }}
                        </a>
                    </td>

                    <td class="border px-4 py-2">{{ $user->email }}</td>

                    <td class="border px-4 py-2 text-center">
                        {{ $user->products->count() }}
                    </td>

                    <!-- Edit Button -->
                    <td class="border px-4 py-2 text-center">
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                            Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main>

</body>
</html>
