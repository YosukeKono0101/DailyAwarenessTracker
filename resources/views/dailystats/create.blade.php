<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leadng-tight">{{ __('Add New Daily Stat') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">      
                @if ($errors->any())
                <div class="alert text-red-600 text-xl">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif                        
                @if (session('date_error'))
                <div class="alert text-red-600 text-xl">
                    {{ session('date_error') }}
                </div>v
                @endif
                <form method="POST" action="{{ route('dailystats.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" id="date" required class="mt-1  block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label for="hours" class="block text-sm font-medium text-gray-700">Hours Spent on Creative Work</label>
                        <p class="mt-1 text-sm text-gray-500">Enter the number of hours and minutes you spent on cretive projects.</p>
                        <input type="number" name="hours" id="hours" class="mt-1   block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Hours"> 
                    </div>
                    
                    <div class="mb-4">
                        <label for="minutes" class="block text-sm font-medium text-gray-700">Minutes</label>
                        <input type="number" name="minutes" id="minutes" class="mt-1  block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Minutes">                                                
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

                    <div id="custom-metrics-container">
                        <h4 class="mb-2">Your Personalized Tracking</h4> 
                        <p class="text-sm mb-4">Here, you can track up to 3 additional personal habits or activities. Just name them and input today's count, value, or any note you'd like to keep.</p>
                        @for ($i = 0; $i < 3; $i++)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Activity/Habit {{$i + 1}}</label>
                                <input type="text" name="custom_metrics[{{$i}}][name]" class="block w-full mb-2" />
                                <input type="text" name="custom_metrics[{{$i}}][value]" class="block w-full" />
                            </div>
                        @endfor
                    </div>                                        

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="ml-4">                            
                            {{ __('Save') }}
                        </button>
                    </div>                    
                </form>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>