<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Submission History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Receipt No.</th>
                                    <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Date</th>
                                    <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Name</th>
                                    <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Total Collection</th>
                                    <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($submissions as $submission)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="py-2 px-4 border-b dark:border-gray-700">{{ $submission->receipt_no }}</td>
                                        <td class="py-2 px-4 border-b dark:border-gray-700">{{ $submission->receipt_date }}</td>
                                        <td class="py-2 px-4 border-b dark:border-gray-700">{{ $submission->name }}</td>
                                        <td class="py-2 px-4 border-b dark:border-gray-700">{{ $submission->total_collection }}</td>
                                        <td class="py-2 px-4 border-b dark:border-gray-700">
                                            <a href="{{ route('submission.edit', $submission) }}" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                Edit
                                            </a>
                                            <form action="{{ route('submission.destroy', $submission) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 px-4 text-center text-gray-500">You have not made any submissions yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>