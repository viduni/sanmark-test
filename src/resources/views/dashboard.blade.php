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
                    {{ __("Click Add readings button to enter customer readings") }}
                </div>
                @if ($message = Session::get('success'))
                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                        <p class="font-bold">{{ $message }}</p>
                    </div>
                @endif
                <div class="p-6 text-gray-900">
                <a href="{{ route('meterReader.dashboard') }}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Add Readings
                    </button>
                </a>
                
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
