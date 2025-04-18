<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\FaultReport;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user is an admin/assistant who can view all reports from a block
        if ($user->role === 'admin' || $user->role === 'assistant') {
            // Get reports only from users in the same residence block as the current user
            $reports = FaultReport::with(['user'])
                ->whereHas('user', function ($query) use ($user) {
                    $query->where('residence', $user->residence);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
        // For regular users, show only their own reports
        else {
            $reports = FaultReport::with(['user'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('assistant.reports', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assistant.create-report');
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
        $report->status = 'pending';

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('fault-images', 'public');
            $report->image = $imagePath;
        }


        $report->save();

        return redirect()->route('assistant.reports')
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
    public function update(Request $request, FaultReport $report)
    {
        $user = Auth::user();
        // Handle validation request
        if ($request->has('validate_report')) {
            $report->update([
                'validated' => true,
                'validated_at' => now(),
                'validated_by' => $user->id
            ]);

            return back()->with('success', 'Report validated successfully');
        }

        return back()->with('error', 'Invalid update request');
    }

    /**
     * Validate a fault report and assign to appropriate department
     */
    public function validate(Request $request, FaultReport $report)
    {
        // Find the department based on the fault category
        $department = Department::where('name', $report->category)->first();

        // If no direct match, you might want to implement a mapping logic 
        // or just use a default department
        if (!$department) {
            // Optional: handle case when department doesn't exist
            // Could redirect with a message to manually assign
            return back()->with('error', 'No matching department found for this fault category');
        }

        // Update report to validated status and assign department manager
        $report->update([
            'validated' => true,
            'validator_id' => auth()->id(),
            'department_id' => $department->department_id,
            'status' => 'pending' // Ensures it's set to pending for the manager
        ]);

        return back()->with('success', 'Report validated and assigned to ' . $department->name . ' department');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FaultReport $report)
    {
        $report->delete();
        return back()->with('success', 'Fault Report deleted successfully.');
    }
}
