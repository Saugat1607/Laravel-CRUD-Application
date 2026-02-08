<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded shadow w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}" class="space-y-4">
        @csrf
        <input type="text" name="email" placeholder="Email or username" class="w-full border px-4 py-2 rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full border px-4 py-2 rounded" required>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">Login</button>
    </form>

    <p class="text-center mt-4 text-sm">
        Don’t have an account? <a href="{{ route('signup') }}" class="text-blue-500 hover:text-blue-700">Sign Up</a>
    </p>
</div>

</body>
</html>
