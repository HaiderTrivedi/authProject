<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold">Manage Currencies</h2>
                        <a href="{{ route('currencies.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Create New Currency
                        </a>
                    </div>

                    <form action="{{ route('currencies.bulkDestroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete the selected currencies?');">
                        @csrf
                        @method('DELETE')
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-gray-800">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b dark:border-gray-700"><input type="checkbox" id="select-all"></th>
                                        <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Name</th>
                                        <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Code</th>
                                        <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Symbol</th>
                                        <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($currencies as $currency)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td class="py-2 px-4 border-b dark:border-gray-700"><input type="checkbox" name="selected_currencies[]" value="{{ $currency->id }}"></td>
                                            <td class="py-2 px-4 border-b dark:border-gray-700">{{ $currency->name }}</td>
                                            <td class="py-2 px-4 border-b dark:border-gray-700">{{ $currency->code }}</td>
                                            <td class="py-2 px-4 border-b dark:border-gray-700">{{ $currency->symbol }}</td>
                                            <td class="py-2 px-4 border-b dark:border-gray-700">
                                                <a href="{{ route('currencies.edit', $currency->id) }}" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-4 px-4 text-center text-gray-500">No currencies found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete Selected
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
    document.getElementById('select-all').addEventListener('click', function(event) {
        const checkboxes = document.querySelectorAll('input[name="selected_currencies[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });
</script>