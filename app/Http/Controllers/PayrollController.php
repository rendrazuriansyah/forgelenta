<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

/**
 * Controller to manage payrolls.
 */
class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all payrolls with their associated employees
        try {
            $payrolls = Payroll::with('employee')->get();
            return view('payrolls.index', compact('payrolls'));
        } catch (Exception $e) {
            // Redirect back with an error message if unable to retrieve payrolls
            return redirect()->back()->withErrors('Unable to retrieve payrolls.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retrieve all employees to be used in the create form
        try {
            $employees = Employee::all();
            return view('payrolls.create', compact('employees'));
        } catch (Exception $e) {
            // Redirect back with an error message if unable to retrieve employees
            return redirect()->back()->withErrors('Unable to retrieve employees.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|integer|exists:employees,id',
            'salary' => 'required|numeric|min:0',
            'bonus' => 'required|numeric|min:0',
            'deductions' => 'required|numeric|min:0',
            'pay_date' => 'required|date',
        ]);

        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Calculate the net salary
            $validatedData = $validator->validated();
            $netSalary = $validatedData['salary'] + $validatedData['bonus'] - $validatedData['deductions'];

            // Create a new payroll
            Payroll::create(array_merge($validatedData, ['net_salary' => $netSalary]));

            // Redirect to the index page with a success message
            return redirect()->route('payrolls.index')->with('success', 'Payroll created successfully.');
        } catch (Exception $e) {
            // Redirect back with an error message if unable to create the payroll
            return redirect()->back()->withErrors('An error occurred while creating the payroll.')->withInput();
        }
    }

    public function show(Payroll $payroll)
    {
        $payroll->load('employee');

        return view('payrolls.show', compact('payroll'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function edit(Payroll $payroll)
    {
        // Retrieve all employees to be used in the edit form
        try {
            $employees = Employee::all();
            return view('payrolls.edit', compact('payroll', 'employees'));
        } catch (ModelNotFoundException $e) {
            // Redirect to the index page with an error message if the payroll is not found
            return redirect()->route('payrolls.index')->withErrors('Payroll not found.');
        } catch (Exception $e) {
            // Redirect back with an error message if unable to retrieve employees
            return redirect()->back()->withErrors('Unable to retrieve employees.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payroll $payroll)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|integer|exists:employees,id',
            'salary' => 'required|numeric|min:0',
            'bonus' => 'required|numeric|min:0',
            'deductions' => 'required|numeric|min:0',
            'pay_date' => 'required|date',
        ]);

        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Calculate the net salary
            $validatedData = $validator->validated();
            $netSalary = $validatedData['salary'] + $validatedData['bonus'] - $validatedData['deductions'];

            // Update the payroll
            $payroll->update(array_merge($validatedData, ['net_salary' => $netSalary]));

            // Redirect to the index page with a success message
            return redirect()->route('payrolls.index')->with('success', 'Payroll updated successfully.');
        } catch (Exception $e) {
            // Redirect back with an error message if unable to update the payroll
            return redirect()->back()->withErrors('An error occurred while updating the payroll.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll $payroll)
    {
        try {
            // Delete the payroll
            $payroll->delete();

            // Redirect to the index page with a success message
            return redirect()->route('payrolls.index')->with('success', 'Payroll deleted successfully.');
        } catch (Exception $e) {
            // Redirect back with an error message if unable to delete the payroll
            return redirect()->back()->withErrors('An error occurred while deleting the payroll.');
        }
    }
}

