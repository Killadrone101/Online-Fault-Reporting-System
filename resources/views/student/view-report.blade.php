<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Fault Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Back Button -->
                    <div class="mb-6">
                        <a href="{{ route('student.reports') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Reports
                        </a>
                    </div>

                    <!-- Report Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Report #{{ $report->report_id }}</h3>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full 
                            {{ $report->status === 'solved' ? 'bg-green-100 text-green-800' : 
                               'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($report->status) }}
                        </span>
                    </div>

                    <!-- Report Details -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-medium text-gray-500 mb-2">Issue Type</h4>
                            <p>{{ $report->category }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-medium text-gray-500 mb-2">Department</h4>
                            <p>{{ $report->category }} Department</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-medium text-gray-500 mb-2">Date Reported</h4>
                            <p>{{ $report->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-500 mb-2">Description</h4>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p>{{ $report->description }}</p>
                        </div>
                    </div>

                    <!-- Image -->
                    @if($report->image)
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-500 mb-2">Image</h4>
                        <div class="mt-2">
                            <a href="{{ Storage::url($report->image) }}" target="_blank">
                                <img src="{{ Storage::url($report->image) }}" 
                                     alt="Fault Image" 
                                     class="max-w-md rounded-lg border border-gray-200 shadow-md hover:opacity-90 transition-opacity">
                            </a>
                            <p class="text-sm text-gray-500 mt-1">Click image to view full size</p>
                        </div>
                    </div>
                    @endif

                    <!-- Feedback Section -->
                    @if($report->status === 'solved')
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-500 mb-2">Your Feedback</h4>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($report->feedback)
                                <div class="mb-4">
                                    <p class="font-medium">Your Comments:</p>
                                    <p class="mt-1">{{ $report->feedback->comments }}</p>
                                </div>
                                <div class="flex items-center">
                                    <span class="font-medium mr-2">Resolution Confirmed:</span>
                                    @if($report->feedback->student_validation)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Yes
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            No
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Submitted on {{ $report->feedback->created_at->format('M d, Y h:i A') }}</p>
                            @else
                                <p class="text-gray-500 mb-4">You haven't provided feedback for this resolved report yet.</p>
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
                        </div>
                    </div>
                    @endif

                    <!-- Progress Timeline (if needed) -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-500 mb-2">Status Updates</h4>
                        <div class="relative pl-8 border-l-2 border-gray-200 ml-2 py-2">
                            <div class="mb-6 relative">
                                <div class="absolute -left-10 mt-1.5 h-4 w-4 rounded-full bg-blue-500"></div>
                                <p class="font-medium">Reported</p>
                                <p class="text-sm text-gray-500">{{ $report->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                            
                            @if($report->status === 'solved')
                            <div class="relative">
                                <div class="absolute -left-10 mt-1.5 h-4 w-4 rounded-full bg-green-500"></div>
                                <p class="font-medium">Resolved</p>
                                <p class="text-sm text-gray-500">{{ $report->updated_at->format('M d, Y h:i A') }}</p>
                            </div>
                            @endif
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
                                    <input id="student_validation" name="student_validation" type="checkbox" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" required>
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