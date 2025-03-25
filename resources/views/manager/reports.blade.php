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
            
                        <input type="text" id="search" placeholder="Search reports..." class="rounded-lg px-4 py-2 w-64 border border-gray-300 text-gray-900">
                    </div>

                    <!-- Applications Table -->
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No.</th>
                                    <th scope="col" class="px-6 py-3">Issue Type</th>
                                    <th scope="col" class="px-6 py-3">Block/Room</th>
                                    <th scope="col" class="px-6 py-3">Comments</th>
                                    <th scope="col" class="px-6 py-3">Date Reported</th>
                                    <th scope="col" class="px-6 py-3">Assigned To</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reports as $report)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $report->category }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{-- Block --}}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">{{ $report->description }}</td>
                                    <td class="px-6 py-4 text-gray-900">{{ $report->created_at }}</td>
                                    <td class="px-6 py-4 text-gray-900"> {{-- Assigned To --}} </td>
                                    <td class="px-6 py-4 text-gray-900">{{ $report->status }}</td>
                                    <td class="px-6 py-4">
                                        <!-- View Button -->
                                        <a href="{{ route('admin.reports.show', $report->id) }}" 
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            View
                                         </a>
                                    </td>
                                </tr>
                                @empty
                                <tr class="bg-white border-b">
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-900">
                                        No reports Available
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    {{-- @if($reports->hasPages())
                    <div class="mt-4">
                        {{ $reports->links() }}
                    </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>