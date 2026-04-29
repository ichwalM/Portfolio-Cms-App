<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\WallApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class WallAppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallApps = WallApp::latest()->paginate(10);
        return view('dashboard.wall-apps.index', compact('wallApps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.wall-apps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'required|image|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $filename = 'wall-apps/' . uniqid() . '.webp';
            
            if (!Storage::disk('public')->exists('wall-apps')) {
                Storage::disk('public')->makeDirectory('wall-apps');
            }

            Image::read($image)
                ->toWebp(80)
                ->save(storage_path('app/public/' . $filename));

            $validated['icon'] = $filename;
        }

        WallApp::create($validated);

        return redirect()->route('dashboard.wall-apps.index')->with('success', 'Wall App created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $wallApp = WallApp::findOrFail($id);
        return view('dashboard.wall-apps.edit', compact('wallApp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $wallApp = WallApp::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('icon')) {
            // Delete old icon if needed, but the current project doesn't seem to do it in other controllers
            $image = $request->file('icon');
            $filename = 'wall-apps/' . uniqid() . '.webp';
            
            if (!Storage::disk('public')->exists('wall-apps')) {
                Storage::disk('public')->makeDirectory('wall-apps');
            }

            Image::read($image)
                ->toWebp(80)
                ->save(storage_path('app/public/' . $filename));

            $validated['icon'] = $filename;
        }

        $wallApp->update($validated);

        return redirect()->route('dashboard.wall-apps.index')->with('success', 'Wall App updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wallApp = WallApp::findOrFail($id);
        $wallApp->delete();
        return back()->with('success', 'Wall App deleted successfully!');
    }
}
