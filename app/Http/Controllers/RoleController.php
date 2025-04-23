<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Role Management';
        $roles = Role::all();

        // Return the view with the roles data
        return view('superAdmin.role', compact('title', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
        ]);

        // Check if the role already exists
        $existingRole = Role::where('name', $request->name)->first();

        if ($existingRole) {
            return redirect()->route('roles.index')->with('error', 'Role already exists.');
        }
        $data = [
            'name' => $request->name,
            'description' => $request->desc,
        ];

        Role::create($data);
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $data = [
            'name' => $request->name,
            'description' => $request->desc,
        ];

        $role->update($data);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
