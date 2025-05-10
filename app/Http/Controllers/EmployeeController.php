<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('role', 'department')->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();
        $statusOptions = Employee::getStatusOptions();

        return view('employees.create', compact('departments', 'roles', 'statusOptions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'status' => 'in:active,inactive,on_leave',
            'salary' => 'required|numeric|min:0',
        ]);

        $employee = Employee::create($validatedData);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        $employee->load('department', 'role');

        return view('employees.show', compact('employee'));
    }

    public function edit(Request $request, Employee $employee)
    {
        $departments = Department::all();
        $roles = Role::all();
        $statusOptions = Employee::getStatusOptions();

        return view('employees.edit', compact('employee', 'departments', 'roles', 'statusOptions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,'.$employee->id.'|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'birth_date' => 'required|date|before_or_equal:hire_date',
            'hire_date' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:active,inactive,on_leave',
            'salary' => 'required|numeric|min:0|max:99999999.99',
        ]);

        $employee->update($validatedData);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Request $request, Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
