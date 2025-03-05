<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Edit Employee</h1>

        <form action="{{ route('employees.update', $employee) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-4">
                <label class="block font-medium">Name:</label>
                <input type="text" name="name" value="{{ $employee->name }}" required
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Email:</label>
                <input type="email" name="email" value="{{ $employee->email }}" required
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <!-- Hidden field to ensure "deactivation" works -->
            <input type="hidden" name="is_active" value="0">

            <div class="flex space-x-3">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Update
                </button>
                <a href="{{ route('employees.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>