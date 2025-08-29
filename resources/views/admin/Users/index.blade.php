<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-4">Manage Users</h2>

                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-semibold">Manage Users</h2>
                            <a href="{{ route('admin.users.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Create New User
                            </a>
                        </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b dark:border-gray-700 text-left">ID</th>
                                    <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Name</th>
                                    <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Email</th>
                                    <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Actions</th>
                                </tr>
                            </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="py-2 px-4 border-b dark:border-gray-700">{{ $user->id }}</td>
                            <td class="py-2 px-4 border-b dark:border-gray-700">{{ $user->name }}</td>
                            <td class="py-2 px-4 border-b dark:border-gray-700">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b dark:border-gray-700">
                                <a href="{{ route('admin.users.edit', $user) }}" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-xs">
                                    Edit
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>