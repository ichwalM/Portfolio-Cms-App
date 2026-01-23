<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = \App\Models\Skill::all()->groupBy('category');
        return view('dashboard.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('dashboard.skills.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'proficiency' => 'required|integer|min:0|max:100',
            'icon' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $filename = 'skills/' . uniqid() . '.webp';
            
            if (!\Illuminate\Support\Facades\Storage::disk('public')->exists('skills')) {
                \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('skills');
            }

            \Intervention\Image\Laravel\Facades\Image::read($image)
                ->toWebp(80)
                ->save(storage_path('app/public/' . $filename));

            $validated['icon'] = $filename;
        }

        \App\Models\Skill::create($validated);

        return redirect()->route('dashboard.skills.index')->with('success', 'Skill added successfully!');
    }

    public function edit(string $id)
    {
        $skill = \App\Models\Skill::findOrFail($id);
        return view('dashboard.skills.edit', compact('skill'));
    }

    public function update(Request $request, string $id)
    {
        $skill = \App\Models\Skill::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'proficiency' => 'required|integer|min:0|max:100',
            'icon' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $filename = 'skills/' . uniqid() . '.webp';
            
            if (!\Illuminate\Support\Facades\Storage::disk('public')->exists('skills')) {
                \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('skills');
            }

            \Intervention\Image\Laravel\Facades\Image::read($image)
                ->toWebp(80)
                ->save(storage_path('app/public/' . $filename));

            $validated['icon'] = $filename;
        }

        $skill->update($validated);

        return redirect()->route('dashboard.skills.index')->with('success', 'Skill updated successfully!');
    }

    public function destroy(string $id)
    {
        $skill = \App\Models\Skill::findOrFail($id);
        $skill->delete();
        return back()->with('success', 'Skill deleted successfully!');
    }
}
