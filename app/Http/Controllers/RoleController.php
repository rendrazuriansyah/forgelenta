<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * Controller to manage roles.
 */
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all roles
        $roles = Role::all();

        // Load the view with the roles data
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Load the create view
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
            ]);

            // Create the role
            Role::create($data);

            // Redirect to the index page with a success message
            return redirect()->route('roles.index')->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message
            return Redirect::back()->withErrors(['error' => 'Failed to create role.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        // Check if the role exists
        if (! $role) {
            return redirect()->route('roles.index')->withErrors(['error' => 'Role not found.']);
        }

        // Load the edit view with the role data
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        // Check if the role exists
        if (! $role) {
            return redirect()->route('roles.index')->withErrors(['error' => 'Role not found.']);
        }

        try {
            // Validate the request data
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
            ]);

            // Update the role
            $role->update($data);

            // Redirect to the index page with a success message
            return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message
            return Redirect::back()->withErrors(['error' => 'Failed to update role.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        // Check if the role exists
        if (! $role) {
            return redirect()->route('roles.index')->withErrors(['error' => 'Role not found.']);
        }

        try {
            // Delete the role
            $role->delete();

            // Redirect to the index page with a success message
            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message
            return Redirect::back()->withErrors(['error' => 'Failed to delete role.']);
        }
    }
}
