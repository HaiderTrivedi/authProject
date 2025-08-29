<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-g">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
        <aside class="w-64 bg-white dark:bg-gray-800 shadow-md">
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Admin Panel</h2>
            </div>
            <nav class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Manage Users</a>
                <a href="{{ route('admin.users.import') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Import ITSIDs</a>
                <a href="{{ route('admin.itsids.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Manage ITSIDs</a>
                <a href="{{ route('currencies.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Currency Master</a>
                <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Settings</a>
            </nav>
        </aside>

        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>
</body>
</html>