<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Presence;

/**
 * Controller to manage presences.
 */
class PresenceController extends Controller
{
    /**
     * Display a listing of the presences.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('presences.index', [
            'presences' => Presence::with('employee')->get(),
        ]);
    }

    /**
     * Show the form for creating a new presence.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();

        return view('presences.create', compact('employees'));
    }

    /**
     * Store a newly created presence in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'check_in' => 'required',
            'check_out' => 'nullable|after:check_in',
            'date' => 'required',
            'status' => 'required|in:present,absent,late,early_leave',
        ]);

        try {
            $presence = Presence::create($validatedData);
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating presence: '.$e->getMessage());
        }

        return redirect()->route('presences.index')->with('success', 'Presence created successfully.');
    }

    /**
     * Show the form for editing the specified presence.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function edit(Presence $presence)
    {
        if ($presence === null) {
            return back()->with('error', 'Presence not found.');
        }

        $employees = Employee::all();

        return view('presences.edit', compact('presence', 'employees'));
    }

    /**
     * Update the specified presence in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presence $presence)
    {
        if ($presence === null) {
            return back()->with('error', 'Presence not found.');
        }

        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'check_in' => 'required',
            'check_out' => 'nullable|after:check_in',
            'date' => 'required',
            'status' => 'required|in:present,absent,late,early_leave',
        ]);

        try {
            $presence->update($validatedData);
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating presence: '.$e->getMessage());
        }

        return redirect()->route('presences.index')->with('success', 'Presence updated successfully.');
    }

    /**
     * Remove the specified presence from storage.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presence $presence)
    {
        if ($presence === null) {
            return back()->with('error', 'Presence not found.');
        }

        try {
            $presence->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting presence: '.$e->getMessage());
        }

        return redirect()->route('presences.index')->with('success', 'Presence deleted successfully.');
    }
}

