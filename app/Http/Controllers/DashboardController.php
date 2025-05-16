<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Payroll;
use App\Models\Presence;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $me = Employee::where('id', session('employee_id'))->first();

        $department = Department::count();
        $employee = Employee::count();
        $payroll = Payroll::count();
        $presence = Presence::count();

        $tasks = Task::latest()->limit(5)->get();

        return view('dashboard.index', compact('department', 'employee', 'payroll', 'presence', 'tasks', 'me'));
    }
}
