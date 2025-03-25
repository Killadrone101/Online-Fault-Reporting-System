<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" value="{{ __('Name') }}" class="text-gray-200" />
                            <x-text-input id="name" class="block mt-1 w-full text-gray-900" type="text" name="name" required autofocus />
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Email -->
                        <div>
                            <x-input-label for="email" value="{{ __('Email') }}" class="text-gray-700" />
                            <x-text-input id="email" class="block mt-1 w-full text-gray-900" type="email" name="email" required />
                            @error('email')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Password -->
                        <div>
                            <x-input-label for="password" value="{{ __('Password') }}" class="text-gray-700" />
                            <x-text-input id="password" class="block mt-1 w-full text-gray-900" type="password" name="password" required />
                            @error('password')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-gray-700" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full text-gray-900" type="password" name="password_confirmation" required />
                        </div>
                
                        <!-- Role -->
                        <div>
                            <x-input-label for="role" value="{{ __('Role') }}" class="text-gray-700" />
                            <select name="role" id="role" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 text-gray-900" required>
                                <option value="student">Student</option>
                                <option value="manager">Department Manager</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="flex justify-end mt-6">
                        <x-button class="bg-blue-500 hover:bg-blue-700 text-white">
                            {{ __('Create User') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>