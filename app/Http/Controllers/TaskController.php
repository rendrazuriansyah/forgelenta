<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Employee;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $employees = Employee::all();
        $statusOptions = Task::getStatusOptions();

        return view('tasks.create', compact('employees', 'statusOptions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:64',
            'description' => 'nullable|max:255',
            'assigned_to' => 'required|exists:employees,id',
            'due_datetime' => 'required',
            'status' => 'required',
        ]);

        $task = Task::create($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
}
