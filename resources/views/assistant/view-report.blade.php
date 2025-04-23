<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Report Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Report Header with Status Badge -->
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-lg font-medium">{{ $report->category }}</h3>
                            <p class="text-gray-600 mt-2">{{ $report->description }}</p>
                        </div>
                        <span class="px-3 py-1 text-sm rounded-full 
                            {{ $report->status === 'solved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($report->status) }}
                            @if($report->status === 'solved' && $report->solved_at)
                                <span class="text-xs">({{ $report->solved_at->diffForHumans() }})</span>
                            @endif
                        </span>
                    </div>

                    <!-- Report Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500">Reported By</p>
                            <p class="font-medium">{{ $report->user->name }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500">Block/Room</p>
                            <p class="font-medium">{{ $report->user->residence ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500">Date Reported</p>
                            <p class="font-medium">{{ $report->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500">Validation Status</p>
                            <p class="font-medium">
                                @if($report->validated)
                                    <span class="text-green-600">Validated</span>
                                @else
                                    <span class="text-yellow-600">Pending Validation</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Validation Section -->
                    @if(!$report->validated)
                    <div class="bg-blue-50 p-4 rounded-lg mb-6">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Validate Report</h4>
                        <form method="POST" action="{{ route('assistant.reports.validate', $report->report_id) }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Validate Report
                            </button>
                        </form>
                    </div>
                    @endif

                    <!-- Solution Details (if solved) -->
                    @if($report->status === 'solved' && $report->solved_at)
                    <div class="mt-6 pt-6 border-t">
                        <h4 class="text-md font-medium text-gray-900 mb-2">Resolution Details</h4>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Date Solved</p>
                                    <p class="font-medium">{{ $report->solved_at->format('M d, Y h:i A') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Time to Resolution</p>
                                    <p class="font-medium">{{ $report->created_at->diffForHumans($report->solved_at, true) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Attachments (if any) -->
                    @if($report->image)
                    <div class="mt-6 pt-6 border-t">
                        <h4 class="text-md font-medium text-gray-900 mb-2">Attachments</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <img src="{{ asset('storage/' . $report->image) }}" alt="Report Image" class="max-w-full h-auto rounded-md">
                        </div>
                    </div>
                    @endif

                    <!-- Back Button -->
                    <div class="mt-6">
                        <a href="{{ route('assistant.reports') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to all reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>