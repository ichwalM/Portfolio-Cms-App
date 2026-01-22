<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = \App\Models\Profile::firstOrCreate(
            ['id' => 1],
            ['name' => 'Your Name', 'email' => 'email@example.com']
        );
        return view('dashboard.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bio' => 'nullable|string',
            'hero_image' => 'nullable|image|max:10240', // 10MB
            'resume_link' => 'nullable|url',
            'social_links' => 'nullable|array',
        ]);

        $profile = \App\Models\Profile::firstOrFail();
        
        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('profile', 'public');
            $validated['hero_image'] = $path;
        }

        $profile->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }
}
