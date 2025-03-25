<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports -> File New Fault') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('student.reports.store') }}">
                    @csrf
                
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Issue Type Dropdown -->
                        <div>
                            <x-input-label for="issue_type" value="{{ __('Issue Type') }}" />
                            <select id="issue_type" name="issue_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Select Issue Type</option>
                                <option value="Electrical">Electrical</option>
                                <option value="Plumbing">Plumbing</option>
                                <option value="HVAC">HVAC</option>
                                <option value="Furniture">Furniture</option>
                                <option value="Structural">Structural</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('issue_type')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Block/Room Dropdown -->
                        <div>
                            <x-input-label for="block" value="{{ __('Block/Room') }}" />
                            <select id="block" name="block" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Select Block</option>
                                <option value="Block A">Block A</option>
                                <option value="Block B">Block B</option>
                                <option value="Block C">Block C</option>
                                <option value="Block D">Block D</option>
                                <option value="Admin Block">Admin Block</option>
                            </select>
                            @error('block')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Comments -->
                        <div class="md:col-span-2">
                            <x-input-label for="description" value="{{ __('Description') }}" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                            @error('description')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="flex justify-end mt-6">
                        <x-button class="bg-blue-500 hover:bg-blue-700 text-white">
                            {{ __('Submit Report') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>