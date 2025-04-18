<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department -> Add Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.departments.store') }}">
                    @csrf
                
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Department Name -->
                        <div>
                            <x-input-label for="name" value="{{ __('Department Name') }}" class="text-gray-700" />
                            <x-text-input id="name" class="block mt-1 w-full text-gray-900" type="text" name="name" value="{{ old('name') }}" required autofocus />
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Department Manager -->
                        <div>
                            <x-input-label for="manager" value="{{ __('Department Manager') }}" class="text-gray-700" />
                            <select name="manager" id="manager" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 text-gray-900" required>
                                @php
                                    $managers = $users->where('role', 'manager');
                                @endphp
                                
                                @if($managers->isNotEmpty())
                                    <option value="">Select a Manager</option>
                                    @foreach($managers as $manager)
                                        <option value="{{ $manager->id }}" {{ old('manager') == $manager->id ? 'selected' : '' }}>
                                            {{ $manager->name }} ({{ $manager->email }})
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">No Managers Available</option>
                                @endif
                            </select>
                            @error('manager')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                            @if($managers->isEmpty())
                                <p class="text-amber-600 text-sm mt-2">
                                    No managers available. <a href="{{ route('admin.users.create') }}" class="underline">Create a manager</a> first.
                                </p>
                            @endif
                        </div>

                        <!-- Department Category Type -->
                        <div>
                            <x-input-label for="category_type" value="{{ __('Fault Category Type') }}" class="text-gray-700" />
                            <select name="category_type" id="category_type" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 text-gray-900" required>
                                <option value="">Select Category Type</option>
                                <option value="plumbing" {{ old('category_type') == 'plumbing' ? 'selected' : '' }}>Plumbing</option>
                                <option value="electrical" {{ old('category_type') == 'electrical' ? 'selected' : '' }}>Electrical</option>
                                <option value="carpentry" {{ old('category_type') == 'carpentry' ? 'selected' : '' }}>Carpentry</option>
                                <option value="security" {{ old('category_type') == 'security' ? 'selected' : '' }}>Security</option>
                                <option value="cleaning" {{ old('category_type') == 'cleaning' ? 'selected' : '' }}>Cleaning/Sanitation</option>
                                <option value="grounds" {{ old('category_type') == 'grounds' ? 'selected' : '' }}>Grounds & Landscaping</option>
                                <option value="appliance" {{ old('category_type') == 'appliance' ? 'selected' : '' }}>Appliance Repair</option>
                                <option value="network" {{ old('category_type') == 'network' ? 'selected' : '' }}>Internet/Network</option>
                                <option value="other" {{ old('category_type') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('category_type')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" value="{{ __('Department Description') }}" class="text-gray-700" />
                            <textarea id="description" name="description" rows="3" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 text-gray-900">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="flex justify-end mt-6">
                        <a href="{{ route('admin.departments') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-3">
                            {{ __('Cancel') }}
                        </a>
                        <x-button class="bg-blue-500 hover:bg-blue-700 text-white">
                            {{ __('Create Department') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>