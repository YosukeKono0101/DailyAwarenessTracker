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
                        <a href="{{ route('customMetricTypes.create') }}" class="inline-flex items-center px-4 py-2 text-black text-lg font-medium rounded-md">
                            + Add New Metric Type
                        </a>
                    </div>
                    <!-- Metrics List -->
                    <div class="flow-root mt-6">
                        <ul class="divide-y divide-gray-200">
                            @forelse ($customMetrics as $metricType)
                                <li class="py-4">
                                    <div class="flex justify-between">
                                        <h4 class="text-md font-medium text-gray-900">{{ $metricType->name }}</h4>
                                        <div class="flex">
                                            <a href="{{ route('custom_metrics.edit', $metricType->id) }}" class="text-blue-600 hover:text-blue-900 mr-4">Edit</a>
                                            <form action="{{ route('customMetricTypes.destroy', $metricType->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li>No custom metric types found.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
