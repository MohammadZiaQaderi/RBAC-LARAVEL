<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">

        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded-md mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- CSV Upload Form -->
        <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="csv_file">Upload CSV File:</label>
            <input type="file" name="csv_file" accept=".csv" required>
            <button type="submit">Import</button>
        </form>



        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold">Manage Employees</h1>
            <a href="{{ route('employees.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Create Employee
            </a>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('employees.index') }}" class="mb-4 flex space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..."
                class="px-4 py-2 border rounded-lg w-full">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Search
            </button>
        </form>

        <div class="mb-4 p-4 bg-gray-100 rounded-lg">
            <h2 class="text-lg font-semibold">Employee Statistics</h2>
            <p>Total Employees: <strong>{{ $totalEmployees }}</strong></p>

            <h3 class="mt-2 font-medium">Employees by Department:</h3>
            <ul>
                @foreach ($employeesByDepartment as $department => $count)
                    <li>{{ $department }}: <strong>{{ $count }}</strong></li>
                @endforeach
            </ul>
        </div>

        <!-- employees Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border px-4 py-2 text-left">Image</th>
                        <th class="border px-4 py-2 text-left">Name</th>
                        <th class="border px-4 py-2 text-left">Email</th>
                        <th class="border px-4 py-2 text-left">Address</th>
                        <th class="border px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="border px-4 py-2">
                                <img src="{{ asset('storage/' . $employee->image) }}" alt="employee image"
                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                            </td>
                            <td class="border px-4 py-2">{{ $employee->name }}</td>
                            <td class="border px-4 py-2">{{ $employee->email }}</td>
                            <td class="border px-4 py-2">{{ $employee->address }}</td>

                            <td class="border px-4 py-2 flex justify-center space-x-2">

                                <!-- Edit Button -->
                                <a href="{{ route('employees.show', $employee) }}"
                                    class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">
                                    View
                                </a>

                                <!-- Edit Button -->
                                <a href="{{ route('employees.edit', $employee) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">
                                    Edit
                                </a>
                                <!-- Delete Button -->
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this employee?')">
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
                                No employees found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $employees->links() }}
        </div>
    </div>
</x-app-layout>