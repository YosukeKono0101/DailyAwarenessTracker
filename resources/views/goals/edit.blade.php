<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Daily Stat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('daily_stats.update', $dailyStat->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Date -->
                        <div>
                            <x-label for="date" :value="__('Date')" />
                            <x-input id="date" class="block mt-1 w-full" type="date" name="date" value="{{ $dailyStat->date->format('Y-m-d') }}" required />
                        </div>

                        <!-- Time Spent -->
                        <div class="mt-4">
                            <x-label for="time_spent" :value="__('Time Spent (in minutes)')" />
                            <x-input id="time_spent" class="block mt-1 w-full" type="number" name="time_spent" value="{{ $dailyStat->time_spent }}" required />
                        </div>

                        <!-- Quality Score -->
                        <div class="mt-4">
                            <x-label for="quality_score" :value="__('Quality Score')" />
                            <x-input id="quality_score" class="block mt-1 w-full" type="number" name="quality_score" value="{{ $dailyStat->quality_score }}" required />
                        </div>

                        <!-- Diary -->
                        <div class="mt-4">
                            <x-label for="diary" :value="__('Diary')" />
                            <textarea id="diary" name="diary" rows="4" class="block mt-1 w-full">{{ $dailyStat->diary }}</textarea>
                        </div>

                        <!-- Custom Metrics -->
                        <div class="mt-4">
                            <h3 class="text-lg font-medium">Custom Metrics</h3>
                            @foreach ($dailyStat->customMetrics as $customMetric)
                            <div class="mt-4">
                                <x-label :value="$customMetric->customMetricType->name" />
                                <x-input class="block mt-1 w-full" type="text" name="custom_metrics[{{ $customMetric->customMetricType->id }}]" value="{{ $customMetric->value }}" />
                            </div>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
