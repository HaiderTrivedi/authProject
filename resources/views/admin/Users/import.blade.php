<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-4">Import ITSIDs</h2>

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.users.handle_import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="csv_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">CSV File</label>
                            <input type="file" name="csv_file" id="csv_file" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100" required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Upload and Preview
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>