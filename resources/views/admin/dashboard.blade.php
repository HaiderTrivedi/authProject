<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-4">Dashboard</h2>
                    <p>Welcome to the admin dashboard!</p>

                    <div class="mt-6">
                        <a href="{{ route('admin.users.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Manage Users
                        </a>
                        <a href="#" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-4">
                            View Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>