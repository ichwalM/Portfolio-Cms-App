<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = \App\Models\Experience::orderBy('start_date', 'desc')->paginate(10);
        return view('dashboard.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('dashboard.experiences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        \App\Models\Experience::create($validated);

        return redirect()->route('dashboard.experiences.index')->with('success', 'Experience added successfully!');
    }

    public function edit(string $id)
    {
        $experience = \App\Models\Experience::findOrFail($id);
        return view('dashboard.experiences.edit', compact('experience'));
    }

    public function update(Request $request, string $id)
    {
        $experience = \App\Models\Experience::findOrFail($id);
        
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $experience->update($validated);

        return redirect()->route('dashboard.experiences.index')->with('success', 'Experience updated successfully!');
    }

    public function destroy(string $id)
    {
        $experience = \App\Models\Experience::findOrFail($id);
        $experience->delete();
        return back()->with('success', 'Experience deleted successfully!');
    }
}
