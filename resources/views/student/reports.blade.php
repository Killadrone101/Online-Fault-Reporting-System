<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 leading-tight">
                    {{ __('Fault Reports') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">View and manage all your reported faults</p>
            </div>
            <div class="flex space-x-3">
                <form method="GET" action="{{ route('student.reports') }}" class="relative" id="searchForm">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input 
                        type="text" 
                        name="search" 
                        id="search" 
                        placeholder="Search reports..." 
                        value="{{ request('search') }}"
                        class="pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200 w-64 text-gray-700"
                        x-on:input.debounce.500ms="$el.form.submit()"
                    >
                </form>
                <a 
                    href="{{ route('student.reports.create') }}" 
                    class="flex items-center space-x-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-medium py-2 px-4 rounded-full shadow-md hover:shadow-lg transition duration-200"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>File New Fault</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <!-- Reports Table -->
                    <div class="overflow-hidden rounded-lg border border-gray-100 shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="text-xs text-white uppercase bg-gradient-to-r from-red-700 to-red-800">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider rounded-tl-lg">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                        Issue Type
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                        Fault Image
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                        Department
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                        Date Reported
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider rounded-tr-lg">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($reports as $report)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                        {{ ($reports->currentPage() - 1) * $reports->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $report->category ?? "N/A" }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($report->image)
                                            <a href="{{ Storage::url($report->image) }}" target="_blank" class="block">
                                                <div class="flex-shrink-0 h-16 w-16 rounded-md overflow-hidden border border-gray-200">
                                                    <img src="{{ Storage::url($report->image) }}" 
                                                         alt="Fault Image" 
                                                         class="h-full w-full object-cover hover:opacity-80 transition-opacity">
                                                </div>
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-xs italic">No image</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $report->category ?? "N/A" }} Department</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $report->created_at->format('M d, Y H:i') ?? "N/A" }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-full 
                                            {{ $report->status === 'solved' ? 'bg-green-100 text-green-800' : 
                                               ($report->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst($report->status) ?? "N/A" }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-4">
                                            <a 
                                                href="{{ route('student.reports.show', $report->report_id) }}" 
                                                class="text-blue-600 hover:text-blue-800 transition duration-150 flex items-center"
                                                title="View Details"
                                            >
                                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                            <form 
                                                method="POST" 
                                                action="{{ route('student.reports.destroy', $report) }}" 
                                                class="inline"
                                                x-on:submit.prevent="if(confirm('Are you sure you want to delete this report?')) { $el.submit() }"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit" 
                                                    class="text-red-600 hover:text-red-800 transition duration-150 flex items-center"
                                                    title="Delete"
                                                >
                                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="text-center py-12 bg-gray-50 rounded-lg">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <h3 class="mt-2 text-lg font-medium text-gray-900">No reports found</h3>
                                            <p class="mt-1 text-sm text-gray-500">
                                                @if(request('search'))
                                                    No reports match your search criteria
                                                @else
                                                    You haven't reported any faults yet
                                                @endif
                                            </p>
                                            <div class="mt-6">
                                                <a href="{{ route('student.reports.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    File New Fault
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($reports->hasPages())
                    <div class="mt-6 flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} of {{ $reports->total() }} reports
                            @if(request('search')) (filtered) @endif
                        </div>
                        <div class="flex space-x-1">
                            {{ $reports->appends(['search' => request('search')])->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>