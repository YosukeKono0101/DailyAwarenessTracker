<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 space-y-8">
                    <div>
                        <h3 class="text-xl font-medium text-gray-900">Welcome back, {{ Auth::user()->name }}!</h3>
                        <p class="mt-1 text-base text-gray-600">
                            Quick overview of your recent activity.
                        </p>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-lg shadow">
                        <h4 class="text-lg font-medium text-gray-900">Average Daily Activity</h4>
                        <p>Average Time Spent Doing Creative Work: {{ number_format($averageTimeSpent, 2) }} minutes</p>
                        <p>Average Quality Score: {{ number_format($averageQualityScore, 2) }}</p>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-lg shadow">
                        <h4 class="text-lg font-medium text-gray-900">Recent Goal</h4>
                        <div class="mt-2">
                        @if($recentGoal)
                            <p>Title: {{ $recentGoal->title }}</p>
                            <p>Notes: {{ Str::limit($recentGoal->notes, 100) }}</p>
                            <a href="{{ route('goals.show', $recentGoal->id) }}" class="text-blue-700 text-md">View Goal Details</a>
                        @else
                            <p>No goals added yet.</p>
                        @endif
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('dailystats.create') }}" class="px-4 py-2 bg-blue-500 text-black text-md font-medium rounded-md">
                            Add New Stat
                        </a>
                        <a href="{{ route('goals.create') }}" class="px-4 py-2 bg-green-500 text-black text-md font-medium rounded-md">
                            Add New Goal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
