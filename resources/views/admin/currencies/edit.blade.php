<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-4">Edit Currency</h2>

                    <form action="{{ route('currencies.update', $currency->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Currency Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $currency->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                        </div>

                        <div class="mb-4">
                            <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Code</label>
                            <input type="text" name="code" id="code" value="{{ old('code', $currency->code) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                        </div>

                        <div class="mb-4">
                            <label for="symbol" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Symbol</label>
                            <input type="text" name="symbol" id="symbol" value="{{ old('symbol', $currency->symbol) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Currency
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>