<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

/**
 * DepartmentController
 */
class DepartmentController extends Controller
{
    /**
     * Display a listing of the departments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();

        return view('departments.index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new department.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created department in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            Department::create($data);

            return redirect()->route('departments.index')->with('success', 'Department created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Error creating department: '.$e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified department.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('departments.edit', ['department' => $department]);
    }

    /**
     * Update the specified department in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            $department->update($data);

            return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Error updating department: '.$e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified department from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();

            return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Error deleting department: '.$e->getMessage(),
            ]);
        }
    }
}
