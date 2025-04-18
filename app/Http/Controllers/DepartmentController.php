<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $departments = Department::with(['users'])->get();
        return view('admin.departments', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.create-department', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'manager' => 'required|exists:users,id',
            'category_type' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // Create the department with all required fields
        $department = Department::create([
            'name' => $validated['name'],
            'staff_id' => $validated['manager'],
            'category_type' => $validated['category_type'],
            'description' => $validated['description'] ?? null,
        ]);

        // Update the manager's department_id
        User::where('id', $validated['manager'])->update(['department_id' => $department->id]);

        return redirect()->route('admin.departments')->with('success', 'Department created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        // $department = Department::with(['user'])->findOrFail($id);
        return view('admin.view-department', compact('department'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }
}
