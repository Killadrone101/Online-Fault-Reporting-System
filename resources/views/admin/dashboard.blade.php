<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }} - {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Users Card -->
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                    <div class="p-6 bg-indigo-600 text-white">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-500 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm">Total Users</p>
                                <p class="text-2xl font-bold">{{ $totalUsers }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fault Reports Card -->
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                    <div class="p-6 bg-blue-600 text-white">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm">Total Reports</p>
                                <p class="text-2xl font-bold">{{ $totalReports }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Departments Card -->
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                    <div class="p-6 bg-green-600 text-white">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-500 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm">Departments</p>
                                <p class="text-2xl font-bold">{{ $totalDepartments }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feedback Card -->
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                    <div class="p-6 bg-purple-600 text-white">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-500 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm">Feedback Received</p>
                                <p class="text-2xl font-bold">{{ $totalFeedback }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Fault Reports -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Fault Reports</h3>
                        <div class="space-y-4">
                            @forelse($recentReports as $report)
                            <div class="border-b pb-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium">{{ $report->category }}</p>
                                        <p class="text-sm text-gray-500">{{ $report->description }}</p>
                                        <p class="text-xs text-gray-400 mt-1">
                                            Reported by {{ $report->user->name }} ({{ $report->user->residence }})
                                        </p>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $report->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($report->status === 'resolved' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                                        {{ ucfirst($report->status) }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <p class="text-gray-500">No recent fault reports</p>
                            @endforelse
                        </div>
                        <a href="#" class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            View all reports
                            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Recent Feedback -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Feedback</h3>
                        <div class="space-y-4">
                            @forelse($recentFeedback as $feedback)
                            <div class="border-b pb-4">
                                <div class="flex justify-between">
                                    <div>
                                        <p class="font-medium">Report #{{ $feedback->report_id }}</p>
                                        <p class="text-sm text-gray-500">{{ Str::limit($feedback->comments, 100) }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $feedback->student_validation ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $feedback->student_validation ? 'Validated' : 'Pending' }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <p class="text-gray-500">No recent feedback</p>
                            @endforelse
                        </div>
                        <a href="#" class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            View all feedback
                            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Department Overview -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Department Overview</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Head</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff Count</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Related Reports</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($departments as $department)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">{{ $department->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($department->staff)
                                        <div class="text-sm text-gray-900">{{ $department->staff->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $department->staff->email }}</div>
                                        @else
                                        <span class="text-sm text-gray-500">Not assigned</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $department->staff_count }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $department->reports_count }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No departments found</td>
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