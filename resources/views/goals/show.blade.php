<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Goal Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <strong>Title:</strong>
                        <span>{{ $goal->title }}</span>
                    </div>
                    <div>
                        <strong>Notes:</strong>
                        <p>{{ $goal->notes }}</p>
                    </div>
                    <div>
                        <strong>Category:</strong>
                        <span>{{ $goal->category }}</span>
                    </div>
                    <div>
                        <strong>Priority:</strong>
                        <span>{{ $goal->priority }}</span>
                    </div>
                    <div>
                        <strong>Deadline:</strong>
                        <span>{{ $goal->deadline ? $goal->deadline->format('Y-m-d') : 'No Deadline Specified' }}</span>
                    </div>                    
                    
                    <a href="{{ route('goals.index') }}" class="btn btn-primary mt-4">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




