<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome ') }} {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Stats Cards - Fixed with w-full and responsive design -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 w-full">
                        <!-- Total Reports -->
                        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm w-full">
                            <h3 class="text-lg font-medium text-gray-700">Total Reports</h3>
                            <p class="text-3xl font-bold text-gray-900">{{ $totalReports ?? 0 }}</p>
                        </div>
                        
                        <!-- Pending Reports -->
                        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm w-full">
                            <h3 class="text-lg font-medium text-gray-700">Pending Reports</h3>
                            <p class="text-3xl font-bold text-yellow-600">{{ $pendingReports ?? 0 }}</p>
                        </div>
                        
                        <!-- Resolved Faults -->
                        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm w-full">
                            <h3 class="text-lg font-medium text-gray-700">Resolved Faults</h3>
                            <p class="text-3xl font-bold text-green-600">{{ $resolvedFaults ?? 0 }}</p>
                        </div>
                    </div>

                    <h1 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Recent Fault Reports</h1>

                    <!-- Applications Table -->
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No.</th>
                                    <th scope="col" class="px-6 py-3">Issue Type</th>
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
                                    <td class="px-6 py-4 text-gray-900">{{ $report->user->department->name ?? "N/A" }}</td>
                                    <td class="px-6 py-4 text-gray-900">{{ $report->created_at->format('M d, Y H:i') ?? "N/A" }}</td>
                                    <td class="px-6 py-4 text-gray-900">
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-full 
                                            {{ $report->status === 'solved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                               'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' }}">
                                            {{ $report->status ?? "N/A" }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
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
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-900">
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