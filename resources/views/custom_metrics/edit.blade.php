<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Custom Metric Type') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    <form method="POST" action="{{ route('custom_metrics.update', $customMetricType->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Metric Name -->
                        <div>
                            <x-label for="name" :value="__('Metric Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $customMetricType->name)" required autofocus />
                        </div>

                        <!-- Metric Type -->
                        <div class="mt-4">
                            <x-label for="type" :value="__('Metric Type')" />
                            <select id="type" name="type" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="numeric" {{ $customMetricType->type == 'numeric' ? 'selected' : '' }}>Numeric</option>
                                <option value="text" {{ $customMetricType->type == 'text' ? 'selected' : '' }}>Text</option>
                            </select>
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
