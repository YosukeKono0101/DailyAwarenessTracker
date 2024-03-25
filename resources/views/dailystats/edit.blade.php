<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Add/Edit Daily Stat')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('dailystats.update', $dailystat->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" name="date" id="date" value="{{ $dailystat->date }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="time" class="block text-sm font-medium text-gray-700">Time Spent</label>
                            <label for="time" class="block text-sm font-medium text-gray-700">Hours</label>
                            <input type="number" name="hours" id="hours" value="{{ $dailystat->hours }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="time" class="block text-sm font-medium text-gray-700">Minutes</label>
                            <input type="number" name="minutes" id="minutes" value="{{ $dailystat->minutes }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        
                        <div class="mb-4">
                            <label for="quality_score" class="block text-sm font-medium text-gray-700">Quality Score</label>
                            <select name="quality_score" id="quality_score" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="-2" @if($dailystat->quality_score == '-2') selected @endif>-2</option>
                                <option value="-1" @if($dailystat->quality_score == '-1') selected @endif>-1</option>
                                <option value="0" @if($dailystat->quality_score == '0') selected @endif>0</option>
                                <option value="1" @if($dailystat->quality_score == '1') selected @endif>1</option>
                                <option value="2" @if($dailystat->quality_score == '2') selected @endif>2</option>                                
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="diary" class="block text-sm font-medium text-gray-700">Diary</label>
                            <textarea name="diary" id="diary" rows="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">{{ $dailystat->diary }}</textarea>
                        </div>

                        <div id="custom-metrics-container">
                            <h4 class="mb-2">Custom Metrics</h4>
                            @foreach($dailystat->customMetrics as $index => $metric)
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Metric Name</label>
                                    <input type="text" name="custom_metrics[{{ $index }}][name]" value="{{ $metric->name }}" class="block w-full mb-2" />
                                    <input type="text" name="custom_metrics[{{ $index }}][value]" value="{{ $metric->value }}" class="block w-full" />
                                </div>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="ml-4">
                                {{__('Update')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>