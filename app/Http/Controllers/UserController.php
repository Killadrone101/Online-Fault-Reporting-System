<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\FaultReport;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                'staff as staff_count' => function($query) {
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::all();
        return view('admin.users-create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4|confirmed',
            'role' => 'required|in:student,assistant,manager,admin',
            'block' => 'required|string|max:255'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'residence' => $validated['block'],
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
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
