<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Daily Stats') }}
      </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">                
                <div class="flex justify-between mb-4">
                    <div>
                        <h3 class="text-xl font-medium text-gray-900">Daily Tracker</h3>
                    </div>
                    <a href="{{ route('dailystats.create') }}" class="inline-flex items-center px-4 py-2 text-black text-lg font-medium rounded-md">
                        + Add New Daily Stat
                    </a>
                </div>                
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-base font-medium text-black-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-base font-medium text-black-500 uppercase tracking-wider">
                                Time Spent
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-base font-medium text-black-500 uppercase tracking-wider">
                                Quality Score
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-base font-medium text-black-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($dailystats as $stat)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-base text-gray-500">
                                {{ $stat->date }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-base text-gray-500">
                                {{ $stat->time }} minutes
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-base text-gray-500">
                                {{ $stat->quality_score }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-base font-medium">
                                <a href="{{ route('dailystats.show', $stat->id) }}" class="text-indigo-600 mr-2">View</a>
                                <a href="{{ route('dailystats.edit', $stat->id) }}" class="text-green-600 mr-2">Edit</a>
                                <form action="{{ route('dailystats.destroy', $stat->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>
        </div>
    </div>
</div>
</x-app-layout>
