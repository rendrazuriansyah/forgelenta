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

    public function presence()
    {
        $data = Presence::where('status', 'present')
            ->selectRaw('MONTH(date) as month, YEAR(date) as year, COUNT(*) as total_present')
            ->groupBy('year', 'month')
            ->orderBy('month', 'asc')
            ->get();

        $temp = [];
        $i = 0;

        foreach ($data as $item) {
            $temp[$i] = $item->total_present;
            $i++;
        }

        return response()->json($temp);
    }
}
