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
</x-app-layout>