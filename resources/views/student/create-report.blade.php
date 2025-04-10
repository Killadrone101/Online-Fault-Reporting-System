<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports -> File New Fault') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('student.reports.store') }}" enctype="multipart/form-data">
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
                                <option value="Block 471">Block 471</option>
                                <option value="Block 472">Block 472</option>
                                <option value="Block 473">Block 473</option>
                                <option value="Block 474">Block 474</option>
                                <option value="Block 475">Block 475</option>
                                <option value="Block 476">Block 476</option>
                                <option value="Block 478">Block 478</option>
                                <option value="Block 479">Block 479</option>
                                <option value="Block 480">Block 480</option>
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
                        
                        <!-- Image Upload -->
                        <div class="md:col-span-2">
                            <x-input-label for="image" value="{{ __('Upload Image (Optional)') }}" />
                            <input type="file" id="image" name="image" accept="image/*" class="block mt-1 w-full border border-gray-300 rounded-md px-3 py-2">
                            <p class="text-sm text-gray-500 mt-1">Upload a photo of the fault (JPG, PNG, GIF up to 5MB)</p>
                            @error('image')
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