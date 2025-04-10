<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fault Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Search Bar -->
                    <div class="flex justify-between mb-4 ">
                        <a href="{{ route('student.reports.create') }}" class="bg-green-500 hover:bg-green-700 text-dark font-bold py-2 px-4 rounded">
                            File New Fault
                        </a>
                        <input type="text" id="search" placeholder="Search reports..." class="rounded-lg px-4 py-2 w-64 border border-gray-300 text-gray-900">
                    </div>

                    <!-- Applications Table -->
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No.</th>
                                    <th scope="col" class="px-6 py-3">Issue Type</th>
                                    <th scope="col" class="px-6 py-3">Fault Image</th>
                                    <th scope="col" class="px-6 py-3">Department Assigned To</th>
                                    <th scope="col" class="px-6 py-3">Date Reported</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reports as $report)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $report->category ?? "N/A" }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($report->image)
                                            <a href="{{ Storage::url($report->image) }}" target="_blank">
                                                <img src="{{ Storage::url($report->image) }}" 
                                                     alt="Fault Image" 
                                                     class="h-16 w-16 object-cover rounded-md border border-gray-200 shadow-sm hover:opacity-80 transition-opacity">
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-xs italic">No image</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">{{ $report->category ?? "N/A" }} {{ "Department" }}</td>
                                    <td class="px-6 py-4 text-gray-900">{{ $report->created_at ?? "N/A" }}</td>
                                    <td class="px-6 py-4 text-gray-900">
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-full 
                                            {{ $report->status === 'solved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                               'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' }}">
                                            {{ $report->status ?? "N/A" }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <!-- View -->
                                        <a href="{{ route('student.reports.show', $report->report_id) }}" class="text-blue-600 hover:text-blue-900 mx-2">
                                            View
                                        </a>
                                        
                                        <!-- Remove -->
                                        <form method="POST" action="{{ route('student.reports.destroy', $report) }}" class="inline" x-on:submit.prevent="if(confirm('Are you sure?')) { $el.submit(); show = false }">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 mx-2">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr class="bg-white border-b">
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-900">
                                        You have not reported any faults
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>