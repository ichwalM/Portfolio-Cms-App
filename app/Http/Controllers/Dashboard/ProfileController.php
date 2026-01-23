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
            $image = $request->file('hero_image');
            $filename = 'profile/' . uniqid() . '.webp';
            
            if (!\Illuminate\Support\Facades\Storage::disk('public')->exists('profile')) {
                \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('profile');
            }

            \Intervention\Image\Laravel\Facades\Image::read($image)
                ->toWebp(80)
                ->save(storage_path('app/public/' . $filename));

            $validated['hero_image'] = $filename;
        }

        $profile->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }
}
