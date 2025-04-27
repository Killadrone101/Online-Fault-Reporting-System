<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ __('Student Dashboard') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Welcome back, {{ Auth::user()->name }}. Here's your report summary.
                </p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                        <circle cx="4" cy="4" r="3" />
                    </svg>
                    Active
                </span>
                <span class="text-sm text-gray-500">
                    {{ now()->format('l, F j, Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Reports Card -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 text-white">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-white bg-opacity-20 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Total Reports</p>
                                <p class="text-2xl font-bold">{{ $totalReports ?? 0 }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="h-1 bg-white bg-opacity-20 rounded-full">
                                <div class="h-1 bg-white rounded-full" style="width: {{ $totalReports > 0 ? min(($totalReports / ($totalReports + 10)) * 100, 100) : 0 }}%"></div>
                            </div>
                            <p class="text-xs mt-2 text-white text-opacity-80">{{ $pendingReports ?? 0 }} pending resolution</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Reports Card -->
                <div class="bg-gradient-to-br from-yellow-600 to-yellow-700 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 text-white">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-white bg-opacity-20 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Pending Reports</p>
                                <p class="text-2xl font-bold">{{ $pendingReports ?? 0 }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="h-1 bg-white bg-opacity-20 rounded-full">
                                <div class="h-1 bg-white rounded-full" style="width: {{ $totalReports > 0 ? ($pendingReports / $totalReports) * 100 : 0 }}%"></div>
                            </div>
                            <p class="text-xs mt-2 text-white text-opacity-80">{{ $totalReports > 0 ? round(($pendingReports / $totalReports) * 100) : 0 }}% of your reports</p>
                        </div>
                    </div>
                </div>

                <!-- Resolved Faults Card -->
                <div class="bg-gradient-to-br from-green-600 to-green-700 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 text-white">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-white bg-opacity-20 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Resolved Faults</p>
                                <p class="text-2xl font-bold">{{ $resolvedFaults ?? 0 }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="h-1 bg-white bg-opacity-20 rounded-full">
                                <div class="h-1 bg-white rounded-full" style="width: {{ $totalReports > 0 ? ($resolvedFaults / $totalReports) * 100 : 0 }}%"></div>
                            </div>
                            <p class="text-xs mt-2 text-white text-opacity-80">{{ $totalReports > 0 ? round(($resolvedFaults / $totalReports) * 100) : 0 }}% resolution rate</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Reports Section -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Your Recent Fault Reports
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Issue Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Reported</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($reports as $report)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $report->category ?? "N/A" }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($report->description, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($report->image)
                                        <a href="{{ Storage::url($report->image) }}" target="_blank" class="group">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-md overflow-hidden border border-gray-200">
                                                <img src="{{ Storage::url($report->image) }}" 
                                                     alt="Fault Image" 
                                                     class="h-full w-full object-cover group-hover:opacity-75 transition-opacity">
                                            </div>
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs italic">No image</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $report->created_at->format('M d, Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full 
                                        {{ $report->status === 'solved' ? 'bg-green-100 text-green-800' : 
                                           'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($report->status) }}
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

                                        @if($report->status === 'solved')
                                            <button 
                                                data-feedback-button 
                                                data-report-id="{{ $report->report_id }}" 
                                                class="text-purple-600 hover:text-purple-800 transition duration-150 flex items-center"
                                                title="Provide Feedback"
                                            >
                                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                                </svg>
                                                Feedback
                                            </button>
                                        @endif

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
                                <td colspan="6" class="px-6 py-4 text-center">
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500">You haven't reported any faults yet</p>
                                        <a href="{{ route('student.reports.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Report a Fault
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($reports->count() > 0)
                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    <a href="{{ route('student.reports') }}" class="w-full flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 transition duration-150">
                        View all your reports
                        <svg class="ml-2 -mr-0.5 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                @endif
            </div>

            <!-- Quick Actions Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Report New Fault -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Report a New Fault
                        </h3>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-gray-500 mb-4">Found something that needs fixing? Report it quickly and easily.</p>
                        <a href="{{ route('student.reports.create') }}" class="w-full flex justify-center items-center px-4 py-3 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                            Create New Report
                            <svg class="ml-2 -mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Help & Support -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Need Help?
                        </h3>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-gray-500 mb-4">Having issues with the reporting system or need assistance?</p>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="#" class="flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150">
                                <svg class="mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                Call Support
                            </a>
                            <a href="#" class="flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150">
                                <svg class="mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Email Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Feedback Modal -->
     <div id="feedbackModal" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button type="button" data-close-modal class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-purple-100">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Provide Feedback
                        </h3>
                        <div class="mt-2">
                            <form id="feedbackForm" method="POST" action="{{ route('student.feedbacks.store') }}">
                                @csrf
                                <input type="hidden" name="report_id">
                                
                                <div class="mt-4">
                                    <label for="comments" class="block text-sm font-medium text-gray-700 text-left">Your Feedback</label>
                                    <textarea id="comments" name="comments" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm" required></textarea>
                                </div>
                                
                                <div class="mt-4 flex items-center">
                                    <input id="student_validation" name="student_validation" type="checkbox" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="student_validation" class="ml-2 block text-sm text-gray-700">
                                        Confirm the issue has been resolved to your satisfaction
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                    <button type="submit" form="feedbackForm" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:col-start-2 sm:text-sm">
                        Submit Feedback
                    </button>
                    <button type="button" data-close-modal class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const feedbackModal = document.querySelector('#feedbackModal');
            const feedbackForm = document.querySelector('#feedbackForm');
            const closeModalButtons = document.querySelectorAll('[data-close-modal]');
            const feedbackButtons = document.querySelectorAll('[data-feedback-button]');

            let currentReportId = null;

            // Open modal
            feedbackButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    currentReportId = button.dataset.reportId;
                    feedbackForm.querySelector('input[name="report_id"]').value = currentReportId;
                    feedbackModal.classList.remove('hidden');
                });
            });

            // Close modal
            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    feedbackModal.classList.add('hidden');
                    currentReportId = null;
                });
            });

            // Close modal on background click
            feedbackModal.addEventListener('click', (event) => {
                if (event.target === feedbackModal) {
                    feedbackModal.classList.add('hidden');
                    currentReportId = null;
                };
            });
        });
    </script>
</x-app-layout>