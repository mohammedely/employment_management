<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('perPage', 5);
            $sortField = $request->input('sortField', 'name', 'description');
            $sortOrder = $request->input('sortOrder', 'asc');

            $departments = Department::orderBy($sortField, $sortOrder)
                ->paginate($perPage);

            return view('departments.index', compact('departments'));
        } catch (QueryException $e) {
            Log::error('Error retreiving departments: ' . $e->getMessage());
            return redirect()->route('departments.index')->with('error', 'Unable to retreive department.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'description' => 'max:255'
            ]);

            Department::create($validatedData);

            return redirect()->route('departments.index')->with('success', 'Department added successfully!');
        } catch (QueryException $e) {
            Log::error('Error storing departments: ' . $e->getMessage());
            return redirect()->route('departments.index')->with('error', 'Unable to store department.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        try {
            $employees = $department->employees;

            return view('departments.show', compact('department', 'employees'));
        } catch (QueryException $e) {
            Log::error('Error showing departments: ' . $e->getMessage());
            return redirect()->route('departments.index')->with('error', 'Unable to show department.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        try {
            return view('departments.edit', compact('department'));
        } catch (QueryException $e) {
            Log::error('Error editing departments: ' . $e->getMessage());
            return redirect()->route('departments.index')->with('error', 'Unable to edit department.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'description' => 'max:255',
            ]);

            $department->update($validatedData);

            return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
        } catch (QueryException $e) {
            Log::error('Error updating departments: ' . $e->getMessage());
            return redirect()->route('departments.index')->with('error', 'Unable to update department.');
        }
    }

    // public function emptyEmployees(Department $department)
    // {
    //     $department->emptyEmployees();

    //     return redirect()->route('departments.index')->with('success', 'Employees emptied from the department successfully.');
    // }

    // public function emptyEmployeesFromDepartment(Department $department)
    // {
    //     $department->emptyEmployees();
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            if ($department->employees()->count() === 0) {
                $department->delete();
                return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
            } else {
                return redirect()->route('departments.index')->with('error', 'Cannot delete department with employees.');
            }
        } catch (QueryException $e) {
            Log::error('Error deleting department and associated employees: ' . $e->getMessage());

            return redirect()->route('departments.index')->with('error', 'Error deleting department and associated employees.');
        }
    }
}
