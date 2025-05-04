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

    public function edit(Task $task)
    {
        $employees = Employee::all();
        $statusOptions = Task::getStatusOptions();

        return view('tasks.edit', compact('task', 'employees', 'statusOptions'));
    }

    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:64',
            'description' => 'nullable|max:255',
            'assigned_to' => 'required|exists:employees,id',
            'due_datetime' => 'required',
            'status' => 'required',
        ]);

        $task->update($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
