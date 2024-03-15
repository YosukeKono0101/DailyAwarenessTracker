<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Goal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('goals.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" required class="mt-1  00 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="notes" id="notes" rows="4" class="mt-1  00 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category" id="category" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="">Select Category</option>
                                <option value="personal">Personal</option>
                                <option value="work">Work</option>
                                <option value="health">Health</option>
                                <option value="education">Education</option>
                                <option value="finance">Finance</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                            <select name="priority" id="priority" class="mt-1  00 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="">Select Priority</option>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                            <input type="date" name="deadline" id="deadline" class="mt-1  00 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
