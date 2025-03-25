<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports -> View Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="" action="{{ route('manager.reports') }}">
                    @csrf
                
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Issue Type -->
                        <div>
                            <x-input-label for="issue" value="{{ __('Issue Type') }}" class="text-gray-200" />
                            <x-text-input id="issue" class="block mt-1 w-full text-gray-900" type="text" name="issue" required @readonly(true) value="{{ $report->category }}"/>
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Block/Room -->
                        <div>
                            <x-input-label for="block" value="{{ __('Block/Room') }}" class="text-gray-200" />
                            <x-text-input id="block" class="block mt-1 w-full text-gray-900" type="text" name="issue" required @readonly(true) value="N/A"/>
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Comments -->
                        <div>
                            <x-input-label for="comments" value="{{ __('Description') }}" class="text-gray-200" />
                            <x-text-input id="comments" class="block mt-1 w-full text-gray-900" type="text" name="issue" required @readonly(true) value="{{ $report->description }}"/>
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Date Reported -->
                        <div>
                            <x-input-label for="dateofreport" value="{{ __('Date Reported') }}" class="text-gray-200" />
                            <x-text-input id="dateofreport" class="block mt-1 w-full text-gray-900" type="text" name="issue" required @readonly(true) value="{{ $report->created_at }}"/>
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <x-input-label for="status" value="{{ __('Status') }}" class="text-gray-200" />
                            <x-text-input id="status" class="block mt-1 w-full text-gray-900" type="text" name="issue" required @readonly(true) value="{{ $report->status }}"/>
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                    </div>
                
                    <div class="flex justify-end mt-6">
                        <x-button class="bg-blue-500 hover:bg-blue-700 text-white">
                            {{ __('Done') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>