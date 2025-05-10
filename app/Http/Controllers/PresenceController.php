<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Presence;

class PresenceController extends Controller
{
    public function index()
    {
        return view('presences.index', [
            'presences' => Presence::with('employee')->get(),
        ]);
    }

    public function create()
    {
        $employees = Employee::all();

        return view('presences.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'check_in' => 'required',
            'check_out' => 'nullable|after:check_in',
            'date' => 'required',
            'status' => 'required|in:present,absent,late,early_leave',
        ]);

        $presence = Presence::create($validatedData);

        return redirect()->route('presences.index')->with('success', 'Presence created successfully.');
    }

    public function edit(Presence $presence)
    {
        $employees = Employee::all();

        return view('presences.edit', compact('presence', 'employees'));
    }

    public function update(Request $request, Presence $presence)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'check_in' => 'required',
            'check_out' => 'nullable|after:check_in',
            'date' => 'required',
            'status' => 'required|in:present,absent,late,early_leave',
        ]);

        $presence->update($validatedData);

        return redirect()->route('presences.index')->with('success', 'Presence updated successfully.');
    }

    public function destroy(Presence $presence)
    {
        $presence->delete();

        return redirect()->route('presences.index')->with('success', 'Presence deleted successfully.');
    }
}
