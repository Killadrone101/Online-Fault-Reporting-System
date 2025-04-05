<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\FaultReport;
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
                ->whereHas('user', function($query) use ($user) {
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
            // 'block' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create new fault report
        $report = new FaultReport();
        $report->user_id = Auth::id();
        $report->category = $validated['issue_type'];
        // $report->block = $validated['block'];
        $report->description = $validated['description'];
        $report->status = 'pending'; // Default status
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
        return back()->with('success', 'Fault Report deleted successfully.');
    }
}
