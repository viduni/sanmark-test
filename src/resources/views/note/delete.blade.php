<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Delete Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Delete a note!") }}
                </div>
                @if(session('message') && (session('message')['type']=='success'))
                <span class="block mt-3 text-dark-grey">{!!session('message')['description']!!}</span>
                @endif
                <form class="w-full max-w-lg p-6" method="post" action="{{route('note.destroy', $note->id)}}">
                @csrf
                @method('DELETE')
                    
                    <div class="flex items-center justify-between">
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Delete
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <a href="{{route('note.index')}}">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Cancel
                        </button>
                        </a>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>