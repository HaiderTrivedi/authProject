<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-4">Manage ITSIDs</h2>

                    <form action="{{ route('admin.itsids.send') }}" method="POST">
                        @csrf
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-gray-800">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b dark:border-gray-700"><input type="checkbox" id="select-all"></th>
                                        <th class="py-2 px-4 border-b dark:border-gray-700 text-left">ITSID</th>
                                        <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Name</th>
                                        <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Email</th>
                                        <th class="py-2 px-4 border-b dark:border-gray-700 text-left">WhatsApp</th>
                                        <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($itsids as $item)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td class="py-2 px-4 border-b dark:border-gray-700">
                                                @if($item->status === 'fetched')
                                                    <input type="checkbox" name="selected_itsids[]" value="{{ $item->id }}">
                                                @endif
                                            </td>
                                            <td class="py-2 px-4 border-b dark:border-gray-700">{{ $item->itsid }}</td>
                                            <td class="py-2 px-4 border-b dark:border-gray-700">{{ $item->name }}</td>
                                            <td class="py-2 px-4 border-b dark:border-gray-700">{{ $item->email }}</td>
                                            <td class="py-2 px-4 border-b dark:border-gray-700">{{ $item->whatsapp_number }}</td>
                                            <td class="py-2 px-4 border-b dark:border-gray-700">{{ $item->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Send Credentials to Selected
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
        const checkboxes = document.querySelectorAll('input[name="selected_itsids[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });
</script>