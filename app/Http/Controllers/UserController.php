<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\FaultReport;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        // User statistics
        $totalUsers = User::count();

        // Report statistics
        $totalReports = FaultReport::count();
        $pendingReports = FaultReport::where('status', 'pending')->count();
        $resolvedReports = FaultReport::where('status', 'resolved')->count();
        $recentReports = FaultReport::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Department statistics
        $totalDepartments = Department::count();
        $departments = Department::with(['staff'])
            ->withCount([
                'staff as staff_count' => function ($query) {
                    $query->select(DB::raw('count(*)'));
                },
                'reports as reports_count'
            ])
            ->get();

        // Feedback statistics
        $totalFeedback = Feedback::count();
        $validatedFeedback = Feedback::where('student_validation', true)->count();
        $recentFeedback = Feedback::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalReports',
            'pendingReports',
            'resolvedReports',
            'recentReports',
            'totalDepartments',
            'departments',
            'totalFeedback',
            'validatedFeedback',
            'recentFeedback'
        ));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin.users-create', compact('departments'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'block' => 'required|string',
            'role' => 'required|string|in:student,assistant,manager,admin',
            'department' => 'required_if:role,manager|nullable|exists:departments,department_id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'residence' => $validated['block'],
            'role' => $validated['role'],
        ]);

        // If the user is a manager and a department is selected, assign them to it
        if ($validated['role'] === 'manager' && isset($validated['department'])) {
            $department = Department::findOrFail($validated['department']);
            $department->staff_id = $user->id;
            $department->save();
        }

        return redirect()->route('admin.users')->with('success', 'User created successfully');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
