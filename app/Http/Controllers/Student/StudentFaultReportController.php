<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\FaultReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentFaultReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        $reports = FaultReport::with(['user'])
            ->where('user_id', $user->id)
            ->get();
        return view('student.reports', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create-report');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'issue_type' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        // Create new fault report
        $report = new FaultReport();
        $report->user_id = Auth::id();
        $report->category = $validated['issue_type'];
        $report->description = $validated['description'];
        $report->status = 'pending'; // Default status

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('fault-images', 'public');
            $report->image = $imagePath;
        }

        $report->save();

        return redirect()->route('student.dashboard')
            ->with('success', 'Fault report submitted successfully!');
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
    public function destroy(FaultReport $report)
    {
        $report->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
