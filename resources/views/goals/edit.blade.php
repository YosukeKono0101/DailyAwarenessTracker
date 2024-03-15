<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Goal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('goals.update', $goal->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ $goal->title }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        
                        <div class="mb-4">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="notes" id="notes" rows="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">{{ $goal->notes }}</textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <input type="text" name="category" id="category" value="{{ $goal->category }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
 
                        <div class="mb-4">
                            <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                            <select name="priority" id="priority" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="" {{ $goal->priority === null ? 'selected' : '' }}>Select Priority</option>
                                <option value="high" {{ $goal->priority === 'high' ? 'selected' : '' }}>High</option>
                                <option value="medium" {{ $goal->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="low" {{ $goal->priority === 'low' ? 'selected' : '' }}>Low</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                            <input type="date" name="deadline" id="deadline" value="{{ $goal->deadline ? $goal->deadline->format('Y-m-d') : '' }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="ml-4">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
