<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold">Manage Users</h1>
            <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Create User
            </a>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-4 flex space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..."
                class="px-4 py-2 border rounded-lg w-full">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Search
            </button>
        </form>

        <!-- Total Users Count -->
        <p class="mb-4 text-gray-700">
            Total Users: <strong>{{ $users->total() }}</strong> |
            Admins: <strong>{{ $admins }}</strong> |
            Users: <strong>{{ $regularUsers }}</strong>
        </p>

        <!-- Users Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border px-4 py-2 text-left">Name</th>
                        <th class="border px-4 py-2 text-left">Email</th>
                        <th class="border px-4 py-2 text-left">Role</th>
                        <th class="border px-4 py-2 text-center">Status</th>
                        <th class="border px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                            <td class="border px-4 py-2 text-center">
                                @if($user->is_active)
                                    <span class="text-green-600 font-semibold">Active</span>
                                @else
                                    <span class="text-red-600 font-semibold">Inactive</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2 flex justify-center space-x-2">
                                <!-- Activate/Deactivate Button -->
                                <form action="{{ route('users.toggleStatus', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1 rounded-lg text-white 
                                                            {{ $user->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
                                        {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>

                                <!-- Edit Button -->
                                <a href="{{ route('users.edit', $user) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">
                                    Edit
                                </a>
                                <!-- Edit Button -->
                                <a href="{{ route('users.show', $user) }}"
                                    class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">
                                    View
                                </a>
                                <!-- Delete Button -->
                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>