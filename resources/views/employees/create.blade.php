<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Create User</h1>

        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf


            <!-- Image Field -->
            <div>
                <label for="image" class="block font-medium text-gray-700">Image</label>
                <input type="file" id="image" name="image" required
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>


            <!-- Name Field -->
            <div>
                <label for="name" class="block font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" required
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>


            <!-- Date of Birth Field -->
            <div>
                <label for="dob" class="block font-medium text-gray-700">DOB</label>
                <input type="date" id="dob" name="dob" required
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>


            <!-- Department Field -->
            <div>
                <label for="department" class="block font-medium text-gray-700">Department</label>
                <input type="text" id="department" name="department" required
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            <!-- Gender Selection -->
            <div>
                <label for="gender" class="block font-medium text-gray-700">Gender</label>
                <select id="gender" name="gender" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <!-- Department Field -->
            <div>
                <label for="address" class="block font-medium text-gray-700">Address</label>
                <input type="text" id="address" name="address" required
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            <!-- Buttons -->
            <div class="flex justify-end">
                <a href="{{ route('employees.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-gray-600">Cancel</a>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Create Employee
                </button>
            </div>
        </form>
    </div>
</x-app-layout>