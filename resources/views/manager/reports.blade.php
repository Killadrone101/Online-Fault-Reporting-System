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
                    <div class="flex justify-between mb-4">
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
                                    <th scope="col" class="px-6 py-3">Block/Room</th>
                                    <th scope="col" class="px-6 py-3">Comments</th>
                                    <th scope="col" class="px-6 py-3">Date Reported</th>
                                    {{-- <th scope="col" class="px-6 py-3">Assigned To</th> --}}
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
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $report->user->residence ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">{{ Str::limit($report->description, 50) }}</td>
                                    <td class="px-6 py-4 text-gray-900">{{ $report->created_at->format('M d, Y') }}</td>
                                    {{-- <td class="px-6 py-4 text-gray-900">N/A</td> --}}
                                    <td class="px-6 py-4 text-gray-900">
                                        <form method="POST" action="{{ route('manager.reports.update', $report) }}" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <div class="flex items-center space-x-2">
                                                <span class="px-2.5 py-1 text-xs font-medium rounded-full 
                                                    {{ $report->status === 'solved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ ucfirst($report->status) }}
                                                    @if($report->status === 'solved' && $report->solved_at)
                                                        <span class="text-xs">({{ $report->solved_at->diffForHumans() }})</span>
                                                    @endif
                                                </span>
                                                <select name="status" onchange="this.form.submit()" 
                                                    class="text-xs rounded-full px-2 py-1 border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                                    <option value="pending" {{ $report->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="solved" {{ $report->status === 'solved' ? 'selected' : '' }}>Solved</option>
                                                </select>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('manager.reports.show', $report) }}" 
                                            class="font-medium text-blue-600 hover:underline mr-3">
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr class="bg-white border-b">
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-900">
                                        No reports available
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($reports->hasPages())
                    <div class="mt-4">
                        {{ $reports->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>