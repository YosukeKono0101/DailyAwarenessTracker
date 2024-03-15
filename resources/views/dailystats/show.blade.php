<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daily Stat Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">{{ $dailystat->date }}</h3>
                    <div class="mt-4">
                        <p><strong>Time Spent:</strong> {{ $dailystat->time }}</p>
                        <p><strong>Quality Score:</strong> {{ $dailystat->quality_score }}</p>
                        <p><strong>Diary:</strong> {{ $dailystat->diary }}</p>
                    </div>
                    <a href="{{ route('dailystats.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white text-sm font-medium rounded-md">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
