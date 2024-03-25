<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Custom Metric Types') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-medium text-gray-900">Your Cutom Metric Types</h3>
                        </div>
                        <a href="{{ route('custom_metric_types.create') }}" class="inline-flex items-center px-4 py-2 text-black text-lg font-medium rounded-md">
                            + Add New Metric Type
                        </a>
                    </div>                    
                    
                    <!-- Metric Types List -->
                    <div class="mt-4">
                        @foreach ($types as $metricType)
                            <div class="mb-4">
                                <div>{{ $metricType->name }} ({{ $metricType->type }})</div>
                                <a href="{{ route('custom_metric_types.edit', $metricType->id) }}" class="text-blue-600">Edit</a>
                                <form action="{{ route('custom_metric_types.destroy', $metricType->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Delete</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
