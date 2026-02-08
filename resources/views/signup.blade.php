<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded shadow w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Sign Up</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('signup') }}" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Name" class="w-full border px-4 py-2 rounded" required>
        <input type="email" name="email" placeholder="Email" class="w-full border px-4 py-2 rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full border px-4 py-2 rounded" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full border px-4 py-2 rounded" required>
        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600 transition">Sign Up</button>
    </form>

    <p class="text-center mt-4 text-sm">
        Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Login</a>
    </p>
</div>

</body>
</html>
