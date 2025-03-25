<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department -> View Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="" action="{{ route('admin.department') }}">
                    @csrf
                
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Department Name -->
                        <div>
                            <x-input-label for="name" value="{{ __('Department Name') }}" class="text-gray-200" />
                            <x-text-input id="name" class="block mt-1 w-full text-gray-900" type="text" name="name" required @readonly(true) value="{{ $department->name }}"/>
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Department Manager -->
                        <div>
                            <x-input-label for="manager" value="{{ __('Department Manager') }}" class="text-gray-700" />
                            <x-text-input id="manager" class="block mt-1 w-full text-gray-900" type="text" name="manager" required @readonly(true) value="{{ $department->user->name }}"/>
                            @error('manager')
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