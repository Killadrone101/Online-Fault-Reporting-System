<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Search Bar -->
                    <div class="flex justify-between mb-4 ">
                        <a href="{{ route('admin.users.create') }}" class="bg-green-500 hover:bg-green-700 text-dark font-bold py-2 px-4 rounded">
                            Add User
                        </a>
                        <input type="text" id="search" placeholder="Search users..." class="rounded-lg px-4 py-2 w-64 border border-gray-300 text-gray-900">
                    </div>

                    <!-- Applications Table -->
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Residence</th>
                                    <th scope="col" class="px-6 py-3">Role</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $user->email }}
                                    </td>
                                    @if ($user->role == 'student')
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $user->residence }}
                                        </td>
                                    @elseif ($user->role == 'assistant')
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $user->residence }}
                                        </td>
                                    @else
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            N/A
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 text-gray-900">{{ $user->role }}</td>
                                    <td class="px-6 py-4">
                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline" x-on:submit.prevent="if(confirm('Are you sure?')) { $el.submit(); show = false }">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 mx-2">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr class="bg-white border-b">
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-900">
                                        No Users Available
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($users->hasPages())
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>