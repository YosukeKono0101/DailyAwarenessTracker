<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Add New Daily Stat') }}</h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="alert bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('date_error'))
                        <div class="alert bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">{{ session('date_error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('dailystats.store') }}" id="dailyStatForm">
                        @csrf
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" name="date" id="date" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
    
                        <div class="mb-4">
                            <label for="time" class="block text-sm font-medium text-gray-700">Time Spent</label>
                            <p class="mt-1 text-sm text-gray-500">Enter the number of hours and minutes you spent on cretive projects.</p>
                            <input type="number" name="hours" id="hours" class="mt-1   block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0"> 
                        </div>                                            
                        
                        <div class="mb-4">
                            <label for="minutes" class="block text-sm font-medium text-gray-700">Minutes</label>
                            <input type="number" name="minutes" id="minutes" class="mt-1   block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0">
                        </div>
                         
                       
                        <div class="mb-4">
                            <label for="quality_score" class="block text-sm font-medium text-gray-700">Quality Score</label>
                            <select name="quality_score" id="quality_score" required class="mt-1  fo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="-2">-2 (Poor)</option>
                                <option value="-1">-1 (Below Average)</option>
                                <option value="0" selected>0 (Average)</option>                            
                                <option value="1">1 (Above Average)</option>
                                <option value="2">2 (Excellent)</option>                            
                            </select>
                        </div>
                                                                            
                        <div class="mb-4">
                            <label for="diary" class="block text-sm font-medium text-gray-700">Diary</label>
                            <textarea name="diary" id="diary" rows="4" class="mt-1  fo block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"></textarea>
                        </div>
    
                        <div class="mb-4">
                            <h4 class="text-lg font-medium text-gray-900">Custom Metrics</h4>
                            @foreach ($metricTypes as $type)
                            <div class="mb-2">
                                <label class="block text-sm font-medium text-gray-700">{{ $type->name }}</label>
                                <input type="hidden" name="metrics[{{ $type->id }}][type_id]" value="{{ $type->id }}">
                                <input type="{{ $type->type === 'numeric' ? 'number' : 'text' }}" name="metrics[{{ $type->id }}][value]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white font-medium rounded-md hover:bg-gray-700">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>