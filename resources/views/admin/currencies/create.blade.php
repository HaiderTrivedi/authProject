<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-4">Create New Currency</h2>

                    <form action="{{ route('currencies.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Currency Name (e.g., Indian Rupee)</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                        </div>

                        <div class="mb-4">
                            <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Code (e.g., INR)</label>
                            <input type="text" name="code" id="code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                        </div>

                        <div class="mb-4">
                            <label for="symbol" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Symbol (e.g., ₹)</label>
                            <input type="text" name="symbol" id="symbol" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                        </div>

                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Save Currency
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>