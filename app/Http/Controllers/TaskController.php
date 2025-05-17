<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index()
    {
        if (session('role') == 'HR Manager') {
            $tasks = Task::with('employee')->get();
        } else {
            $tasks = Task::with('employee')->where('assigned_to', session('employee_id'))->get();
        }

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
            'due_datetime' => 'required|date|after:now',
            'status' => 'required|in:'.implode(',', Task::getStatusOptions()),
        ]);

        try {
            Task::create($validatedData);

            return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating task: '.$e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Task creation failed.']);
        }
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
            'due_datetime' => 'required|date|after:now',
            'status' => 'required|in:'.implode(',', Task::getStatusOptions()),
        ]);

        try {
            $task->update($validatedData);

            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating task: '.$e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Task update failed.']);
        }
    }

    public function updateStatus(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:'.implode(',', Task::getStatusOptions()),
        ]);

        try {
            $task->update($validatedData);

            return redirect()->route('tasks.index')->with('success', 'Task status updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating task status: '.$e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Task status update failed.']);
        }
    }

    public function destroy(Task $task)
    {
        try {
            $task->delete();

            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting task: '.$e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Task deletion failed.']);
        }
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }
}
