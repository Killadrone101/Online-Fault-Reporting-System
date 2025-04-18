<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\FaultReport;
use Illuminate\Http\Request;

class ManagerFaultReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = FaultReport::with(['user'])
            ->where('validated', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('manager.reports', compact('reports'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FaultReport $report)
    {
        // Laravel will automatically fetch the report
        // $report->load('user'); // Eager load user relationship
        return view('manager.view-reports', compact('report'));
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
        $request->validate([
            'status' => 'required|in:pending,solved'
        ]);
        
        $updateData = ['status' => $request->status];
        
        if ($request->status === 'solved') {
            $updateData['solved_at'] = now();
        } else {
            $updateData['solved_at'] = null;
        }
        
        $report->update($updateData);
        
        return back()->with('success', 'Report status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
