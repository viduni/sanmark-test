<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("View all notes!") }}
                </div>
                @if(session('message') && (session('message')['type']=='success'))
                <span class="block mt-3 text-dark-grey">{!!session('message')['description']!!}</span>
                @endif
                
                <div>
                    @php
                    var_dump($notes);
                    @endphp
                </div>
            </div>
        </div>
    </div>
</x-app-layout>