<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = \App\Models\Project::latest()->paginate(10);
        return view('dashboard.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:projects,slug|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'required|image|max:10240',
            'tech_stack' => 'nullable|string', // Comma separated
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $filename = 'projects/' . uniqid() . '.webp';
            
            if (!\Illuminate\Support\Facades\Storage::disk('public')->exists('projects')) {
                \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('projects');
            }

            \Intervention\Image\Laravel\Facades\Image::read($image)
                ->toWebp(80)
                ->save(storage_path('app/public/' . $filename));

            $validated['thumbnail'] = $filename;
        }

        if (isset($validated['tech_stack'])) {
            $validated['tech_stack'] = array_map('trim', explode(',', $validated['tech_stack']));
        }

        \App\Models\Project::create($validated);

        return redirect()->route('dashboard.projects.index')->with('success', 'Project created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = \App\Models\Project::findOrFail($id);
        return view('dashboard.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = \App\Models\Project::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug,' . $id,
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:10240',
            'tech_stack' => 'nullable|string',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $filename = 'projects/' . uniqid() . '.webp';
            
            if (!\Illuminate\Support\Facades\Storage::disk('public')->exists('projects')) {
                \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('projects');
            }

            \Intervention\Image\Laravel\Facades\Image::read($image)
                ->toWebp(80)
                ->save(storage_path('app/public/' . $filename));

            $validated['thumbnail'] = $filename;
        }

        if (isset($validated['tech_stack'])) {
            $validated['tech_stack'] = array_map('trim', explode(',', $validated['tech_stack']));
        }

        $project->update($validated);

        return redirect()->route('dashboard.projects.index')->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $project = \App\Models\Project::findOrFail($id);
         $project->delete();
         return back()->with('success', 'Project deleted successfully!');
    }
}
