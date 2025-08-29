<x-app-layout>
    <x-slot name="header">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- ... your existing dashboard content ... --}}
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
                <a href="{{ route('submission.create') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create New Submission
                </a>
                <a href="{{ route('submission.index') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-4">
                    View History
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
