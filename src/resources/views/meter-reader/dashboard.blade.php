<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reading Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Enter customer account number to enter readings") }}
                </div>
                <div>
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 p-6" action="{{ route('meterReader.createReading') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="customer_account_number">
                        Account Number
                    </label>
                    <input 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        id="customer_account_number" 
                        type="number" 
                        placeholder="Account Number"
                        name="customer_account_number"
                    >
                    @error('customer_account_number')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                        Date
                    </label>
                    <input 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        id="date" 
                        type="date" 
                        placeholder="Date"
                        name="reading_date"
                    >
                    @error('reading_date')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="meter_reading">
                        Meter Reading
                    </label>
                    <input 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        id="meter_reading" 
                        type="number" 
                        placeholder="Meter Reading"
                        name="reading_value"
                    >
                    @error('reading_value')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                    </div>
                    
                    <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Submit
                    </button>
                    </div>
                </form>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
