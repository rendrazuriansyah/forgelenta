<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', ['departments' => $departments]);
    }

    public function create()
    {
        return view('departments.create');
    }

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

    public function edit(Department $department)
    {
        return view('departments.edit', ['department' => $department]);
    }

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
