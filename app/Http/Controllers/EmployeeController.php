<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;

/**
 * Controller to manage employees.
 */
class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all employees with their departments and roles
        $employees = Employee::with('department', 'role')->get();

        // Return the view with the list of employees
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get all departments and roles
        $departments = Department::all();
        $roles = Role::all();
        $statusOptions = Employee::getStatusOptions();

        // Return the view with the form to create a new employee
        return view('employees.create', compact('departments', 'roles', 'statusOptions'));
    }

    /**
     * Store a newly created employee in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:active,inactive,on_leave',
            'salary' => 'required|numeric|min:0|max:99999999.99',
        ]);

        try {
            // Create a new employee
            $employee = Employee::create($data);

            // Redirect to the list of employees with a success message
            return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
        } catch (\Exception $e) {
            // Redirect back to the form with an error message
            return redirect()->back()->withErrors([
                'error' => 'Error creating employee: '.$e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified employee.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        try {
            // Load the employee with its department and role
            $employee->load('department', 'role');

            // Return the view with the employee's details
            return view('employees.show', compact('employee'));
        } catch (\Exception $e) {
            // Redirect back to the list of employees with an error message
            return redirect()->back()->withErrors([
                'error' => 'Error loading employee: '.$e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified employee.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        try {
            // Get all departments and roles
            $departments = Department::all();
            $roles = Role::all();
            $statusOptions = Employee::getStatusOptions();

            // Return the view with the form to edit the employee
            return view('employees.edit', compact('employee', 'departments', 'roles', 'statusOptions'));
        } catch (\Exception $e) {
            // Redirect back to the list of employees with an error message
            return redirect()->back()->withErrors([
                'error' => 'Error loading employee: '.$e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified employee in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        // Validate the request data
        $data = $request->validate([
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

        try {
            // Update the employee
            $employee->update($data);

            // Redirect to the list of employees with a success message
            return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
        } catch (\Exception $e) {
            // Redirect back to the form with an error message
            return redirect()->back()->withErrors([
                'error' => 'Error updating employee: '.$e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified employee from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            // Delete the employee
            $employee->delete();

            // Redirect to the list of employees with a success message
            return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
        } catch (\Exception $e) {
            // Redirect back to the list of employees with an error message
            return redirect()->back()->withErrors([
                'error' => 'Error deleting employee: '.$e->getMessage(),
            ]);
        }
    }
}

