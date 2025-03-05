<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Create User</h1>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Name Field -->
            <div>
                <label for="name" class="block font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" required
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            <!-- Role Selection -->
            <div>
                <label for="role" class="block font-medium text-gray-700">Role</label>
                <select id="role" name="role" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end">
                <a href="{{ route('users.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-gray-600">Cancel</a>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Create User
                </button>
            </div>
        </form>
    </div>
</x-app-layout>