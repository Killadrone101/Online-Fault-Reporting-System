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
                
                        <!-- Role -->
                        <div>
                            <x-input-label for="role" value="{{ __('Role') }}" class="text-gray-700" />
                            <select name="role" id="role" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 text-gray-900" required onchange="toggleDepartmentField()">
                                <option value="student">Student</option>
                                <option value="assistant">RA</option>
                                <option value="manager">Department Manager</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Department (only shown for managers) -->
                        <div id="department-field" style="display: none;">
                            <x-input-label for="department" value="{{ __('Department') }}" class="text-gray-700" />
                            <select name="department" id="department" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 text-gray-900">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->department_id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department')
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
                
                <script>
                    function toggleDepartmentField() {
                        const roleSelect = document.getElementById('role');
                        const departmentField = document.getElementById('department-field');
                        
                        if (roleSelect.value === 'manager') {
                            departmentField.style.display = 'block';
                            document.getElementById('department').setAttribute('required', 'required');
                        } else {
                            departmentField.style.display = 'none';
                            document.getElementById('department').removeAttribute('required');
                        }
                    }
                    
                    // Initialize on page load
                    document.addEventListener('DOMContentLoaded', toggleDepartmentField);
                </script>
            </div>
        </div>
    </div>
</x-app-layout>