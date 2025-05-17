<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * Controller for managing leave requests.
 */
class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the leave requests.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('role') == 'HR Manager') {
            // Retrieve all leave requests
            $leave_requests = LeaveRequest::all();
        } else {
            $leave_requests = LeaveRequest::with('employee')->where('employee_id', session('employee_id'))->get();
        }

        // Check if retrieval was successful
        if ($leave_requests === null) {
            return redirect()->back()->with('error', 'Failed to retrieve leave requests.');
        }

        // Return the view with the leave requests data
        return view('leave-requests.index', compact('leave_requests'));
    }

    /**
     * Show the form for creating a new leave request.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retrieve necessary data for the form
        $employees = Employee::all();
        $leave_types = LeaveRequest::getLeaveType();
        $statuses = LeaveRequest::getStatus();

        // Check if retrieval was successful
        if ($employees === null || $leave_types === null || $statuses === null) {
            return redirect()->back()->with('error', 'Failed to retrieve employees, leave types, or statuses.');
        }

        // Return the view with the form data
        return view('leave-requests.create', compact('employees', 'leave_types', 'statuses'));
    }

    /**
     * Store a newly created leave request in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (session('role') == 'HR Manager') {
            // Validate the incoming request data
            $data = $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'leave_type' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'status' => 'required|in:pending,approved,cancelled,rejected',
            ]);
        } else {
            $data = $request->validate([
                'leave_type' => 'required',
                'end_date' => 'required|date',
                'status' => 'pending',
            ]);

            $data['employee_id'] = session('employee_id');
            $data['start_date'] = Carbon::now()->format('Y-m-d');
        }

        try {
            // Create a new leave request
            $leave_request = LeaveRequest::create($data);

            // Check if creation was successful
            if ($leave_request === null) {
                return redirect()->back()->with('error', 'Failed to create leave request.');
            }

            // Redirect to the leave requests index with a success message
            return redirect()->route('leave-requests.index')->with('success', 'Leave request created successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message in case of exception
            return redirect()->back()->with('error', 'An unexpected error occurred: '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified leave request.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveRequest $leave_request)
    {
        // Check if the leave request exists
        if ($leave_request === null) {
            return redirect()->back()->with('error', 'Failed to retrieve leave request.');
        }

        // Retrieve necessary data for the form
        $employees = Employee::all();
        $leave_types = LeaveRequest::getLeaveType();
        $statuses = LeaveRequest::getStatus();

        // Check if retrieval was successful
        if ($employees === null || $leave_types === null || $statuses === null) {
            return redirect()->back()->with('error', 'Failed to retrieve employees, leave types, or statuses.');
        }

        // Return the view with the form data
        return view('leave-requests.edit', compact('leave_request', 'employees', 'leave_types', 'statuses'));
    }

    /**
     * Update the specified leave request in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveRequest $leave_request)
    {
        try {
            // Validate the incoming request data
            $data = $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'leave_type' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'status' => 'required|in:pending,approved,cancelled,rejected',
            ]);

            // Update the leave request with the validated data
            $leave_request->update($data);

            // Check if any changes were made
            if (! $leave_request->wasChanged()) {
                return redirect()->back()->with('error', 'No changes were made to the leave request.');
            }

            // Redirect to the leave requests index with a success message
            return redirect()->route('leave-requests.index')->with('success', 'Leave request updated successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message in case of exception
            return redirect()->back()->with('error', 'An unexpected error occurred: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified leave request from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveRequest $leave_request)
    {
        // Check if the leave request exists
        if ($leave_request === null) {
            return redirect()->back()->with('error', 'Failed to retrieve leave request.');
        }

        try {
            // Delete the leave request
            $leave_request->delete();

            // Redirect to the leave requests index with a success message
            return redirect()->route('leave-requests.index')->with('success', 'Leave request deleted successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message in case of exception
            return redirect()->back()->with('error', 'An unexpected error occurred: '.$e->getMessage());
        }
    }

    /**
     * Update the status of the specified leave request.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, LeaveRequest $leave_request)
    {
        // Check if the leave request exists
        if ($leave_request === null) {
            return redirect()->back()->with('error', 'Failed to retrieve leave request.');
        }

        try {
            // Validate the 'status' field in the request
            $data = $request->validate([
                'status' => 'required|in:pending,approved,cancelled,rejected',
            ]);

            // Update the leave request with the validated status
            $leave_request->update($data);

            // Redirect to the leave requests index with a success message
            return redirect()->route('leave-requests.index')->with('success', 'Leave request status updated successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message in case of exception
            return redirect()->back()->with('error', 'An unexpected error occurred: '.$e->getMessage());
        }
    }
}
