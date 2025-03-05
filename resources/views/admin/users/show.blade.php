<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Edit User</h1>

        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-4">
                <label class="block font-medium">Name:</label>
                <input type="text" name="name" value="{{ $user->name }}" required
                    class="w-full px-4 py-2 border rounded-lg" readonly>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Email:</label>
                <input type="email" name="email" value="{{ $user->email }}" required
                    class="w-full px-4 py-2 border rounded-lg" readonly>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Role</label>
                <input type="text" name="role" value="{{ $user->role }}" required
                    class="w-full px-4 py-2 border rounded-lg" readonly>
            </div>

            <!-- Hidden field to ensure "deactivation" works -->
            <input type="hidden" name="is_active" value="0">

            <!-- Activate/Deactivate Toggle -->
            <div class="mb-4">
                <label class="block font-medium">Status</label>
                <input type="text" name="is_active" value={{ $user->is_active ? 'Active' : 'Deactive' }}
                    class="w-full px-4 py-2 border rounded-lg" readonly>
            </div>
        </form>
    </div>
</x-app-layout>