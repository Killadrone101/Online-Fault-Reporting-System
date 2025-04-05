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

        $reports = FaultReport::with(['user'])
            ->where('user_id', $user->id)
            ->get();
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
