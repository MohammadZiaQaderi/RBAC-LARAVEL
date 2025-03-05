<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Employee details</h1>

        <form action="{{ route('employees.show', $employee) }}" method="POST">

            <div class="mb-4 max-w-2xl">
                <label class="block font-medium">Image:</label>
                <img src="{{ asset('storage/' . $employee->image) }}" alt="Employee Image"
                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
            </div>



            <div class="mb-4">
                <label class="block font-medium">Name:</label>
                <input type="text" name="name" value="{{ $employee->name }}" required
                    class="w-full px-4 py-2 border rounded-lg" readonly>
            </div>


            <div class="mb-4">
                <label class="block font-medium">DOB:</label>
                <input type="text" value="{{ $employee->dob }}" class="w-full px-4 py-2 border rounded-lg" readonly>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Department:</label>
                <input type="text" value="{{ $employee->department }}" class="w-full px-4 py-2 border rounded-lg"
                    readonly>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Email:</label>
                <input type="email" name="email" value="{{ $employee->email }}" required
                    class="w-full px-4 py-2 border rounded-lg" readonly>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Gender:</label>
                <input type="text" value="{{ $employee->gender }}" class="w-full px-4 py-2 border rounded-lg" readonly>
            </div>


            <div class="mb-4">
                <label class="block font-medium">Address:</label>
                <input type="text" value="{{ $employee->address }}" class="w-full px-4 py-2 border rounded-lg" readonly>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Status</label>
                <input type="text" name="status" value="{{ $employee->status ? 'Active' : 'Deactive' }}" required
                    class="w-full px-4 py-2 border rounded-lg" readonly>
            </div>

            <!-- Hidden field to ensure "deactivation" works -->
            <input type="hidden" name="status" value="0">

            <!-- Activate/Deactivate Toggle -->

        </form>
    </div>
</x-app-layout>