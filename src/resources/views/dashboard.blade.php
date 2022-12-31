<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <div>
                    <button class="p-6 text-gray-900 bg-indigo-500 w-full">
                        <a href="">Create Note</a>
                    </button>
                </div>
                <div class="mt-0.5">
                    <button class="p-6 text-gray-900 bg-indigo-500 w-full">
                        View Notes
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
