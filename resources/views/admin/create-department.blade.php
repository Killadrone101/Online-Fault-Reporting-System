<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department -> Add Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="" action="{{ route('admin.departments.store') }}">
                    @csrf
                
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Department Name -->
                        <div>
                            <x-input-label for="name" value="{{ __('Department Name') }}" class="text-gray-200" />
                            <x-text-input id="name" class="block mt-1 w-full text-gray-900" type="text" name="name" required autofocus />
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Department Manager -->
                        <div>
                            <x-input-label for="manager" value="{{ __('Manager') }}" class="text-gray-700" />
                            <select name="manager" id="manager" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 text-gray-900" required>
                                @php
                                    $managers = $users->where('role', 'manager');
                                @endphp
                                
                                @if($managers->isNotEmpty())
                                    <option value="">Select a Manager</option>
                                    @foreach($managers as $manager)
                                        <option value="{{ $manager->id }}" {{ old('manager') == $manager->id ? 'selected' : '' }}>
                                            {{ $manager->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">No Managers Available</option>
                                @endif
                            </select>
                            @error('manager')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="flex justify-end mt-6">
                        <x-button class="bg-blue-500 hover:bg-blue-700 text-white">
                            {{ __('Create Department') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>