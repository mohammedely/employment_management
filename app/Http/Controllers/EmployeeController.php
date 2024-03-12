<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use PHPUnit\TextUI\CliArguments\Builder;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('perPage', 5);
            $sortField = $request->input('sortField', 'name');
            $sortDirection = $request->input('sortDirection', 'asc');

            $employees = Employee::orderBy($sortField, $sortDirection)
                ->paginate($perPage);

            $searchTerm = $request->input('search');
            return view('employees.index', compact('employees', 'sortField', 'sortDirection', 'searchTerm'));
        } catch (QueryException $e) {
            Log::error('Error: ' . $e->getMessage());
            return redirect()->route('employees.index')->with('error', 'Unable to retrieve employees.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $departments = Department::all();
            return view('employees.create', compact('departments'));
        } catch (QueryException $e) {
            Log::error('Error creating employee: ' . $e->getMessage());
            return redirect()->route('employees.index')->with('error', 'Unable to create employee.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:employees,email',
                'department_id' => 'exists:departments,id'
            ]);

            Employee::create($validatedData);

            return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
        } catch (QueryException $e) {
            Log::error('Error storing employee: ' . $e->getMessage());
            return redirect()->route('employees.index')->with('error', 'Unable to store employee.');
        }
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
        try {
            $departments = Department::all();
            return view('employees.edit', compact('employee', 'departments'));
        } catch (QueryException $e) {
            Log::error('Error editing employee: ' . $e->getMessage());
            return redirect()->route('employees.edit')->with('error', 'Unable to edit employee.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:employees,email,' . $employee->id,
                'department_id' => 'required|numeric|exists:departments,id',
            ]);

            $employee->update($validatedData);

            return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
        } catch (QueryException $e) {
            Log::error('Error updating employee: ' . $e->getMessage());
            return redirect()->route('employees.index')->with('error', 'Unable to update employee.');
        }
    }

    public function statistics()
    {
        $departments = Department::withCount('employees')->paginate(5);

        $totalEmployees = Employee::count();

        return view('employees.statistics', compact('departments', 'totalEmployees'));
    }

    public function search(Request $request)
    {
        dd('searchTerm');

        try {
            $validatedData = $request->validate([
                'search' => 'nullable|string',
            ]);

            $sortField = $request->input('sort', 'name');
            $sortDirection = $request->input('order', 'asc');
            $searchTerm = $request->input('search');

            $employees = Employee::searchEmployees($searchTerm, $sortField, $sortDirection);

            return view('employees.index', compact('employees', 'sortField', 'sortDirection', 'searchTerm'));
        } catch (QueryException $e) {
            Log::error('Error: ' . $e->getMessage());
            return redirect()->route('employees.index')->with('error', 'Unable to find employees.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
        } catch (QueryException $e) {
            Log::error('Error deleting employee: ' . $e->getMessage());
            return redirect()->route('employees.index')->with('error', 'Unable to delete employee.');
        }
    }
}
