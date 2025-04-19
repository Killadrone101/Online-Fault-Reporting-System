<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Departments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Search Bar -->
                    <div class="flex justify-between mb-4 ">
                        <a href="{{ route('admin.departments.create') }}" class="bg-red-800 hover:bg-red-900 text-white font-bold py-2 px-4 rounded">
                            Add department
                        </a>
                        <input type="text" id="search" placeholder="Search departments..." class="rounded-lg px-4 py-2 w-64 border border-gray-300 text-gray-900">
                    </div>

                    <!-- Applications Table -->
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No.</th>
                                    <th scope="col" class="px-6 py-3">Department Name</th>
                                    <th scope="col" class="px-6 py-3">Department Manager</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $department->name }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $department->manager ? $department->manager->name : 'No Manager' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <!-- View Button -->
                                        <a href="{{ route('admin.departments.show', $department) }}" 
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            View
                                         </a>

                                        <!-- Remove Button -->
                                        <form method="POST" action="{{ route('admin.departments.destroy', $department) }}" class="inline" x-on:submit.prevent="if(confirm('Are you sure?')) { $el.submit(); show = false }">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 mx-2">
                                                Remove
                                            </button>
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
    </div>
</x-app-layout>