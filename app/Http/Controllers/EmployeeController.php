<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminIndex(Request $request)
    {
        $search = $request->input('search');

        $employees = Employee::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })
            ->paginate(10);

        return view('employees.index', [
            'employees' => $employees
        ]);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Employee::query();

        // Ensure users can only see their own employees (except Admins)
        if (!auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        // Fix search functionality to work with user_id filtering
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });

            // Ensure the user ID condition is still applied
            if (!auth()->user()->isAdmin()) {
                $query->where('user_id', auth()->id());
            }
        }

        // Fetch employees
        $employees = $query->paginate(10);

        // Get total employee count for the logged-in user
        $totalEmployees = $query->count();

        // Get employee count categorized by department
        $employeesByDepartment = Employee::where('user_id', auth()->id())
            ->selectRaw('department, COUNT(*) as count')
            ->groupBy('department')
            ->pluck('count', 'department');

        return view('employees.index', compact('employees', 'totalEmployees', 'employeesByDepartment'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure file upload
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'department' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email', // Ensure unique email for employees
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string|max:255',
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('employees', 'public');

        Employee::create([
            'user_id' => auth()->id(),
            'image' => $imagePath, // Save the image path
            'name' => $request->name,
            'dob' => $request->dob,
            'department' => $request->department,
            'email' => $request->email,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        if (!auth()->user()->isAdmin() && $employee->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        if (!auth()->user()->isAdmin() && $employee->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $employee->id,
        ]);

        // Update user details
        $employee->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if ($employee->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($employee->image) {
            Storage::disk('public')->delete($employee->image);
        }
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }


    public function import(Request $request)
    {
        // Validate file
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $file = $request->file('csv_file');
        $filePath = $file->getRealPath();
        $fileData = array_map('str_getcsv', file($filePath));

        // Check if CSV has at least headers and one row
        if (count($fileData) < 2) {
            return back()->with('error', 'The CSV file is empty or invalid.');
        }

        // Extract headers
        $headers = array_map('strtolower', $fileData[0]);

        $requiredHeaders = ['name', 'dob', 'email', 'department', 'address'];
        foreach ($requiredHeaders as $required) {
            if (!in_array($required, $headers)) {
                return back()->with('error', "Missing required column: $required");
            }
        }

        array_shift($fileData); // Remove headers row

        // Process CSV rows
        $errors = [];
        foreach ($fileData as $row) {
            $row = array_combine($headers, array_map('trim', $row));

            $rowValidator = Validator::make($row, [
                'name' => 'required|string|max:255',
                'dob' => 'required|date',
                'email' => 'required|email|unique:employees,email',
                'department' => 'required|string|max:255',
                'address' => 'required|string|max:255',
            ]);

            if ($rowValidator->fails()) {
                $errors[] = "Error in row {$row['name']}: " . implode(', ', $rowValidator->errors()->all());
                continue; // Skip invalid row
            }

            Employee::create([
                'name' => $row['name'],
                'dob' => $row['dob'],
                'email' => $row['email'],
                'department' => $row['department'],
                'address' => $row['address'],
                'user_id' => auth()->id(),
            ]);
        }

        if (!empty($errors)) {
            return back()->with('error', implode('<br>', $errors));
        }

        return back()->with('success', 'Employees imported successfully!');

    }
}
